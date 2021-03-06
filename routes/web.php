<?php
use App\Smoke;
use App\Vote;
use Illuminate\Support\Facades\Input;

Route::get('/', 'PagesController@index');

Auth::routes(['verify' => true]);

Route::get('/home', function() {
  return redirect('/');
});
Route::get('/browse', 'PagesController@browse');

Route::resource('/smokes', 'SmokeController');
Route::resource('/users', 'UserController');
Route::resource('/faq', 'FaqController');

Route::get('/admin/approve', 'SmokeController@approve');

Route::any('/search',function(){
  $q = Request::query('q');
    if ($q == '') {
      return view('search');
    }
    $smokes = Smoke::where('title','LIKE','%'.$q.'%')->orWhere('map','LIKE','%'.$q.'%')->get();
    $smokeCount = 0;
    foreach ($smokes as $smoke) {
      if ($smoke->approved == '0') {

      } else {
        $smokeCount ++;
      };
    };
    if($smokeCount > 0) {
        return view('search')->withSmokes($smokes)->withQuery($q);
      }
    else {
      return view ('search')->withMessage('No smokes found. Try to search for a different keyword!')->withQuery($q);
    }
});

Route::get('/smoke/vote/{id}', function($id){
  if (Auth::User()) {
    $user = Auth::user();
    $user = $user->id;
    $smoke = $id;

    $checkUser = Smoke::find($id);
    if ($user == $checkUser->user_id) {
      return back();
    }

    $checkVote = Vote::where('user_id', '=', $user)->where('smoke_id', '=', $smoke)->first();

    if (!$checkVote) {
      $vote = new Vote;

      $vote->user_id = $user;
      $vote->smoke_id = $smoke;
      $vote->save();

      return back();
    } else {
      Vote::destroy($checkVote->id);
      return back();
  }
} else return redirect('/');
});
