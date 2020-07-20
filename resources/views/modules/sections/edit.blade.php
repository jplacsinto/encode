@extends('layouts.base')
@section('content')

@if (session()->has('success'))
    @include('components.alerts.default', ['message' => 'Section successfully updated!'])
@endif

<div class="w-full lg:w-1/2 my-3 pr-0 lg:pr-2">
    <p class="text-xl pb-3 flex items-center">
        <i class="fas fa-list mr-3"></i> Edit Section
    </p>
    <form class="p-5 bg-white rounded shadow-xl" action="{{route('sections.update', $section)}}" method="POST">
        @csrf
        {{ method_field('PUT') }}
        

        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-2" for="name">Name</label>
            <input onblur="makeSlug(this.value, 'slug')" placeholder="Enter name" id="section-name" type="text" class="form-input w-full px-5 py-2 text-gray-700 bg-gray-200 rounded @error('name') border-red-500 @enderror" name="name" value="{{ old('name', $section->name) }}" autocomplete="name">
            @error('name')
                <p class="text-red-500 text-xs">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-2" for="slug">Slug</label>
            <input placeholder="Enter slug" id="slug" type="text" class="form-input w-full px-5 py-2 text-gray-700 bg-gray-200 rounded focus:outline-non @error('slug') border-red-500 @enderror" name="slug" value="{{ old('slug', $section->slug) }}" autocomplete="slug" readonly>
            @error('slug')
                <p class="text-red-500 text-xs">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
        </div>

        <!-- component -->
        <div class="flex flex-wrap items-center my-5">
           <label class="block text-sm text-gray-600 mr-4 mb-2" for="name">Status</label>
           <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                <input value="1" type="checkbox" name="active" id="toggle" class="focus:outline-none toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" @if(old('active') == true) checked @endif/>
                <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
            </div>
            <label for="toggle" class="text-xs text-gray-700">Active</label>
        </div>


        <div class="mt-6">

            <a href="{{ route('sections.index') }}" type="button" class="px-4 py-2 text-white bg-gray-500 hover:bg-gray-600 hover:text-white rounded">
                Go Back
            </a>


            <button type="submit" class="px-4 py-2 text-white bg-blue-900 hover:bg-blue-800 rounded" type="submit">Submit</button>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/make_slug.js') }}"></script>
@endsection