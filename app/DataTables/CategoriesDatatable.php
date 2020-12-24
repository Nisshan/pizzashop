<?php

namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoriesDatatable extends DataTable
{

    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function ($query) {
                $view = "";
                $view = view('shared.buttons.view')
                    ->with(['route' => route('categories.show', ['category' => $query->id])])->render();

                $edit = view('shared.buttons.edit')
                    ->with(['route' => route('categories.edit', ['category' => $query->id])])->render();
                $view .= $edit;

                    $delete = view('shared.buttons.delete')
                        ->with(['route' => route('categories.destroy', ['category' => $query->id])])->render();
                    $view .= $delete;
                return $view;
            })->editColumn('status', function ($query) {
                return $query->status == true ? 'Active' : 'Inactive';
            });
    }

    public function query(Category $model)
    {
        return $model->newQuery();
    }


    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Blfrtip')
            ->orderBy(2);
    }


    protected function getColumns()
    {
        return [
            'name',
            'status',
            'created_at',
            Column::computed('action'),
        ];
    }


    protected function filename()
    {
        return 'Categories_' . date('YmdHis');
    }
}
