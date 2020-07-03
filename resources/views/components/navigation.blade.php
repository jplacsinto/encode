<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
   <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">
      <svg class="bi bi-code-slash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
         <path fill-rule="evenodd" d="M4.854 4.146a.5.5 0 0 1 0 .708L1.707 8l3.147 3.146a.5.5 0 0 1-.708.708l-3.5-3.5a.5.5 0 0 1 0-.708l3.5-3.5a.5.5 0 0 1 .708 0zm6.292 0a.5.5 0 0 0 0 .708L14.293 8l-3.147 3.146a.5.5 0 0 0 .708.708l3.5-3.5a.5.5 0 0 0 0-.708l-3.5-3.5a.5.5 0 0 0-.708 0zm-.999-3.124a.5.5 0 0 1 .33.625l-4 13a.5.5 0 0 1-.955-.294l4-13a.5.5 0 0 1 .625-.33z"/>
      </svg>
      ENCODE <span class="badge badge-pill badge-info">Beta</span>
   </a>
   <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
   </button>
   <div class="navbar-text w-100 px-3 small">
      @if  (!app()->environment('production'))
      <span class="badge badge-warning mr-2">
         {{app()->environment()}} Environment
      </span>
      @endif
      <span>V0.1.0</span>
   </div>
   
   <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
   <div class="btn-group px-3">
      <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
      <span data-feather="user"></span>
      {{ Auth::user()->name }}
      </button>
      <div class="dropdown-menu dropdown-menu-lg-right">
         <a href="{{ route('users.edit', Auth::user()) }}" class="dropdown-item" type="button">Edit Account</a>
         @can('manage-users')
         <a href="{{ route('users.index') }}" class="dropdown-item" type="button">Manage Users</a>
         @endcan
         <div class="dropdown-divider"></div>
         <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
         </a>
         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
         </form>
         {{-- <button class="dropdown-item" type="button"><span data-feather="log-out"></span> Logout</button> --}}
      </div>
   </div>
</nav>