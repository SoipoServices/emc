<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

        if(empty($request->user()->position) || empty($request->user()->bio)){
            session()->flash('flash.banner', 'Please make sure to fill up your Profile and Bio information!');
            session()->flash('flash.bannerStyle', 'danger');
            return redirect()->route('profile.show');
        }
        $tags = Tag::where('type','categories')->get();
        $search = $request->get('search');
        $category = $request->get('category');

        if(!empty($category) && !empty($search)){
           $query = User::search($search)->query(fn ($q) => $q->verified()->hasBio()->withAnyTags([$category],'categories')->with('tags'));
        }else if(!empty($search)){
            $query = User::search($search)->query(fn ($q) => $q->verified()->hasBio()->with('tags'));
        }else if(!empty($category)){
            $query = User::verified()->hasBio()->with('tags')->withAnyTags([$category],'categories');
        }else{
            $query = User::verified()->hasBio()->with('tags');
        }

        $users = $query->paginate(self::PAGINATION);

        return Inertia::render('Dashboard',compact(['users','tags','search']));
    }
}
