<?php

namespace App\Http\Controllers;
use Auth;
use App\Smoke;
use App\Vote;
use Illuminate\Support\Facades\File;
use App\Mail\smokeApproved;
use App\Mail\smokeSubmitted;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SmokeController extends Controller
{
    public function index()
    {
      $smokes = Smoke::get();

      return view('smokes.show')->withSmokes($smokes);
    }

    public function create()
    {
      return view('smokes.create');
    }

    public function store(Request $request)
    {
      // Validate data
      $this->validate($request, array(
          'title' => 'required|min:5|max:100',
          'map' => 'required',
          'difficulty' => 'required|integer',
          'video' => 'file|mimetypes:video/mp4,video/quicktime|max:15000|required',
        ));

        $user = Auth::user();

        // Store in DB
        $smoke = new Smoke;

        $smoke->title = $request->title;
        $smoke->map = $request->map;
        $smoke->difficulty = $request->difficulty;
        $smoke->slug = time();
        $smoke->user_id = $user->id;
        $smoke->approved = '0';

        $file = $request->video;
        // $file = Request::file('video');

        $extension = $request->file('video')->extension();

        $filename = time();
        $path = public_path('smokeVideos/');
        $file->move($path, $filename . '.' . $extension);

        $smoke->video = $filename . '.' . $extension;

        $smoke->save();

        // Redirect
        return redirect('/');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
      // Validate data
      $this->validate($request, array(
          'approved' => 'required|integer',
        ));

        $smoke = Smoke::find($id);
        $smoke->approved = $request->approved;
        $user = $smoke->user;
        Mail::to($user)->send(new smokeApproved($smoke));

        $smoke->save();

        // Redirect
        return redirect('/admin/approve');
    }

    public function destroy($id)
    {

      $smoke = Smoke::find($id);
      $user = $smoke->user;
      File::delete('smokeVideos/' . $smoke->video);

      Mail::to($user)->send(new smokeDeleted($smoke));

      Smoke::destroy($id);

      // Redirect
      return back();
    }

    public function approve(){
      $user = Auth::user();

      if ($user->role == 'admin') {
        $smokes = Smoke::get();
        return view('smokes.approve')->withSmokes($smokes);
      } else {
        return redirect('/');
      }
    }
}
