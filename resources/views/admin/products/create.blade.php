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
                    <label for="price">Price: <span class="required-form">*</span></label>
                    <input type="number" name="price" id="price" min="1" required
                           class="form-control  @error('price') is-invalid @enderror"
                           placeholder="Product Price" value="{{old('price')}}">

                    @error('price')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="mb-3">
                        <b>Has Offer: <span class="required-form">*</span></b>
                    </div>
                    <label>
                        <input type="radio" name="has_offer"
                               value="1"
                        > &nbsp; Yes
                    </label> &nbsp; &nbsp; &nbsp;
                    <label>
                        <input type="radio" name="has_offer" value="0" checked
                        > &nbsp; No
                    </label> &nbsp;
                </div>

                <div class="form-group offer_type" id="offer_type" style="display: none">
                    <div class="mb-3">
                        <b>Offer type: <span class="required-form">*</span></b>
                    </div>
                    <label>
                        <input type="radio" name="offer_type"
                               value="1" class='offer_value'
                        > &nbsp; Percentage
                    </label> &nbsp; &nbsp; &nbsp;
                    <label>
                        <input type="radio" name="offer_type" class='offer_value' value="0"
                        > &nbsp; Amount
                    </label> &nbsp;
                </div>

                <div class="form-group percentage" style="display:none;" id="percentage">
                    <label for="percent_off">Percentage Off: <span class="required-form">*</span></label>
                    <input type="number" min="1" max="100" class="form-control" name="percent_off"
                           id="percentage_reset">
                </div>

                <div class="form-group amount" style="display:none;" id="amount">
                    <label for="amount">Amount Off: <span class="required-form">*</span></label>
                    <input type="number" min="1" class="form-control" name="amount_off" id="amount_reset">
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

        $(document).on("wheel", "input[type=number]", function (e) {
            $(this).blur();
        });

        $(document).ready(function () {
            $("input[name$='has_offer']").click(function () {
                if ($(this).val() === '1') {
                    $('#offer_type').show();
                    $('.offer_value').attr('required', true);
                } else {
                    $('#offer_type').hide();
                    $('.offer_value').attr('required', false);
                    $('.offer_type').find("input:radio:checked").prop('checked', false);
                    $('#percentage').hide();
                    $('#amount').hide();
                    $('#amount_reset').val("");
                    $('#percentage_reset').val("")
                }

            });
        })

        $(document).ready(function () {
            $("input[name$='offer_type']").click(function () {
                if ($(this).val() === '1') {
                    $('#percentage').show();
                    $('#percentage_reset').attr('required', true)
                    $('#amount_reset').attr('required', false)
                    $('#amount').hide();
                    $('#amount_reset').val("");
                } else {
                    $('#percentage').hide();
                    $('#amount').show();
                    $('#percentage_reset').val("")
                    $('#percentage_reset').attr('required', false)
                    $('#amount_reset').attr('required', true)
                }
            });
        })


    </script>
@endpush


