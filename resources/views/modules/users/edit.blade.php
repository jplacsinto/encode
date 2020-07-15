@extends('layouts.base')
@section('content')

@if (session()->has('success'))
    @include('components.alerts.default', ['message' => 'User successfully updated!'])
@endif

<div class="w-full lg:w-1/2 my-3 pr-0 lg:pr-2">
    <p class="text-xl pb-3 flex items-center">
        <i class="fas fa-list mr-3"></i> Edit User
    </p>
    <div class="leading-loose">
        <form class="p-5 bg-white rounded shadow-xl" action="{{route('users.update', $user)}}" method="POST">
            @csrf
            {{ method_field('PUT') }}


            <div class="mb-4">
                <label class="block text-sm text-gray-600" for="email">Email</label>
                <input placeholder="Enter email" id="email" type="text" class="form-input w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('email') border-red-500 @enderror" name="email" value="{{ old('email', $user->email) }}" autocomplete="email">
                @error('email')
                    <p class="text-red-500 text-xs">
                        <strong>{{ $message }}</strong>
                    </p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm text-gray-600" for="name">Name</label>
                <input placeholder="Enter name" id="name" type="text" class="form-input w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('name') border-red-500 @enderror" name="name" value="{{ old('name', $user->name) }}" autocomplete="name">
                @error('name')
                    <p class="text-red-500 text-xs">
                        <strong>{{ $message }}</strong>
                    </p>
                @enderror
            </div>

            <!-- component -->
            <div class="flex flex-wrap items-center my-5">
               <label class="block text-sm text-gray-600 mr-4" for="name">Status</label>
               <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                    <input value="1" type="checkbox" name="active" id="toggle" class="focus:outline-none toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" @if($user->active) checked @endif/>
                    <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                </div>
                <label for="toggle" class="text-xs text-gray-700">Active</label>
            </div>


            <div class="flex flex-wrap my-4">
                <label class="block text-sm text-gray-600 mr-5" for="name">Roles</label>

                <div>
                    @foreach($roles as $role)
                    <label class="flex justify-start items-start items-center mb-2">
                      <div class="bg-white border-2 rounded border-gray-400 w-6 h-6 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
                        <input name="roles[]" value="{{ $role->id }}" type="checkbox" class="opacity-0 absolute" @if($user->roles->pluck('id')->contains($role->id)) checked @endif />
                        <svg class="fill-current hidden w-4 h-4 text-green-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                      </div>
                      <div class="select-none text-sm">{{ $role->name }}</div>
                    </label>
                    @endforeach

                </div>
            </div>


            <div class="mt-6">

                <a href="{{ route('users.index') }}" type="button" class="px-4 py-1 text-blue-900 bg-gray-500 hover:bg-gray-600 hover:text-white rounded">
                    Go Back
                </a>


                <button type="submit" class="px-4 py-1 text-white bg-blue-900 hover:bg-blue-800 rounded" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection