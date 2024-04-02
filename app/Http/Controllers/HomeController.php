<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ConversionHistory;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function convert()
    {
        return view('convert');
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function history()
    {
        return view('history');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getHistory()
    {
        $history = ConversionHistory::orderBy('id', 'DESC')->get();
        return response()->json([
            'data' => $history
        ], Response::HTTP_OK);
    }
}
