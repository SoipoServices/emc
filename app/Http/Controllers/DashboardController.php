<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Tags\Tag;

class DashboardController extends Controller
{
    const PAGINATION = 12;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response|RedirectResponse
    {

        if($request->get('feedbacks') == true){
            $request->user()->feedback_submitted_at = Carbon::now();
            $request->user()->save();
        }else if(empty($request->user()->feedback_submitted_at)){
            $form = 'Hi '.$request->user()->name.', if you haven\'t answered our form yet, please it take just a couple of minutes. <a href="https://tally.so/r/31rZbl" target="_blank" class="underline">Click here to start</a>';
            session()->flash('flash.banner', $form);
        }



        if(empty($request->user()->position) || empty($request->user()->bio)){
            session()->flash('flash.banner', 'Please make sure to fill up your Profile and Bio information!');
            session()->flash('flash.bannerStyle', 'danger');
            return redirect()->route('profile.show');
        }
        $tags = Tag::where('type','categories')->get();
        $search = $request->get('search');
        $category = $request->get('category');

        if ($request->session()->has('session_rand')) {

            if((time() - $request->session()->get('session_rand')) > 3600){
                $request->session()->put('session_rand', time());
            }
        }else{
            $request->session()->put('session_rand', time());
        }

        if(!empty($category) && !empty($search)){
           $query = User::search($search)->query(fn ($q) => $q->inRandomOrder($request->session()->get('session_rand'))->verified()->hasBio()->withAnyTags([$category],'categories')->with('tags'));
        }else if(!empty($search)){
            $query = User::search($search)->query(fn ($q) => $q->inRandomOrder($request->session()->get('session_rand'))->verified()->hasBio()->with('tags'));
        }else if(!empty($category)){
            $query = User::inRandomOrder($request->session()->get('session_rand'))->verified()->hasBio()->with('tags')->withAnyTags([$category],'categories');
        }else{
            $query = User::inRandomOrder($request->session()->get('session_rand'))->verified()->hasBio()->with('tags');
        }

        $users = $query->paginate(self::PAGINATION);

        return Inertia::render('Dashboard',compact(['users','tags','search']));
    }
}
