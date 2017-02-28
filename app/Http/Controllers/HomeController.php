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
            ->recentDays(30)
            ->limit(500)
            ->with([
                'logRequest',
                'logRequest.ipAddress',
                'logRequest.urlPath',
                'socialProvider',
                'user.person'
            ])
            ->get();

        return view('home', [
            'recentUserActivity' => $recentUserActivity
        ]);
    }
}
