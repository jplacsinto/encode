<!-- Desktop Header -->
<header class="w-full flex items-center bg-gray-200 py-2 px-6 hidden sm:flex">
    <div class="w-1/2">
      <span class="text-xs text-gray-600">Beta v1.0</span>
      @if(!app()->environment('production'))
        <span class="text-xs bg-orange-400 px-2 py-1 rounded-full text-white">{{ ucwords(app()->environment()) }} Environment</span>
      @endif
    </div>
    <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
        <button @click="isOpen = !isOpen" class="realtive text-xs py-1 bg-white px-3 rounded-full overflow-hidden border-2 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none"">
            <i class="em em-gorilla" aria-role="presentation" aria-label="GORILLA"></i>
            Username

            <i class="fa fa-chevron-down text-gray-500" aria-hidden="true"></i>
        </button>


        <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
        <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-10 text-sm z-10">
            <a href="#" class="block px-4 py-1 account-link hover:text-white">Edit Account</a>
            <a href="{{ route('users.index') }}" class="block px-4 py-1 account-link hover:text-white">Manage Users</a>

            <a class="block px-4 py-1 account-link hover:text-white" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
           {{ __('Logout') }}
           </a>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
           </form>
        </div>
    </div>
</header>