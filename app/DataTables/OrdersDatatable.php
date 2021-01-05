<?php

namespace App\DataTables;

use App\Models\Order;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrdersDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function ($query) {

                if (auth()->user()->isUser()) {
                    $view = view('shared.buttons.view')
                        ->with(['route' => route('orders.view', ['order' => $query->id])])->render();
                    if ($query->status != 'Canceled') {
                        $cancel = view('shared.buttons.cancel')
                            ->with(['route' => route('orders.cancel', ['order' => $query->id])])->render();
                        $view .= $cancel;
                    }
                } else {

                    $view = view('shared.buttons.view')
                        ->with(['route' => route('orders.show', ['order' => $query->id])])->render();
                }


                if (auth()->user()->isAdmin()) {
                    if (!in_array($query->status, ['Canceled', 'Delivered'])) {
                        $delete = view('shared.buttons.delete')
                            ->with(['route' => route('orders.destroy', ['order' => $query->id])])->render();
                        $view .= $delete;
                    }
                }
                return $view;
            })->editColumn('delivery_at', function ($query) {
                return Carbon::parse($query->delivery_at)->format('Y-m-d h:i:s');
            })->editColumn('user', function ($query) {
                return $query->user->name ?? 'Guest Order';
            })->editColumn('status', function ($query) {
                if (in_array($query->status, ['Delivered', 'Canceled'])) {
                    return '<span class="btn ' . config('deliverystatus.status.' . $query->status) . '">' . $query->status . '</span>';
                } else {
                    return '<button type="button" class="btn ' . config('deliverystatus.status.' . $query->status) . ' change-status" data-toggle="modal" data-target="#exampleModal"  data-id=' . $query->id . ' data-status=' . $query->status . '>
                        ' . $query->status . '
                        </button>';
                }

            })->rawColumns(['status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        if (auth()->user()->roleName() != 'User') {
            return $model->with('user:name,id')->newQuery();
        } else {
            return $model->where('user_id', auth()->id())->newQuery();
        }
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
            ->dom("<'row'<'col-md-6'l><'col-md-6'Bf>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>")
            ->orderBy(2)
            ->responsive(true);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        if (auth()->user()->roleName() != 'User') {
            return [
                Column::make('user')
                    ->name('user.name')
                    ->title('Created By')
                    ->orderable(true)
                    ->searchable(true),
                'quantity',
                Column::make('billing_name')
                    ->title('Name')
                    ->orderable(true)
                    ->searchable(true),
                'status',
                Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->searchable(false)
            ];
        } else {
            return [
                'quantity',
                'status',
                Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->searchable(false)
            ];
        }

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Orders_' . date('YmdHis');
    }
}
