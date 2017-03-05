<?php

namespace App\DataTables;

use Carbon\Carbon;
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
            })
            ->addColumn('social_provider_name', function (LogUser $logUser) {
                return !is_null($logUser->socialProvider) ? $logUser->socialProvider->getName() : null;
            });
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
            'logRequest.requestMethod',
            'user.person',
            'userAction',
            'socialProvider'
        ]);

        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->parameters([
                'dom' => "<'row'<'col-sm-6'B><'col-sm-6'f>>" .
                    "<'row'<'col-sm-12'tr>>" .
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                'buttons' => ['export', 'print', 'reset'],
                'order' => [[0, "desc"]],
                'responsive' => true
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
                    'title' => 'Time',
                    'className' => 'max-desktop'
                ]
            ),
            new Column(
                [
                    'data' => 'user.person.email',
                    'title' => 'User',
                    'className' => 'max-desktop'
                ]
            ),
            new Column(
                [
                    'data' => 'log_request.ip_address.ip',
                    'name' => 'logRequest.ipAddress.ip',
                    'title' => 'IP',
                    'className' => 'min-tablet-l',
                    'searchable' => false
                ]
            ),
            new Column(
                [
                    'data' => 'user_action.slug',
                    'name' => 'userAction.slug',
                    'title' => 'Action',
                    'className' => 'min-tablet-l'
                ]
            ),
            new Column(
                [
                    'data' => 'log_request.request_method.method',
                    'name' => 'logRequest.requestMethod.method',
                    'title' => 'Method',
                    'className' => 'desktop'
                ]
            ),
            new Column(
                [
                    'data' => 'log_request.url_path.url_path',
                    'name' => 'logRequest.urlPath.url_path',
                    'title' => 'URL',
                    'className' => 'desktop',
                    'render' => 'function() {
                                    var max = 25;
                                    if ( type === \'display\' && data.length > max) {
                                        return \'&#8230;\' + data.substr(-max);
                                    }
                                    return data;
                                }'
                ]
            ),
            new Column(
                [
                    'data' => 'social_provider_name',
                    'name' => 'socialProvider.slug',
                    'title' => 'Social',
                    'className' => 'desktop',
                    'render' => 'function() {
                                    if ( type === \'display\' && !data) {
                                        return \'<em>None</em>\';
                                    }
                                    return data;
                    }'
                ]
            ),
            new Column(
                [
                    'data' => 'log_request.session_id',
                    'name' => 'logRequest.session_id',
                    'title' => 'Session ID',
                    'className' => 'desktop',
                    'render' => 'function() {
                                    if ( type === \'display\' ) {
                                        return data.substr(0, 7) +\'&#8230;\';
                                    }
                                    return data;
                                }'
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
