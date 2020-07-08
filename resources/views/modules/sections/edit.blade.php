@extends('layouts.base')
@section('content')
<h1 class="h2">Edit Section</h1>
<div class="card">
    <div class="card-body">
        <a href="{{ route('sections.index') }}" type="submit" class="btn btn-light mb-3">
            <span data-feather="chevron-left"></span>
            Back
        </a>
        @if (session()->has('success'))
        <div class="alert alert-success">
            Section successfully updated!
        </div>
        @endif
        <h5 class="card-title border-bottom pb-3">Section: {{$section->name}}</h5>
        <div class="row">
            <div class="col-sm">
                <form action="{{route('sections.update', $section)}}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input onblur="makeSlug(this.value, 'slug')" placeholder="Enter name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $section->name) }}">
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
                            <input id="slug" readonly type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug', $section->slug) }}">
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
                            <input placeholder="Enter parent_section_id" type="text" class="form-control @error('parent_section_id') is-invalid @enderror" name="parent_section_id" value="{{ old('parent_section_id', $section->parent_section_id) }}">
                            @error('parent_section_id')
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
                            <input @if(old('active', $section->active) == 1) checked @endif name="active" value="1" type="checkbox" class="custom-control-input" id="active" />
                                <label class="custom-control-label" for="active">Active</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Update Section</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm"></div>
        </div>
    </div>
</div>
@endsection