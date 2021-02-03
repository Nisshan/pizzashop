<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function ($query) {
                $view = "";
                $view = view('shared.buttons.view')
                    ->with(['route' => route('users.show', ['user' => $query->id])])->render();

                $edit = view('shared.buttons.edit')
                    ->with(['route' => route('users.edit', ['user' => $query->id])])->render();
                $view .= $edit;
                if (auth()->user()->isAdmin()) {
                    $delete = view('shared.buttons.delete')
                        ->with(['route' => route('users.destroy', ['user' => $query->id])])->render();
                    $view .= $delete;
                }
                return $view;
            })->editColumn('status', function ($query) {
                return $query->status == true ? 'Active' : 'Inactive';
            })->editColumn('role', function ($query) {
                return $query->roleName();
            });
    }

    public function query(User $model)
    {
        if (auth()->user()->isAdmin()) {
            return $model->newQuery();
        } else {
            return $model->where('id', auth()->id())->get();
        }

    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-6'l><'col-md-6'Bf>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>")
            ->orderBy(2)
            ->responsive(true);
    }

    protected function getColumns()
    {
        if (auth()->user()->isAdmin()) {
            return [
                'name',
                'email',
                'created_at',
                'status',
                'role',
                Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->searchable(false)
            ];
        } else {
            return [
                'name',
                'email',
                'created_at',
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
        return 'Users_' . date('YmdHis');
    }
}
