<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Faq;
use App\User;
use Auth;

class FaqController extends Controller
{
    public function index()
    {
      $faqs = Faq::get();
      return view('faq.show')->withFaqs($faqs);
    }

    public function create()
    {

      $user = Auth::user();
      if ($user->role =! 'admin') {
        return redirect('/');
      }
      return view('faq.create');
    }

    public function store(Request $request)
    {
      $this->validate($request, array(
          'question' => 'required|min:5|max:100',
          'answer' => 'required|min:5|max:255',
          'category' => 'required',
          'active' => 'sometimes|integer',
        ));

        // Store in DB
        $faq = new Faq;

        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->category = $request->category;

        if (isset($request->active)) {
          $faq->active = $request->active;
        } else {
          $faq->active = 0;
        }

        $faq->save();

        // Redirect
        return redirect('/faq');
    }

    public function show($id)
    {
      return redirect('/faq');
    }

    public function edit($id)
    {
      $faq = Faq::find($id);
      return view('faq.edit')->withFaq($faq);
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, array(
          'question' => 'required|min:5|max:100',
          'answer' => 'required|min:5|max:255',
          'category' => 'sometimes|required',
          'active' => 'sometimes|integer',
        ));

        // Store in DB
        $faq = Faq::find($id);

        $faq->question = $request->question;
        $faq->answer = $request->answer;

        if (isset($request->category)) {
          $faq->category = $request->ctaegory;
        } else {

        }

        if (isset($request->active)) {
          $faq->active = $request->active;
        } else {
          $faq->active = 0;
        }

        $faq->save();

        return redirect('/faq');
    }

    public function destroy($id)
    {
        //
    }
}
