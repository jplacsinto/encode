@extends('layouts.base')
@section('content')
  <div class="w-full mb-3">

      @if (session()->has('message'))
        @include('components.alerts.default', ['message' => session()->get('message')])
      @endif  

     <div class="mb-4 flex justify-between items-center">
        <div class="flex-1 pr-4">
           <span class="text-xl items-center">
           <i class="fas fa-list mr-3"></i> Users
           </span>
           <a href="{{route('users.create')}}" type="button" class="ml-4 bg-transparent hover:bg-blue-700 text-blue-500 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"><i class="fas fa-plus mr-2"></i>New</a>
        </div>
        <div class="flex-1">
           <form class="relative" method="GET" action="{{route('users.index')}}">
              <input type="search" name="search"
                 class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium" placeholder="Search..." value="{{request('search')}}">
              <div class="absolute top-0 left-0 inline-flex items-center p-2">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                    <circle cx="10" cy="10" r="7" />
                    <line x1="21" y1="21" x2="15" y2="15" />
                 </svg>
              </div>
           </form>
        </div>
     </div>
     <div class="bg-white rounded shadow-xs pb-5 overflow-x-auto">
        <table class="w-full text-md mb-5">
           <tbody>
              <tr class="border-b">
                 <th class="text-left p-3 px-5">Id</th>
                 <th class="text-left p-3 px-5">Name</th>
                 <th class="text-left p-3 px-5">Email</th>
                 <th class="text-left p-3 px-5">Status</th>
                 <th class="text-left p-3 px-5">Roles</th>
                 <th class="text-right"></th>
              </tr>
              @foreach($users as $key => $user)
              <tr class="border-b hover:bg-orange-100 {{ $key % 2 == 0 ? 'bg-gray-100':''}}">
                 <td class="p-3 px-5">{{ $user->id }}</td>
                 <td class="p-3 px-5">{{ $user->name }}</td>
                 <td class="p-3 px-5">{{ $user->email }}</td>
                 <td class="p-3 px-5"><span class="bg-{{$user->active ? "green":"gray"}}-500 text-xs text-white px-2 rounded">{{ $user->active ? "Active":"Deactivated" }}</span></td>
                 <td class="p-3 px-5">
                    @foreach($user->roles as $role)
                    <span class="bg-{{ $role->name == 'admin' ? 'blue':'gray'}}-500 text-xs text-white px-2 rounded">{{ ucfirst($role->name) }}</span>
                    @endforeach
                 </td>

                 <td class="p-3 px-5 text-right">
                    {{-- <a class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline" href="{{ route('users.edit', $user->id) }}" role="button">Edit</a>
                    <button data-name="{{ $user->name }}" data-action="{{ route('users.destroy', $user->id) }}" type="button" class="modal-open text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                    Delete
                    </button> --}}

                    {{-- <div x-data="{ isOpen: false }" class="relative flex justify-end">
                      <button @click="isOpen = !isOpen" class="realtive py-1 bg-transparent px-3 overflow-hidden focus:text-gray-900 focus:outline-none">
                          <i class="fa fa-ellipsis-v text-gray-500" aria-hidden="true"></i>
                      </button>


                      <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-1 cursor-default"></button>
                      <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 text-sm z-10">
                          <a href="{{ route('users.edit', $user->id) }}" title="edit" class="block px-4 py-1 account-link hover:text-white">Edit</a>
                          <a href="#" data-name="{{ $user->name }}" data-action="{{ route('users.destroy', $user->id) }}" title="delete" class="block px-4 py-1 account-link hover:text-white modal-open">Delete</a>
                      </div>
                    </div> --}}

                    <a href="{{ route('users.edit', $user->id) }}" title="edit" class="text-gray-800 opacity-75 hover:opacity-100 mr-3">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a href="#" title="Delete" data-name="{{ $user->name }}" data-action="{{ route('users.destroy', $user->id) }}" class="text-gray-800 opacity-75 hover:opacity-100 modal-open">
                      <i class="fa fa-ban"></i>
                    </a>
                 </td>
              </tr>
              @endforeach
           </tbody>
        </table>
        <div class="px-5">
            {{ $users->withQueryString()->links() }}
        </div>
     </div>
  </div>
@endsection

@section('body_close')
  @include('components.modals.delete')
@endsection