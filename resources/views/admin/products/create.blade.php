@extends('adminlte::page')

@section('title',isset($title) ? $title : '' )


@section('content')
    @include('shared.error-bag')
    <div class="card card-primary card-outline col-md-8">
        <div class="card-header">
            <div class="row mb-2">
                <div class="col-sm-6 card-title">
                    <h3 class="m-0 text-dark">Products</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('products.index')}}">Products</a>
                        </li>
                        <li class="breadcrumb-item">Create</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('products.store')}}" method="POST" enctype=multipart/form-data>
                @csrf
                <div class="form-group">
                    <label for="name">Name: <span class="required-form">*</span></label>
                    <input type="text" name="name" id="name" autofocus required
                           class="form-control  @error('name') is-invalid @enderror"
                           placeholder="Product Name" value="{{old('name')}}">

                    @error('name')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">Description: <span class="required-form">*</span></label>
                    <textarea name="description" id="description" required
                              class="form-control  @error('description') is-invalid @enderror"
                              placeholder="Product Description">{{old('description')}}</textarea>
                    @error('description')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category">Categories: <span class="required-form">*</span></label>
                    <select type="text" name="categories[]" id="category" required
                            class="form-control categories  @error('category') is-invalid @enderror"
                            multiple
                            style="width: 100%;">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                {{ (collect(old('categories'))->contains($category->id)) ? 'selected':'' }}
                            >{{$category->name}}</option>
                        @endforeach
                    </select>

                    @error('category')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Product Variants: <span class="required-form">*</span></label>
                    <div class="row">
                        <div class="table-responsive ">
                            <table class="table table-bordered" id="dynamic_field">
                                <thead>
                                <tr>
                                    <th>Variant</th>
                                    <th>price<span style="color: red">*</span></th>
                                    <th>Add/Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="rowElement" id="rowElement0" data-row_id="0">
                                    <td>
                                        <input type="text" name="variant[0]" class="form-control"
                                               placeholder="Product Variant" id="variant0" required>
                                    </td>
                                    <td>
                                        <input type="text" name="price[0]" class="form-control onlynumber"
                                               placeholder="Variant price" id="price0" required>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-remove action-Btn hidden" id="remove_entry0"
                                                data-id="0" hidden>X
                                        </button>
                                        <button class="btn btn-primary pull-right btn-add action-Btn" id="add_entry0"
                                                data-id="0">+
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <label for="cover-image">Image: </label>
                    <div class="form-group">
                        <input type="file" class="form control @error('cover') is-invalid @enderror"
                               name="cover"
                               id="cover-image"
                               onchange="document.getElementById('cover').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <img id="cover" src="{{"/images/preview.jpg"}}"
                         height="100px" width="100px"><br>

                    @error('cover')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Select Multiple Images : </label><br>
                    <input id="file-input" type="file" multiple name="images[]" @error('images.*') is-invalid @enderror>
                    <div id="preview">
                    </div>

                    @error('images.*')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')

    <script>
        $(".categories").select2({
            placeholder: "Select Categories"
        });

        $(function () {
            function previewImages() {
                var preview = document.querySelector('#preview');
                if (this.files) {
                    [].forEach.call(this.files, readAndPreview);
                }

                function readAndPreview(file) {
                    // Make sure `file.name` matches our extensions criteria
                    if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                        return alert(file.name + " is not an image");
                    } // else...
                    var reader = new FileReader();
                    reader.addEventListener("load", function () {
                        var image = new Image();
                        image.height = 100;
                        image.width = 100;
                        image.title = file.name;
                        image.src = this.result;
                        preview.appendChild(image);
                    });
                    reader.readAsDataURL(file);
                }
            }

            document.querySelector('#file-input').addEventListener("change", previewImages);
        });

        $('#dynamic_field').on('click', '.btn-add', function (e) {
            e.preventDefault();
            let currentRowId = $(this).data('id');

            if ($(`#variant${currentRowId}`).val() === "" || $(`#price${currentRowId}`).val() === "") {
                alert("Name or Price cannot be empty");
                return false;
            } else {
                let rowId = currentRowId + 1;
                let nextVariantField = `<input name="variant[${rowId}]" type="text" class="form-control" id="variant${rowId}" placeholder="Variant Name" required>`;

                let nextVariantFieldPrice = `<input name="price[${rowId}]" type="text" class="form-control onlynumber" id="price${rowId}" placeholder="Variant Price " required>`;


                let actionBtn = `<button class="btn btn-danger btn-remove action-Btn" id="remove_entry${rowId}" data-id="${rowId}" type="button">X</button><button class="btn btn-primary pull-right btn-add action-Btn" id="add_entry${rowId}" data-id="${rowId}" type="button">+</button>`;


                $('#dynamic_field').append(`<tr class="rowElement" id="rowElement${rowId}" data-row_id="${rowId}"><input type="hidden" name="numofRows[]" value="${rowId}"><td>${nextVariantField}</td><td>${nextVariantFieldPrice}</td><td>${actionBtn}</td></tr>`);

                $(`#remove_entry${currentRowId}`).prop("hidden",false);
                $(`#add_entry${currentRowId}`).prop("hidden",true);

                $('.unitClass').select2({
                    'placeholder': 'Select a Unit',
                });
            }


        });


        $('#dynamic_field').on('click', '.btn-remove', function (e) {
            let rowId = $(this).data('id');
            let lastRowIdBeforeRemove = $("#dynamic_field").find("tr").last().data('row_id');

            $('#dynamic_field').find(`#rowElement${rowId}`).remove();
            let rowCount = $('.rowElement').length;
            let lastRowIdAfterRemove = $("#dynamic_field").find("tr").last().data('row_id');
            if (rowCount === 1) {
                $(`#remove_entry${lastRowIdAfterRemove}`).prop("hidden", true);
                $(`#add_entry${lastRowIdAfterRemove}`).prop("hidden", false);
                return true;
            }

            if (lastRowIdBeforeRemove == rowId) {
                $(`#remove_entry${lastRowIdAfterRemove}`).prop("hidden",false);
                $(`#add_entry${lastRowIdAfterRemove}`).prop("hidden",false);
            }
        });


    </script>
@endpush


