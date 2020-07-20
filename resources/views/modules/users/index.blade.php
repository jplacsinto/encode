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
        <table class="w-full mb-5">
           <tbody>
              <tr class="border-b">
                 <th width="50"></th>
                 <th class="text-left p-3 text-gray-700">{!!make_sortable('id', 'Id')!!}</th>
                 <th class="text-left p-3 text-gray-700">{!!make_sortable('name', 'Name')!!}</th>
                 <th class="text-left p-3 text-gray-700">{!!make_sortable('email', 'Email')!!}</th>
                 <th class="text-left p-3 text-gray-700">Status</th>
                 <th class="text-left p-3 text-gray-700">Roles</th>
              </tr>
              @foreach($users as $key => $user)
              <tr class="border-b hover:bg-orange-100 {{ $key % 2 == 0 ? 'bg-gray-100':''}}">
                 <td class="pl-3">
                   
                  <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-start">
                      <button @click="isOpen = !isOpen" class="realtive py-1 bg-transparent px-3 overflow-hidden focus:outline-none">
                          <i class="fa fa-ellipsis-v text-gray-500 hover:text-gray-800" aria-hidden="true"></i>
                      </button>


                      <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 left-40 cursor-default"></button>
                      <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 ml-10 text-sm">
                          <a href="{{ route('users.edit', $user->id) }}" title="edit" class="block px-4 py-1 hover:bg-gray-300 text-gray-700">
                            <i class="fa fa-edit mr-1"></i> Edit
                          </a>
                          <a href="#" title="Delete" data-name="{{ $user->name }}" data-action="{{ route('users.destroy', $user->id) }}" class="block px-4 py-1 modal-open hover:bg-gray-300 text-gray-700">
                            <i class="fa fa-ban mr-1"></i> Delete
                          </a>
                      </div>
                  </div>

                 </td>
                 <td class="p-3">{{ $user->id }}</td>
                 <td class="p-3">{{ $user->name }}</td>
                 <td class="p-3">{{ $user->email }}</td>
                 <td class="p-3"><span class="bg-{{$user->active ? "green":"gray"}}-500 text-xs text-white py-1 px-2 rounded-full">{{ $user->active ? "Active":"Deactivated" }}</span></td>
                 <td class="p-3">
                    @foreach($user->roles as $role)
                    <span class="bg-{{ $role->name == 'admin' ? 'blue':'gray'}}-500 text-xs text-white py-1 px-2 rounded-full">{{ ucfirst($role->name) }}</span>
                    @endforeach
                 </td>

                 {{-- <td class="p-3 text-right">
                    

                    <a href="{{ route('users.edit', $user->id) }}" title="edit" class="text-gray-800 opacity-75 hover:opacity-100 mr-3">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a href="#" title="Delete" data-name="{{ $user->name }}" data-action="{{ route('users.destroy', $user->id) }}" class="text-gray-800 opacity-75 hover:opacity-100 modal-open">
                      <i class="fa fa-ban"></i>
                    </a>
                 </td> --}}
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