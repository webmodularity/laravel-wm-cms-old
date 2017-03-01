<?php

namespace App\DataTables;

use Carbon\Carbon;
use Debugbar;
use Log;
use WebModularity\LaravelUser\LogUser;
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
            ->editColumn('created_at', function ($userLog) {
                return $userLog->created_at ? with(new Carbon($userLog->created_at))->format('m/d/Y h:i:sa') : '';
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(`log_users`.created_at,'%m/%d/%Y %h:%i:%s%p') like ?", ["%$keyword%"]);
            })
            ->addColumn('social_provider_name', function ($userLog) {
                return $userLog->socialProvider ? $userLog->socialProvider->provider->name : null;
            })
            ->addColumn('ip', function ($userLog) {
                return $userLog->logRequest->ipAddress->ip;
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
                'logRequest.ipAddress',
                'logRequest.urlPath',
                'user.person',
                'userAction',
                'socialProvider.provider'
            ]);

        return $this->applyScopes($query);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            // add your columns
            'created_at',
            'updated_at',
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
