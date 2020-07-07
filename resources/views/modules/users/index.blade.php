@extends('layouts.base')
@section('content')
<div class="form-row">
  <div class="col">
    <h1 class="h2">Users
    <a href="{{route('users.create')}}" type="button" class="btn btn-outline-primary ml-3">Create New</a>
    </h1>
  </div>
  <div class="col">
    <form class="input-group mb-3" method="GET" action="{{route('users.index')}}">
      {{ Form::text('search', request('search'), ['class' => 'form-control', 'placeholder'=>"Search name or email"]) }}
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
        {{ $users->withQueryString()->links() }}
      </div>
    </div>
  </div>
  <table class="table table-responsive-lg table-hover">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Status</th>
        <th scope="col">Roles</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <th scope="row">{{ $user->id }}</th>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td><span class="badge badge-{{$user->active ? "success":"secondary"}}">{{ $user->active ? "Active":"Deactivated" }}</span></td>
        <td>
          @foreach($user->roles as $role)
          <span class="badge badge-info">{{ $role->name }}</span>
          @endforeach
        </td>
        <td class="text-right">
          <a class="btn btn-primary btn-sm mr-1" href="{{ route('users.edit', $user->id) }}" role="button">Edit</a>
          <button onclick="$('#confirmDelete').attr('action', '{{ route('users.destroy', $user->id) }}');" type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delCon">
          Delete
          </button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  
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
        {{ $users->withQueryString()->links() }}
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="delCon" tabindex="-1" role="dialog" aria-labelledby="delConTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete User</h5>
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