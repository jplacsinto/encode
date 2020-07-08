@extends('layouts.base')
@section('content')
<div class="form-row">
  <div class="col">
    <h1 class="h2">Sections
    <a href="{{route('sections.create')}}" type="button" class="btn btn-outline-primary ml-3">Create New</a>
    </h1>
  </div>
  <div class="col">
    <form class="input-group mb-3" method="GET" action="{{route('sections.index')}}">
      {{ Form::text('search', request('search'), ['class' => 'form-control', 'placeholder'=>"Search section"]) }}
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="submit"><span data-feather="search"></span> Search</button>
      </div>
    </form>
  </div>
</div>
<div class="card p-3">
  @if (session()->has('message'))
  <div class="alert alert-success">
    {{ session()->get('message') }}
  </div>
  @endif
  
  @if($sections->count() > 10)
  <div class="form-row pb-2">
    <div class="col">
      <div class="d-flex flex-row  align-items-center">
        <span class="small mr-1">Show</span>
        <select class="show-rows form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
          <option {{ request('rows') == 10 ? 'selected':'' }}  value="{{ add_query_params(['rows'=>10]) }}">10</option>
          <option {{ request('rows') == 30 ? 'selected':'' }} value="{{ add_query_params(['rows'=>30]) }}">30</option>
          <option {{ request('rows') == 50 ? 'selected':'' }} value="{{ add_query_params(['rows'=>50]) }}">50</option>
        </select>
        <span class="small ml-1">rows</span>
      </div>
    </div>
    <div class="col-10">
      <div class="float-right">
        {{ $sections->withQueryString()->links() }}
      </div>
    </div>
  </div>
  @endif

  <table class="table table-responsive-lg table-hover">
    <thead>
      <tr>
        <th scope="col">Id</th>
				<th>{{ ucfirst('name') }}</th>
				<th>{{ ucfirst('slug') }}</th>
				<th>{{ ucfirst('parent_section_id') }}</th>
				<th>{{ ucfirst('status') }}</th>
				<th>{{ ucfirst('creaetd_by') }}</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($sections as $section)
      <tr>
        <td>{{ $section->id }}</td>
				<td>{{ $section->name }}</td>
				<td>{{ $section->slug }}</td>
				<td>{{ $section->parent_section_id }}</td>
				<td>{{ $section->status }}</td>
				<td>{{ $section->creaetd_by }}</td>
        <td class="text-right">
          <a class="btn btn-primary btn-sm mr-1" href="{{ route('sections.edit', $section->id) }}" role="button">Edit</a>
          <button onclick="$('#confirmDelete').attr('action', '{{ route('sections.destroy', $section->id) }}');" type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delCon">
          Delete
          </button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  
  @if($sections->count() > 10)
  <div class="form-row">
    <div class="col">
      <div class="d-flex flex-row  align-items-center">
        <span class="small mr-1">Show</span>
        <select class="show-rows form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
          <option {{ request('rows') == 10 ? 'selected':'' }}  value="{{ add_query_params(['rows'=>10]) }}">10</option>
          <option {{ request('rows') == 30 ? 'selected':'' }} value="{{ add_query_params(['rows'=>30]) }}">30</option>
          <option {{ request('rows') == 50 ? 'selected':'' }} value="{{ add_query_params(['rows'=>50]) }}">50</option>
        </select>
        <span class="small ml-1">rows</span>
      </div>
    </div>
    <div class="col-10">
      <div class="float-right">
        {{ $sections->withQueryString()->links() }}
      </div>
    </div>
  </div>
  @endif 

</div>
<!-- Modal -->
<div class="modal fade" id="delCon" tabindex="-1" role="dialog" aria-labelledby="delConTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete Section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
        <form id="confirmDelete" action="" method="POST">
          @csrf
          {{ method_field('DELETE') }}
          <button type="submit" class="btn btn-danger btn-sm">Confirm Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection