<?php

namespace App\Http\Controllers;

use WebModularity\LaravelUser\LogUser;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use DB;

class UserLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userLog = LogUser::orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->with([
                'logRequest.ipAddress',
                'logRequest.urlPath',
                'user.person'
            ])
            ->get();

        return view('user-log.index', [
            'userLog' => $userLog
        ]);
    }

    public function ajax()
    {
        return Datatables::eloquent(
            LogUser::with([
                'logRequest.ipAddress',
                'logRequest.urlPath',
                'user.person'
            ])
        )->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WebModularity\LaravelUser\LogUser  $logUser
     * @return \Illuminate\Http\Response
     */
    public function show(LogUser $logUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WebModularity\LaravelUser\LogUser  $logUser
     * @return \Illuminate\Http\Response
     */
    public function edit(LogUser $logUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WebModularity\LaravelUser\LogUser  $logUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LogUser $logUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WebModularity\LaravelUser\LogUser  $logUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(LogUser $logUser)
    {
        //
    }
}
