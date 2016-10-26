<?php

namespace App\Http\Controllers\Competitor;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use Illuminate\Http\Request;


class HomeController extends AppBaseController
{
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('competitor.home');
    }
}