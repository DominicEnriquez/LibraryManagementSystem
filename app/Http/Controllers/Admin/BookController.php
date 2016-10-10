<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Book;
use Datatables;
use Carbon\Carbon;

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
        return Datatables::of(Book::all())->addColumn('action', function($user) {
                                        return "<a href='".route("admin::book-edit", $user->id)."'><i class='fa fa-edit'></i></a>&nbsp;&nbsp;
                                                <a href='".route("admin::do-book-delete", $user->id)."'><i class='fa fa-trash-o'></i></a>";
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
     *  @return \Illuminate\Http\RedirectResponse
     */
    public function doAdd()
    {
        return redirect()->route('admin::book-list')
                         ->with('success', trans('message.successBookAdd'));
    }
    
    /**
     *  Edit Book
     *  
     *  @return \Illuminate\Http\Response
     */
    public function showEdit()
    {
        return view('pages.admin.book_edit')->with('title', 'Edit Book');
    }
    
    /**
     *  Submit Edit Book
     *  
     *  @return \Illuminate\Http\RedirectResponse
     */    
    public function doEdit()
    {
        return redirect()->route('admin::book-list')
                         ->with('success', trans('message.successBookEdit'));        
    }

    /**
     *  Submit Delete Book
     *  
     *  @return \Illuminate\Http\RedirectResponse
     */        
    public function doDelete()
    {
        return redirect()->route('admin::book-list')
                         ->with('success', trans('message.successBookDelete'));        
    }
}
