<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentHomeController extends Controller
{
    public function home() {
        return view('student_home');
    }
}
