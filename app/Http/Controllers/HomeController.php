<?php

namespace App\Http\Controllers;

use WebModularity\LaravelAuth\User\LogUser;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recentLogins = LogUser::recentLogins(10)
            ->with([
                'logRequest.urlPath',
                'user'
            ])
            ->get();

        return view('home', [
            'recentLogins' => $recentLogins
        ]);
    }
}
