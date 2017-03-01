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
            {!! $dataTable->table(['class' => "table table-hover table-bordered"]) !!}
        </div>
        <!-- /.box-body -->
    </div>
@stop

@push('js')
{!! $dataTable->scripts() !!}
@endpush