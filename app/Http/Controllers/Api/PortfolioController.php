<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index() {
        $portfolios = \App\Portfolio::all();
        //dd($portfolios);
         return (compact('portfolios'));
      }
}
