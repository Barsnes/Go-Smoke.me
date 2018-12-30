<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Smoke;

use Illuminate\Http\Request;

class PagesController extends Controller
{

  public function index(){
    return view('index');
  }

  public function browse(){
    $smokes = Smoke::latest()->paginate(6);

    return view('browse')->withSmokes($smokes);
  }

}
