<?php

namespace App\DataTables;

use App\Models\Delivery;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DeliveryDatatable extends DataTable
{

    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function ($query) {
                $view = view('shared.buttons.view')
                    ->with(['route' => route('deliveries.show', ['delivery' => $query->id])])->render();

                $edit = view('shared.buttons.edit')
                    ->with(['route' => route('deliveries.edit', ['delivery' => $query->id])])->render();
                $view .= $edit;

                $delete = view('shared.buttons.delete')
                    ->with(['route' => route('deliveries.destroy', ['delivery' => $query->id])])->render();
                $view .= $delete;
                return $view;
            })->editColumn('chargeable', function ($query) {
                return $query->chargeable == 1 ? 'Yes' : 'No';
            })->editColumn('status', function ($query) {
                return $query->status == 1 ? 'Active' : 'InActive';
            });
    }


    public function query(Delivery $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
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
            'delivery_type',
            'chargeable',
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
        return 'Delivery_' . date('YmdHis');
    }
}
