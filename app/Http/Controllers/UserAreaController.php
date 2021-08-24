<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;

class UserAreaController extends Controller
{
		public function index()
	    {
	    	Test::Test(1);
	    }
}
