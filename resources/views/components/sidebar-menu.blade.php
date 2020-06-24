<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="sidebar-sticky pt-3">
    <ul class="nav flex-column">


      <li class="nav-item">
        <a class="nav-link active" href="{{ route('articles.index') }}">
          <span data-feather="list"></span>
          Articles
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link ml-3" href="#">
          <span data-feather="grid"></span>
          Galleries
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link ml-3" href="#">
          <span data-feather="video"></span>
          Videos
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link ml-3" href="#">
          <span data-feather="user-check"></span>
          Surveys
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link ml-3" href="#">
          <span data-feather="calendar"></span>
          Events
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="plus-square"></span>
          Sections
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="users"></span>
          Authors
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="image"></span>
          Image Library
        </a>
      </li>
      
      
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="tag"></span>
          Tags
        </a>
      </li>
    </ul>

    {{-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Divider Label</span>
      <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
        <span data-feather="plus-circle"></span>
      </a>
    </h6> --}}
  </div>
</nav>