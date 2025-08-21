<?php


namespace App\Http\Controllers\Private;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        // Handle session-based random seeding like in DashboardController
        if ($request->session()->has('session_rand')) {
            if ((time() - $request->session()->get('session_rand')) > 3600) {
                $request->session()->put('session_rand', time());
            }
        } else {
            $request->session()->put('session_rand', time());
        }
        
        if (!empty($search)) {
            $query = User::search($search)->query(fn ($q) => $q->inRandomOrder($request->session()->get('session_rand'))->verified()->isVisible()->hasPosition()->with('tags'));
        } else {
            $query = User::inRandomOrder($request->session()->get('session_rand'))->verified()->isVisible()->hasPosition()->with('tags');
        }

        $users = $query->paginate(9);

        return view('vendor.zeus.themes.zeus.sky.private.user-dashboard', [
            'users' => $users,
            'search' => $search,
        ]);
    }
}
