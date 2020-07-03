@extends('layouts.base')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2">
	<h1 class="h2">Articles</h1>
	<div class="btn-toolbar mb-2 mb-md-0">
		<form class="input-group mb-3" method="GET">
			{{ Form::text('search', request('search'), ['class' => 'form-control', 'placeholder'=>"Search title"]) }}
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="submit"><span data-feather="search"></span> Search</button>
			</div>
		</form>
	</div>
</div>
@endsection