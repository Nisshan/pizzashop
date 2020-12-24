@extends('adminlte::page')

@section('title', 'Categories Menu')

@section('content')
    <div id="change">
        <div class="card">
            <div class="card-header card-primary">
                <div class="row">
                    <div class="col-sm-11 card-title">
                        <h5 class="m-0 text-dark">Menu Builder</h5>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Sort Handler</th>
                        <th>Title</th>
                    </tr>
                    </thead>
                    <tbody id="sortable">
                    @foreach($categories as $category)
                        <tr class="row1" data-id="{{ $category->id }}">
                            <td><i class="fa fa-bars" id="handle-sort"></i></td>
                            <td>{{$category->name}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
        $(function () {

            $(".sortable").ready(function () {
                $("#sortable").sortable({
                    handle: "#handle-sort",
                    items: "tr",
                    opacity: 1,
                    cursor: 'move',
                    update: function () {
                        sendOrdertoServer();
                    }
                });
                var position = [];

                function sendOrdertoServer() {
                    $('tr.row1').each(function (index) {
                        position.push({
                            id: $(this).attr('data-id'),
                            order: index + 1
                        });
                        $("#sortable").sortable("disable");
                    });

                    $.ajax({
                        type: "post",
                        dataType: "json",
                        url: "{{ route('update.position') }}",
                        data: {
                            position: position,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            window.location.reload();
                        },
                        error: (err) => {
                            Swal.fire({
                                title: 'Internal Error!, Try again',
                                timer: 1500,
                            })
                        }

                    });
                }
            });

        });
    </script>
@endpush
