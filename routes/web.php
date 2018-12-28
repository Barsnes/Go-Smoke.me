<?php
use App\Smoke;
use Illuminate\Support\Facades\Input;

Route::get('/', 'PagesController@index');

Auth::routes();

Route::get('/home', 'PagesController@index');
Route::get('/browse', 'PagesController@browse');

Route::resource('/smokes', 'SmokeController');
Route::resource('/users', 'UserController');

Route::get('/admin/approve', 'SmokeController@approve');

Route::any('/search',function(){
  $q = Request::query('q');
    if ($q == '') {
      return view('search');
    }
    $smoke = Smoke::where('title','LIKE','%'.$q.'%')->orWhere('map','LIKE','%'.$q.'%')->get();
    if(count($smoke) > 0)
        return view('search')->withSmokes($smoke)->withQuery($q);
    else return view ('search')->withMessage('No smokes found. Try to search for a different keyword!')->withQuery($q);
});
