<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\BorrowBookRequest;
use App\Http\Controllers\Controller;
use Datatables;
use Carbon\Carbon;
use App\Book;
use App\BorrowBook;
use App\ReturnBook;
use App\BookRestriction;

class BookController extends Controller
{
    const JUNIOR_AGE = 12;
    
    /**
     *  Create a authentication instance.
     *  
     *  @return void
     */
    public function __construct()
    {
        if (auth()->check()) {
            $this->user = auth()->user();
            $this->user_id = $this->user->id;            
        }
    }
    
    /**
     *  Landing Page - Search for a Book.
     *  
     *  @return \Illuminate\Http\Response
     */
    public function showList()
    {
        return view('pages.home')->with('title', 'Search for a Books');
    }
    
    /**
     *  Datatables Book List.
     *  
     *  @param \Illuminate\Http\Request $request
     *  
     *  @return json
     */
    public function getBookList(Request $request)
    {
        $book = Book::select(['id', 'title', 'author', 'isbn', 'quantities', 'shelf_location']);
        return Datatables::of($book)->filter(function ($book) use ($request) {
                                        if ($request->has('search') and $request->has('filter')) {
                                            $search = "%{$request->search}%";
                                            if ($request->filter == 'all') {
                                                return $book->where('title', 'like', $search)
                                                            ->orWhere('author', 'like', $search);
                                            }
                                            return $book->where($request->filter, 'like', $search);
                                        }
                                    })
                                    ->addColumn('checkbox', function($book) {
                                        return '<input type="checkbox" class="flat" name="book[]" value="'.$book->id.'">';
                                    })
                                    ->make(true);
    }
    
    /**
     *  Submit Borrow Books.
     *  
     *  @param \App\Http\Requests\BorrowBookRequest $request
     *  @param \App\BookRestriction $bookRules
     *  @param \App\BorrowBook $borrowBook
     *  
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function doBorrowBooks(BorrowBookRequest $request, BookRestriction $bookRules, BorrowBook $borrowBook)
    {
        // Default max loan
        $loan = $bookRules->loan();
        
        // Check if member age is less than or equal to 12, max loan will decrease
        if (Carbon::parse($this->user->profile->birthdate)->age <= self::JUNIOR_AGE) {
            $loan = $bookRules->jloan();
        }
        
        // Set number of loan can get
        $loan = $loan - $borrowBook->getUser($this->user_id)->count();
        
        // Get member loan book
        $loan_book = $borrowBook->getUser($this->user_id)->lists('book_id')->toArray();        
        
        // Catch selected book if member already loan
        $is_exists = [];      
        
        // Catch selected book if not available
        $is_zero_qty = [];
        
        // Catch Success Borrow
        $is_success = [];
        
        // Check if selected loan is less than to given loan
        if (count($request->book) <= $loan) {
        
            foreach ($request->book as $id) {
                
                $book = Book::find($id);            
                
                // Check book quantity balance
                if ($book->quantities < 1) {
                    $is_zero_qty[$id] = $book->title;
                    
                } else {
                    
                    if (in_array($id, $loan_book)) {
                        $is_exists[$id] = $book->title;
                        
                    } else {
                        
                         // Insert Borrowed Book
                        $borrow = new BorrowBook;
                        $borrow->book_id = $id;
                        $borrow = $this->user->borrow()->save($borrow);

                        // Insert Unreturn Book for maximum duration of 2 calendar weeks
                        $returnBook = new ReturnBook;
                        $returnBook->expired_at = Carbon::now()->addDays($bookRules->duration());
                        $borrow->returnBook()->save($returnBook);
                        
                        // Update Selected Book Quantity
                        $book->quantities = ($book->quantities - 1);
                        $book->save();

                        $is_success[$id] = $book->title;
                    }
                }
            }
            
        } else {
            return redirect()->route('home')
                             ->with('error', 'You reach the maximum borrow. '.($loan>0?'Please select up to '.$loan:'')); 
            
        }
        
        $goBack = redirect()->route('home');
        
        // Set Notification for existing borrowed
        $warning = 'The Book is already borrowed:<br>'.implode('<br>', $is_exists);                             
        
        // Set Notification for zero quantity
        $warning2 = 'The Book is not available:<br>'.implode('<br>', $is_zero_qty);
        
        if (count($is_exists) OR 
            count($is_exists) == count($request->book)) {
            return $goBack->with('warning', $warning);                              
        }
        
        if (count($is_zero_qty) OR 
            count($is_zero_qty) == count($request->book)) {
            return $goBack->with('warning', $warning2);                              
        }
        
        if (count($is_success)) {
            return redirect()->route('borrow-books')
                             ->with('success', trans('message.successBorrow').':<br>'.implode('<br>', $is_success));  
        }
    }
    
    /**
     *  Member Book List - Display Book's Borrow/Return.
     *  
     *  @return \Illuminate\Http\Response
     */     
    public function showBorrowBooks()
    {
        return view('pages.borrow_books')->with('title', 'Borrowed Books');
    }
    
    /**
     *  Datatables Borrowed Books.
     *  
     *  @return json
     */
    public function getBorrowBooks()
    {
        $book = BorrowBook::whereHas('books', function($query) { 
                    $query->whereUserId($this->user_id); 
                })->with('books')
                  ->with('returnBook')
                  ->whereIsReturn('no')
                  ->orderby('id', 'desc');
        
        return Datatables::of($book)->addColumn('checkbox', function($book) {
                                        return '<input type="checkbox" class="flat" name="book[]" value="'.$book->id.'">';
                                    })
                                    ->editColumn('id', '{{$id}}')
                                    ->make(true);
    }
    
    /**
     *  Submit Return Books.
     *  
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function doReturnBooks(BorrowBookRequest $request, BookRestriction $bookRules)
    {
        // Catch Success Borrow
        $is_success = [];        
        
        foreach ($request->book as $id) {
                        
            $returnBook = ReturnBook::whereBorrowBookId($id)->first();           
            
            // Compare return date
            $borrowed_date = Carbon::parse($returnBook->created_at);
            $returned_date = Carbon::parse(Carbon::now());
            $diff_days = $borrowed_date->diffInDays($returned_date);
            
            // Get Total Late
            $total_late = $diff_days > $bookRules->duration() ? ($diff_days - $bookRules->duration()) : 0;
            
            // Check if late
            if ($total_late > 0) {
                $returnBook->total_late = $total_late;
                $returnBook->charge = $bookRules->charge() * $total_late;
            }
            
            // Update return book details
            $returnBook->return_at = Carbon::today();
            $returnBook->save();
            
            // Update borrow book status to yes
            $borrowBook = BorrowBook::find($id);
            $borrowBook->is_return = 'yes';
            $borrowBook->save();
            
            // Update book quantities add 1
            $book = Book::find($borrowBook->book_id);
            $book->quantities = ($book->quantities + 1);
            $book->save();
            
            $is_success[$id] = $book->title;
        }
        
        return redirect()->route('return-books')
                         ->with('success', trans('message.successReturn').':<br>'.implode('<br>', $is_success));
    }
    
    /**
     *  Member Book List - Display Book's Borrow/Return.
     *  
     *  @return \Illuminate\Http\Response
     */     
    public function showReturnBooks()
    {
        return view('pages.return_books')->with('title', 'Returned Books');
    }
    
    /**
     *  Datatables Borrowed Books.
     *  
     *  @return json
     */
    public function getReturnBooks()
    {
        $book = ReturnBook::whereHas('borrowBook', function($query) { 
                    $query->whereUserId($this->user_id); 
                })->with('borrowBook.books')
                  ->where('return_at', '<>', '')->orderBy('id', 'desc');
                  
        return Datatables::of($book)->make(true);
    }
}

