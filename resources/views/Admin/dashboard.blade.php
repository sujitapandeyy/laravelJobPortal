<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-12 mx-auto">
            <div class="mb-12 flex items-center">
                <h2 class="text-2xl font-medium text-gray-900 title-font px-4">
                    All Listings ({{ $listings->count() }})
                </h2>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="ml-3 text-indigo-500">Sign Out</button>
                </form>
            </div>
            <div class="-my-6">
                @foreach($listings as $listing)
                    <a
                        href="{{ route('admin.listings.show', $listing->slug) }}"
                        class="py-6 px-4 flex flex-wrap md:flex-nowrap border-b border-gray-100 {{ $listing->is_highlighted ? 'bg-yellow-100 hover:bg-yellow-200' : 'bg-white hover:bg-gray-100' }}"
                    >
                        <div class="md:w-16 md:mb-0 mb-6 mr-4 flex-shrink-0 flex flex-col">
                            <img src="/storage/{{ $listing->logo }}" class="w-16 h-16 rounded-full object-cover">
                        </div>
                        <div class="md:w-1/2 mr-8 flex flex-col items-start justify-center">
                            <h2 class="text-xl font-bold text-gray-900 title-font mb-1">{{ $listing->title }}</h2>
                            <p class="leading-relaxed text-gray-900">{{ $listing->company }} &mdash; <span class="text-gray-600">{{ $listing->location }}</span></p>
                        </div>
                        <div class="md:flex-grow mr-8 mt-2 flex items-center justify-start">
                            <!-- Remove tag related content -->
                        </div>
                        <span class="md:flex-grow flex flex-col items-end justify-center">
                            <span>{{ $listing->created_at->diffForHumans() }}</span>
                            <span><strong class="text-bold">{{ $listing->clicks()->count() }}</strong> Apply Button Clicks</span>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</x-admin-layout>
