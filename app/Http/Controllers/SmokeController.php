<?php

namespace App\Http\Controllers;
use Auth;
use App\Smoke;

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
