@extends('layouts.base')
@section('content')

@if (session()->has('success'))
    @include('components.alerts.default', ['message' => 'Role successfully created!'])
@endif

<div class="w-full lg:w-1/2 my-3 pr-0 lg:pr-2">
    <p class="text-xl pb-3 flex items-center">
        <i class="fas fa-list mr-3"></i> Create Role
    </p>
    <form class="p-5 bg-white rounded shadow-xl" action="{{route('roles.store')}}" method="POST">
        @csrf
        {{ method_field('POST') }}


        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-2" for="name">Name</label>
            <input placeholder="Enter name" id="name" type="text" class="form-input w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" autocomplete="name">
            @error('name')
                <p class="text-red-500 text-xs">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
        </div>


        <div class="mt-6">

            <a href="{{ route('roles.index') }}" type="button" class="px-4 py-2 text-white bg-gray-500 hover:bg-gray-600 hover:text-white rounded">
                Go Back
            </a>


            <button type="submit" class="px-4 py-2 text-white bg-blue-900 hover:bg-blue-800 rounded" type="submit">Create Role</button>
        </div>
    </form>
</div>

@endsection