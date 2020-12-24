@extends('adminlte::page')

@section('content')
    <div class="col-md-9">
        @include('shared.error-bag')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create Account</h3>
            </div>

            <form method="POST" action="{{route('users.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name <span class="required-form">*</span></label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name"
                               id="name"
                               placeholder="Enter Your Name"
                               value="{{ old('name') }}"
                               autofocus
                               required
                        >
                        @error('name')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email <span class="required-form">*</span></label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email"
                               id="email"
                               placeholder="Enter Your Email"
                               value="{{ old('email') }}"
                               required
                        >
                        @error('email')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password <span class="required-form">*</span></label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password"
                               id="password"
                               placeholder="Enter Your Password"
                               required
                               minlength="8"
                        >
                        @error('password')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Password Confirmation <span class="required-form">*</span></label>
                        <input type="password"
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               name="password_confirmation"
                               id="password_confirmation"
                               placeholder="Enter Your Password again"
                               required
                               minlength="8"
                        >
                        @error('password_confirmation')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="role">Assign Role <span class="required-form">*</span></label>
                        <select name="role" id="role" class="form-control select2 @error('role') is-invalid @enderror"
                                required>
                            <option value="">Select</option>
                            <option value="1"
                                    @if(old('role') == 1) selected @endif >Admin
                            </option>
                            <option value="2"
                                    @if(old('role') == 2) selected @endif >Staff
                            </option>

                        </select>
                        @error('role')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
    </div>
@endsection
