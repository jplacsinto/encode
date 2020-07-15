<!-- Mobile Header & Nav -->
<header x-data="{ isOpen: false }" class="w-full bg-gray-900 py-2 px-6 sm:hidden">
    <div class="flex items-center justify-between">
        <a href="index.html" class="text-white text-1xl font-semibold uppercase hover:text-gray-300">
          <i class="em em-cyclone" aria-role="presentation" aria-label="CYCLONE"></i>
        {{ config('app.name', 'Laravel') }}</a>

        <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
            <i x-show="!isOpen" class="fas fa-bars"></i>
            <i x-show="isOpen" class="fas fa-times"></i>
        </button>
    </div>

    <!-- Dropdown Nav -->
    <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
        <a href="index.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-newspaper mr-3"></i>
            Articles
        </a>
        <a href="blank.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-user-circle mr-3"></i>
            Authors
        </a>
        <a href="tables.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-tag mr-3"></i>
            Tags
        </a>
        <a href="forms.html" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
            <i class="fas fa-file-image mr-3"></i>
            Galleries
        </a>
        <a href="tabs.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-th-list mr-3"></i>
            Sections
        </a>

        <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-cogs mr-3"></i>
            Manage Users
        </a>
        <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-user mr-3"></i>
            Edit Account
        </a>
        <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-sign-out-alt mr-3"></i>
            Sign Out
        </a>
        <button class="w-full bg-white cta-btn font-semibold py-2 my-3 rounded-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
            <i class="fas fa-plus mr-3"></i> New Article
        </button>
    </nav>
    
</header>