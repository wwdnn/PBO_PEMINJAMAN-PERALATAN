<?php

namespace App\DataTables;

use Spatie\Activitylog\Models\Activity as ActivityLog;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ActivityLogDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($activity) {
                $button = '<a href="' . route('petugas_peralatan.logDetails', $activity->id) . '" class="btn btn-primary">Details</a>';
                return $button;
            })

            ->editColumn('created_at', function ($activity) {
                // change font color
                return '<span>' . $activity->created_at . '</span>';
            })

            ->rawColumns(['id', 'log_name', 'description', 'subject_id', 'subject_type', 'causer_id', 'causer_type', 'created_at', 'action']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ActivityLog $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ActivityLog $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('activitylog-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->lengthMenu([[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']])
                    ->language ([
                        'url' => '//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json'
                    ])
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                    ])
                    ->autoWidth(true)
                    ->dom('lfrtip');
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')
                ->title('ID')
                ->width(10)
                ->style('font-size: 15px;')
                ->addClass('text-center'),
            Column::make('log_name')
                ->title('Nama Log')
                ->style('font-size: 15px;')
                ->width(10)
                ->addClass('text-center'),
            Column::make('description')
                ->title('Deskripsi')
                ->width(10)
                ->style('font-size: 15px;')
                ->addClass('text-center'),
            Column::make('subject_type')
                ->title('Tipe Subjek')
                ->width(10)
                ->style('font-size: 15px;')
                ->addClass('text-center'),
            Column::make('subject_id')
                ->title('ID Subjek')
                ->width(10)
                ->style('font-size: 15px;')
                ->addClass('text-center'),
            Column::make('causer_type')
                ->title('Tipe Pelaku')
                ->width(10)
                ->style('font-size: 15px;')
                ->addClass('text-center'),
            Column::make('causer_id')
                ->title('ID Pelaku')
                ->width(10)
                ->style('font-size: 15px;')
                ->addClass('text-center'),
            Column::make('created_at')
                ->title('Tanggal')
                ->width(10)
                ->style('font-size: 15px;')
                ->addClass('text-center'),
            Column::make('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->width(60)
                ->orderable(false)
                ->searchable(false)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'ActivityLog_' . date('YmdHis');
    }
}
