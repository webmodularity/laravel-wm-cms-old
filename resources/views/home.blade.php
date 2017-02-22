@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Recent User Logins</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>At</th>
                        <th>From</th>
                        <th>Via</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentLogins as $recentLogin)
                            <tr>
                                <td>{{ $recentLogin->user->person->email }}</td>
                                <td>{{ $recentLogin->created_at->format('m/d/Y h:i:sa') }}</td>
                                <td>{{ $recentLogin->logRequest->ip_address }}</td>
                                <td>{{ $recentLogin->getLoginVia() }}</td>
                            </tr>
                        @endforeach()
                    </tbody>
                </table>
        </div>
        <!-- /.box-body -->
    </div>
@stop