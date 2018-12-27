<?php

namespace App\Http\Controllers;
use App\User;
use App\Smoke;

use Illuminate\Http\Request;

class PagesController extends Controller
{

  public function index(){
    return view('index');
  }

  public function browse(){
    $smokes = Smoke::get();

    return view('browse')->withSmokes($smokes);
  }

}
