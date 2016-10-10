<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Book;
use Datatables;
use Carbon\Carbon;
use App\Http\Requests\BookCreateRequest;

class BookController extends Controller
{
    /**
     *  Display Book List
     *  
     *  @return \Illuminate\Http\Response     
     */
    public function showList()
    {
        return view('pages.admin.book_list')->with('title', 'Manage Books');
    }
    
    /**
     *  Datatables Book List
     *  
     *  @return json   
     */
    public function getBookList()
    {
        return Datatables::of(Book::all())->addColumn('action', function($book) {
                                        return "<a href='".route("admin::book-edit", $book->id)."'><i class='fa fa-edit'></i></a>&nbsp;&nbsp;
                                                <a href='#' onclick='confirmDelete(\"".route("admin::do-book-delete", $book->id)."\")'><i class='fa fa-trash-o'></i></a>";
                                    })->make(true);
    }
    
    /**
     *  Create New Book
     *  
     *  @return \Illuminate\Http\Response
     */
    public function showAdd()
    {
        return view('pages.admin.book_add')->with('title', 'Create New Book');
    }
    
    /**
     *  Submit New Book
     *  
     *  @param \App\Http\Requests\BookCreateRequest $request
     *  @param \App\Book $book
     *  
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function doAdd(BookCreateRequest $request, Book $book)
    {          
        if ( $book->saveBook($book, $request)) {
            return redirect()->route('admin::book-list')
                             ->with('success', trans('message.successBookAdd'));
        }            
        
        return redirect()->route('admin::book-add')
                         ->with('warning', trans('message.failedBookAdd'));    
    }
    
    /**
     *  Edit Book
     *  
     *  $param int $id
     *  
     *  @return \Illuminate\Http\Response
     */
    public function showEdit($id)
    {
        return view('pages.admin.book_edit', ['book'=>Book::find($id)])->with('title', 'Edit Book');
    }
    
    /**
     *  Submit Edit Book
     *  
     *  @param int $id
     *  
     *  @return \Illuminate\Http\RedirectResponse
     */    
    public function doEdit(BookCreateRequest $request, Book $book, $id)
    {
        if ( $book->saveBook($book->find($id), $request)) {
            return redirect()->route('admin::book-list')
                             ->with('success', trans('message.successBookAdd'));
        }     
        
        return redirect()->route('admin::book-list')
                         ->with('warning', trans('message.failedBookEdit'));        
    }

    /**
     *  Submit Delete Book
     *  
     *  @param int $id
     *  
     *  @return \Illuminate\Http\RedirectResponse
     */        
    public function doDelete($id)
    {
        Book::find($id)->delete();
        
        return redirect()->route('admin::book-list')
                         ->with('success', trans('message.successBookDelete'));        
    }

    /**
     *  Restore Deleted Book
     *  
     *  @param int $id
     *  
     *  @return \Illuminate\Http\RedirectResponse
     */        
    public function doRestore($id)
    {
        Book::withTrashed()->whereId($id)->restore();
        
        return redirect()->route('admin::book-list')
                         ->with('success', trans('message.successBookRestore'));        
    }
}
