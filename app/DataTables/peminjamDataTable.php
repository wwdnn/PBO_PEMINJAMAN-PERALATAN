<?php

namespace App\DataTables;

use App\Models\Peminjaman;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;

class peminjamDataTable extends DataTable
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
                if($data->status_peminjaman == 'Terpinjam')
                {
                    return '<a href="javascript:void(0)" class="btn btn-success btn-sm" style="width: 100px;">Terpinjam</a>';
                }
                else if($data->status_peminjaman == 'Dikembalikan')
                {
                    return '<a href="javascript:void(0)" class="btn btn-primary btn-sm" style="width: 100px;">Dikembalikan</a>';
                }
                else
                {
                    return '<a href="javascript:void(0)" class="btn btn-danger btn-sm" style="width: 100px;">Konfirmasi</a>';
                }
                
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
        return $model->newQuery()->with(['user']);
    }


    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('peminjam-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle();
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
