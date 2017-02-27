@extends('adminlte::page')

@section('title', 'Dashboard')

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
        <div class="box-body">
                <table id="recent-user-activity" class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Time</th>
                        <th>User</th>
                        <th>IP</th>
                        <th>Action</th>
                        <th>URL</th>
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

@push('js')
    <script>
        $(function () {
            $('#recent-user-activity').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "order": [[0, "desc"]]
            });
        });
    </script>
@endpush