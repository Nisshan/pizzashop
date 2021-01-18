<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SlidersDatatable extends DataTable
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
                $view = view('shared.buttons.view')
                    ->with(['route' => route('sliders.show', ['slider' => $query->id])])->render();

                $edit = view('shared.buttons.edit')
                    ->with(['route' => route('sliders.edit', ['slider' => $query->id])])->render();
                $view .= $edit;

                $delete = view('shared.buttons.delete')
                    ->with(['route' => route('sliders.destroy', ['slider' => $query->id])])->render();
                $view .= $delete;
                return $view;
            })->editColumn('path', function ($query) {
                return '<img src="' . $query->path() . '" style="height:50px; width:50px">';
            })->editColumn('status', function ($query) {
                return $query->status == 1 ? 'Active' : 'Inactive';
            })->rawColumns(['path', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Slider $model
     * @return Builder
     */
    public function query(Slider $model)
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
            ->orderBy(2);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('path')
                ->title('Image')
                ->orderable(false)
                ->searchable(false),
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
        return 'Sliders_' . date('YmdHis');
    }
}
