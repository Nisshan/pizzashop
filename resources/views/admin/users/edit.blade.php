@extends('adminlte::page')

@section('title', isset($title) ? $title : 'Edit User')

@section('content')
    <div class="col-md-9">
        @include('shared.error-bag')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit User Information</h3>
            </div>
            <form method="POST" action="{{route('users.update',[$user])}}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name <span class="required-form">*</span></label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name"
                               id="name"
                               placeholder="Enter Your Name"
                               value="{{old('name',$user->name) }}"
                               required
                        >
                        @error('name')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email"
                               id="email"
                               placeholder="Enter Your Email"
                               value="{{ $user->email }}"
                               disabled
                        >
                        @error('email')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password"
                               id="password"
                               placeholder="Leave blank if you want to keep your current password"
                        >
                        @error('password')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    @if(auth()->user()->isAdmin())
                        <div class="form-group">
                            <div class="mb-3">
                                <b>Status : <span class="required-form"> *</span></b>
                            </div>
                            <label>
                                <input type="radio" name="is_active"
                                       value="1"
                                       @if($user->is_active == true) checked @endif
                                > &nbsp; Active
                            </label> &nbsp; &nbsp; &nbsp;
                            <label>
                                <input type="radio" name="is_active" value="0"
                                       @if($user->is_active == false) checked @endif
                                > &nbsp; Inactive
                            </label>
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        setTimeout(function () {
            $('#password').val('');
        }, 50);
    </script>
@endpush
