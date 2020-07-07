@extends('layouts.base')
@section('content')
<h1 class="h2">Create User</h1>
<div class="card">
    <div class="card-body">
        <a href="{{ route('users.index') }}" type="submit" class="btn btn-light mb-3">
            <span data-feather="chevron-left"></span>
        Back</a>
        @if (session()->has('success'))
        <div class="alert alert-success">
            User successfully updated!
        </div>
        @endif
        <div class="row">
            <div class="col-sm">
                <form action="{{route('users.store')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input placeholder="Enter email" id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input id="name" placeholder="Enter name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="roles" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <div class="custom-control custom-switch my-2">
                            <input name="active" value="1" type="checkbox" class="custom-control-input" id="active" />
                                <label class="custom-control-label" for="active">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="roles" class="col-sm-2 col-form-label">Roles</label>
                        <div class="col-sm-10">
                            @foreach($roles as $role)
                            <div class="custom-control custom-switch my-2">
                                <input name="roles[]" value="{{ $role->id }}" type="checkbox" class="custom-control-input" id="customSwitch{{$role->id}}" />
                                <label class="custom-control-label" for="customSwitch{{$role->id}}">{{ $role->name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm"></div>
        </div>
    </div>
</div>
@endsection