<?php

namespace App\DataTables;

use App\Models\User as Dosen;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DosenDataTable extends DataTable
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
        ->editColumn('status_dosen', function ($data) {
            if ($data->status == 1) {
                $data = '<span class="btn btn-success">Aktif</span>';
            } else {
                $data = '<span class="btn btn-danger">Tidak Aktif</span>';
            }
            return $data;
        })
        
        ->rawColumns(['status_dosen']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Dosen $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Dosen $model): QueryBuilder
    {
        return $model->newQuery()
                     ->where('is_siswa', 0);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('mahasiswa-table')
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
                    // button, length, filtering, processing, table, info, pagination
                    ->dom('Blfrtip');
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
                    ->title('ID'),
            Column::make('NIM_NIDN')
                    ->title('NIDN'),
            Column::make('name')
                    ->title('Nama Dosen'),
            Column::make('status_dosen')
                    ->title('Status Dosen')
                    ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Dosen_' . date('YmdHis');
    }
}
