<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use  App\Http\Requests\UpdateProfileRequest;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the the user profile form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user-profile');
    }

    /**
     * Get the user profile info.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfile()
    {
        return response()->json([
            'error' => false,
            'user' => \Auth::user()
        ],Response::HTTP_OK);
    }

    /**
     * Update the user profile info.
     * @param App\Http\Requests\UpdateProfileRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProfileRequest $request)
    {
        
        User::where(['id' => $request->all()['id']])
            ->update([
                'email' => $request->all()['email'],
                'name' => $request->all()['name']
            ]);
        return response()->json([
            'error' => false,
            'user' => User::where(['id' => $request->all()['id']])->first()
        ],Response::HTTP_OK);
    }
}
