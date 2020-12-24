<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductsDatatable extends DataTable
{

    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function ($query) {
                $view = "";
                $view = view('shared.buttons.view')
                    ->with(['route' => route('products.show', ['product' => $query->id])])->render();

                $edit = view('shared.buttons.edit')
                    ->with(['route' => route('products.edit', ['product' => $query->id])])->render();
                $view .= $edit;

                $delete = view('shared.buttons.delete')
                    ->with(['route' => route('products.destroy', ['product' => $query->id])])->render();
                $view .= $delete;
                return $view;
            })->editColumn('status', function ($query) {
                return $query->status == true ? 'Active' : 'Inactive';
            });
    }


    public function query(Product $model)
    {
        return $model->newQuery();
    }


    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Blfrtip')
            ->orderBy(3);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name',
            'status',
            'created_at',
            Column::computed('action'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Products_' . date('YmdHis');
    }
}
