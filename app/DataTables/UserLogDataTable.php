<?php

namespace App\DataTables;

use Carbon\Carbon;
use Debugbar;
use WebModularity\LaravelUser\LogUser;
use Yajra\Datatables\Html\Column;
use Yajra\Datatables\Services\DataTable;

class UserLogDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @return \Yajra\Datatables\Engines\BaseEngine
     */
    public function dataTable()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('created_at', function (LogUser $logUser) {
                return $logUser->created_at ? with(new Carbon($logUser->created_at))->format('m/d/Y h:i:sa') : '';
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(`log_users`.created_at,'%m/%d/%Y %h:%i:%s%p') like ?", ["%$keyword%"]);
            });
            //->addColumn('social_provider.provider.name', function (LogUser $logUser) {
            //    return $logUser->socialProvider->provider->name;
            //});
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = LogUser::with([
                'logRequest',
                'logRequest.ipAddress',
                'logRequest.urlPath',
                'user.person',
                'userAction',
                'socialProvider.provider'
            ]);

        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->parameters([
                //'dom' => 'Bfrtip',
                //'buttons' => ['export', 'print', 'reset', 'reload'],
                //'order' => [[0, "desc"]]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            new Column(
                [
                    'data' => 'created_at',
                    'title' => 'Time'
                ]
            ),
            new Column(
                [
                    'data' => 'user.person.email',
                    'title' => 'User'
                ]
            ),
            new Column(
                [
                    'data' => 'log_request.ip_address.ip',
                    'name' => 'logRequest.ipAddress.ip',
                    'title' => 'IP',
                    'searchable' => false
                ]
            ),
            new Column(
                [
                    'data' => 'user_action.action',
                    'name' => 'userAction.action',
                    'title' => 'Action'
                ]
            ),
            new Column(
                [
                    'data' => 'log_request.url_path.url_path',
                    'name' => 'logRequest.urlPath.url_path',
                    'title' => 'URL'
                ]
            ),
            new Column(
                [
                    'data' => 'social_provider.provider.name',
                    'name' => 'socialProvider.provider.name',
                    'title' => 'Social'
                ]
            ),
            new Column(
                [
                    'data' => 'log_request.session_id',
                    'name' => 'logRequest.session_id',
                    'title' => 'Session ID'
                ]
            )
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'userlogdatatable_' . time();
    }
}
