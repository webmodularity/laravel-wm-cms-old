@extends('adminlte::page')

@section('title', 'User Log')

@section('content_header')
    <h1>User Log</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">User Log</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="user-log" class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>Time</th>
                    <th>User</th>
                    <th>IP</th>
                    <th>Action</th>
                    <th>URL</th>
                    <th>Social</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@stop

@push('js')
<script>
    $(function () {
        $('#user-log').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "order": [[0, "desc"]],
            "processing": true,
            "serverSide": true,
            "ajax": '{!! url()->current() !!}',
            "columns": [
                { data: 'created_at', name: 'created_at' },
                { data: 'user.person.email', name: 'user.person.email' },
                { data: 'log_request.ip_address.ip_address', name: 'logRequest.ipAddress.ip_address' },
                { data: 'user_action.action', name: 'userAction.action' },
                { data: 'log_request.url_path.url_path', name: 'logRequest.urlPath.url_path' },
                { data: 'social_provider.provider.name', name: 'socialProvider.provider.name' }
            ]
        });
    });
</script>
@endpush