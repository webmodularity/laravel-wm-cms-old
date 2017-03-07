<?php

namespace App\Http\Controllers;

use WebModularity\LaravelUser\LogUser;

class DashboardController extends Controller
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
                'userAction',
                'logRequest',
                'logRequest.ipAddress',
                'logRequest.urlPath',
                'socialProvider',
                'user.person'
            ])
            ->get();

        return view('dashboard', [
            'recentUserActivity' => $recentUserActivity
        ]);
    }
}
