@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Recent User Activity</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Action</th>
                        <th>Time</th>
                        <th>User</th>
                        <th>URL</th>
                        <th>From</th>
                    </tr>
                    </thead>
                    <tbody>
                        @each('partials.recent-user-activity-row', $recentUserActivity, 'logUser')
                    </tbody>
                </table>
        </div>
        <!-- /.box-body -->
    </div>
@stop