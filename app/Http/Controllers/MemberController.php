<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ActivateUserRequest;
use App\Http\Requests\MakeAdminUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('member.index',['showOnlyActive'=>$request->get('showOnlyActive', true)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($userId)
    {
        $user = User::findOrFail($userId);
        return view('member.show',['member'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return view('member.index');
    }


    public function makeAdmin( $userId, MakeAdminUserRequest $request)
    {

        $request->validated();
        $user = User::findOrFail($userId);
        $user->is_admin = $request->get('is_admin');
        $user->save();
        return back();
    }

    public function activate( $userId, ActivateUserRequest $request)
    {
        $request->validated();
        $user = User::findOrFail($userId);
        $user->is_active = $request->get('is_active');
        $user->save();
        return back();
    }
}
