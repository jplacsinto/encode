@extends('layouts.base')
@section('content')
<h1 class="h2">Create Section</h1>
<div class="card">
    <div class="card-body">
        <a href="{{ route('sections.index') }}" type="submit" class="btn btn-light mb-3">
            <span data-feather="chevron-left"></span>
        Back</a>
        @if (session()->has('success'))
        <div class="alert alert-success">
            Section successfully updated!
        </div>
        @endif
        <div class="row">
            <div class="col-sm">
                <form action="{{route('sections.store')}}" method="POST">
                    @csrf

                    
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
        <input placeholder="Enter name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Slug</label>
    <div class="col-sm-10">
        <input placeholder="Enter slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') }}" autofocus>
        @error('slug')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Parent_section_id</label>
    <div class="col-sm-10">
        <input placeholder="Enter parent_section_id" type="text" class="form-control @error('parent_section_id') is-invalid @enderror" name="parent_section_id" value="{{ old('parent_section_id') }}" autofocus>
        @error('parent_section_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Status</label>
    <div class="col-sm-10">
        <input placeholder="Enter status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" autofocus>
        @error('status')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Creaetd_by</label>
    <div class="col-sm-10">
        <input placeholder="Enter creaetd_by" type="text" class="form-control @error('creaetd_by') is-invalid @enderror" name="creaetd_by" value="{{ old('creaetd_by') }}" autofocus>
        @error('creaetd_by')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Create Section</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm"></div>
        </div>
    </div>
</div>
@endsection