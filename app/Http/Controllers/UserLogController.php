<?php

namespace App\Http\Controllers;

use App\DataTables\UserLogDataTable;
use WebModularity\LaravelUser\LogUser;
use Illuminate\Http\Request;

class UserLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index(UserLogDataTable $userLogDataTable)
    {
        return $userLogDataTable->render('user-log.index');
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
