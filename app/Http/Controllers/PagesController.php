<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Smoke;
use App\Vote;
use DB;

use Illuminate\Http\Request;

class PagesController extends Controller
{

  public function index(){

    $smokes = Smoke::withCount('vote')
    ->orderBy('vote_count', 'desc')
    ->get();

    return view('index')->withSmokes($smokes);
  }

  public function browse(){
    $smokes = Smoke::latest()->paginate(6);

    return view('browse')->withSmokes($smokes);
  }

}
