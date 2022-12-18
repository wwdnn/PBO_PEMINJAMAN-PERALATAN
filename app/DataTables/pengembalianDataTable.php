<?php

namespace App\DataTables;

use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;

class pengembalianDataTable extends DataTable
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
            ->addColumn('action', function($data){
                return '<a href="'.route('petugas_peralatan.detailPengembalian', $data->id).'" class="btn btn-primary btn-sm">Detail Peminjaman</a>';
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Peminjaman $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Peminjaman $model): QueryBuilder
    {
        return $model->newQuery()->with(['user'])->where('status_peminjaman', 'Terpinjam');
    }


    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pengembalian-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->language ([
                        'url' => '//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json'
                    ])
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
            //generate columns number
        
            Column::make('user.name')->name('user.name')->title('Nama Peminjam')->addClass('text-center'),
            Column::make('tanggal_peminjaman')->addClass('text-center'),
            Column::make('action')
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
        return 'pengembalian_' . date('YmdHis');
    }
}
