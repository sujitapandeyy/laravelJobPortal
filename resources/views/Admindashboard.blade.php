<x-app-layout>
    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-12 mx-auto">
            <div class="mb-12 flex items-center">
                <h2 class="text-2xl font-medium text-gray-900 title-font px-4">
                <pre>                             Welcome to Admin Dashboard!!!!</pre>
                </h2>
            </div>
            <div class="mb-12 flex items-center">
                <h2 class="text-2xl font-medium text-gray-900 title-font px-4">
                    All requested ({{ $listings->count() }})
                </h2>
                {{-- <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="ml-3 text-indigo-500">Sign Out</button>
                </form> --}}
            </div>
            <div class="-my-6">
                @php
                  // Sort the $listings array in descending order based on the 'created_at' attribute
                  $sortedListings = $listings->sortByDesc('created_at');
                 @endphp

                @foreach($sortedListings as $listing)
                    <a href="#" class="py-6 px-4 flex flex-wrap md:flex-nowrap border-b border-gray-100 {{ $listing->is_highlighted ? 'bg-yellow-100 hover:bg-yellow-200' : 'bg-white hover:bg-gray-100' }}">
                        <div class="md:w-16 md:mb-0 mb-6 mr-4 flex-shrink-0 flex flex-col">
                            <img src="/storage/{{ $listing->logo }}" class="w-16 h-16 rounded-full object-cover">
                        </div>
                        <div class="md:w-1/2 mr-8 flex flex-col items-start justify-center">
                            <h2 class="text-xl font-bold text-gray-900 title-font mb-1">{{ $listing->title }}</h2>
                            <p class="leading-relaxed text-gray-900">{{ $listing->company }} &mdash; <span class="text-gray-600">{{ $listing->location }}</span></p>
                            <p class="leading-relaxed text-gray-900">{{ $listing->content }}</p>
                       
                </div>
                        <form id="deleteForm-{{ $listing->id }}" action="{{ route('admin.listings.delete', $listing->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button onclick="confirmDelete({{ $listing->id }})" type="button" class="inline-block ...">Delete</button>
                        <span class="md:flex-grow flex flex-col items-end justify-center">
                            <span>{{ $listing->created_at->diffForHumans() }}</span>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>

<script>
    function confirmDelete(listingId) {
        if (confirm("Are you sure you want to delete this item?")) {
            document.getElementById("deleteForm-" + listingId).submit();
        }
    }
</script>

