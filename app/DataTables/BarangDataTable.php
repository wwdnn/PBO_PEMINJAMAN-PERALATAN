<?php

namespace App\DataTables;

use App\Models\Product as Barang;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BarangDataTable extends DataTable
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
        ->addColumn('action', function ($data) {
            $button ='<a href="'.route('barang.edit', $data->id).'" class="btn btn-primary btn-xs">Edit</a>';
            $button .= '&nbsp;&nbsp;';
            $button .= '<form action="'.route('barang.destroy', $data->id).'" method="post" style="display:inline">
            '.csrf_field().'
            '.method_field('DELETE').'
            <button type="submit" class="btn btn-danger btn-xs">Delete</button>
            </form>';
            return $button;
        })
        
        ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Barang $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Barang $model): QueryBuilder
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
                    ->setTableId('barang-table')
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
            Column::make('kode_barang'),
            Column::make('nama_barang'),
            Column::make('stok_barang'),
            Column::make('status_barang'),
            Column::make('action')
                  ->exportable(false)
                  ->printable(false)
                  ->searchable(false)
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
        return 'Barang_' . date('YmdHis');
    }
}
