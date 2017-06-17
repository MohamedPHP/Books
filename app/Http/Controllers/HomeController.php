<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Book;
use DB;
class HomeController extends Controller
{

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(User $users, Book $book)
    {
        $usersCount = $users->where('type', '!=', 3)->count();
        $staffCount = $users->where('type', 2)->count();
        $bookCount  = $book->count();
        $bookDeleteRequestCount = $book->where('status', 1)->count();
        $books  = $book->take(5)->orderBy('id', 'DESC')->get();
        $booksDeleteReueste = $book->where('status', 1)->take(5)->orderBy('id', 'DESC')->get();

        // get the charts
        $chartBooks = $book->select(DB::raw('COUNT(*) AS counting, month'))
        ->where('year', date('Y'))
        ->groupBy('month')
        ->orderBy('month', 'ASC')
        ->get()->toArray();
        // make the array that will have the empty nonth
        $array = [];
        if (isset($chartBooks[0]['month'])) {
            for($i = 1; $i < $chartBooks[0]['month']; $i++){
                // assain the array
                $array[] = 0;
            }
        }
        // merge the 2 arrays
        $chartData = array_merge($array, $chartBooks);

        return view('backend.index',
        compact('usersCount', 'staffCount', 'bookCount', 'bookDeleteRequestCount', 'books', 'booksDeleteReueste', 'chartData'));
    }


    public function homepage()
    {
        return view('frontend.welcome');
    }

}
