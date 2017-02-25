<?php

namespace App\Http\Controllers;

use WebModularity\LaravelUser\LogUser;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recentUserActivity = LogUser::orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->limit(25)
            ->with([
                'logRequest.ipAddress',
                'logRequest.urlPath',
                'user.person'
            ])
            ->get();

        return view('home', [
            'recentUserActivity' => $recentUserActivity
        ]);
    }
}
