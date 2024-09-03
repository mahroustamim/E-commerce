<?php

namespace App\Http\Controllers\wesite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        return view('website.index');
        // return view('website.new');
    }
}
