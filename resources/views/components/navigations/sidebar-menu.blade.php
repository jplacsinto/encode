<aside class="relative bg-gray-900 h-screen w-64 hidden sm:block shadow-xl">
  <div class="px-6 py-3 bg-gray-800">
      <a href="/" class="text-white text-1xl font-semibold uppercase hover:text-gray-300">
        <i class="em em-cyclone" aria-role="presentation" aria-label="CYCLONE"></i>
        {{ config('app.name', 'Laravel') }}</a>


      <a href="{{route('articles.create')}}" class="w-full bg-white cta-btn font-semibold py-2 mt-4 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
          <i class="fas fa-plus mr-3"></i> New Article
      </a>
  </div>
  <nav class="text-white text-base">
      <a href="{{route('articles.index')}}" class="flex items-center active-nav-link text-white py-2 px-6 nav-item">
          <i class="fa fa-newspaper mr-3"></i>
          
          Articles
      </a>
      <a href="{{-- {{route('authors.index')}} --}}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 px-6 nav-item">
          <i class="fas fa-user-circle mr-3"></i>
          Authors
      </a>
      <a href="tables.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 px-6 nav-item">
          <i class="fas fa-tag mr-3"></i>
          Tags
      </a>
      <a href="forms.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 px-6 nav-item">
          <i class="fas fa-file-image mr-3"></i>
          Galleries
      </a>
      <a href="tabs.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 px-6 nav-item">
          <i class="fas fa-th-list mr-3"></i>
          Sections
      </a>
  </nav>
  {{-- <a href="#" class="absolute w-full upgrade-btn bottom-0 active-nav-link text-white flex items-center justify-center py-4">
      <i class="fas fa-arrow-circle-up mr-3"></i>
      Upgrade to Pro!
  </a> --}}

  <div class="absolute text-xs w-full bg-gray-900 bottom-0 text-gray-700 text-center py-4">&copy; Copyright {{ config('app.name', 'Laravel') }} 2020</div>

</div>
</aside>