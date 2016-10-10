<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Book;
use App\BorrowBook;
use Carbon\Carbon;
use Datatables;

class ReportController extends Controller
{
    /**
     *  Display Member Loans
     *  
     *  @return \Illuminate\Http\Response
     */
    public function showLoans()
    {
        return view('pages.admin.report_loans')->with('title', 'Loan Reports');
    }
    
    /**
     *  Datatables Report Loans
     *  
     *  @return json
     */
    public function getReportLoans()
    {
        $report = BorrowBook::with('books')->whereIsReturn('no');        
        return Datatables::of($report)->make(true);
    }
    
    /**
     *  Display Book Quantities
     *  
     *  @return \Illuminate\Http\Response
     */
    public function showQuantities()
    {
        return view('pages.admin.report_quantities')->with('title', 'Quantity Reports');
    }
    
    /**
     *  Datatables Book Quantities
     *  
     *  @return json
     */
    public function getReportQuantities()
    {     
        return Datatables::of(Book::all())->make(true);
    }
}
