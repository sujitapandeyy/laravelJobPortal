<header class="text-gray-600 body-font border-b border-gray-100">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <a href="{{ route('listings.index') }}" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
            <img src="{{ asset('logo.jpg') }}" class="w-10 h-10 text-white p-0 bg-indigo-500 rounded-full" alt="JobNepal Logo">
            <span class="ml-3 text-xl">JobNepal : Job Portal</span>
        </a>
        <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
            @guest {{-- Check if the user is not logged in --}}
                <a href="{{ route('login') }}" class="mr-5 inline-flex items-center bg-indigo-500 text-white border-0 py-1 px-3 focus:outline-none hover:bg-indigo-600 rounded text-base mt-4 md:mt-0 hover:text-gray-900">Login</a>
            @endguest {{-- End guest check --}}
            @auth {{-- Check if the user is logged in --}}
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="mr-5  items-center bg-indigo-500 text-white border-0 py-1 px-3 focus:outline-none hover:bg-indigo-600 rounded text-base mt-4 md:mt-0 hover:text-gray-900">Sign Out</button>
                </form>
            @endauth {{-- End auth check --}}
        </nav>
        @auth
        @if (Auth::user()->type =='admin') 
            {{-- Show admin-specific content --}}
        @else
            <a href="{{ route('listings.create') }}" class="inline-flex items-center bg-indigo-500 text-white border-0 py-1 px-3 focus:outline-none hover:bg-indigo-600 rounded text-base mt-4 md:mt-0">Post new Job
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
            </a>
        @endif
    @endauth
    
        {{-- <a href="{{ route('listings.create') }}" class="inline-flex items-center bg-indigo-500 text-white border-0 py-1 px-3 focus:outline-none hover:bg-indigo-600 rounded text-base mt-4 md:mt-0">Post new Job
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                <path d="M5 12h14M12 5l7 7-7 7"></path>
            </svg>
        </a> --}}
    </div>
</header>
