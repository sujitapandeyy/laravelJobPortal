<x-app-layout>
    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-24 mx-auto">
            <div class="mb-12">
                <h2 class="text-2xl font-medium text-gray-900 title-font">
                    All Listings to admin
                </h2>
            </div>
            <div class="-my-6">
                @foreach($listings as $listing)
                <div class="flex flex-wrap md:flex-nowrap mb-12">
                    <div class="content w-full md:w-3/4 pr-4 leading-relaxed text-base">
                        <h2 class="text-xl font-medium text-gray-900 title-font mb-4">
                            {{ $listing->title }}
                        </h2>
                        <div class="md:flex-grow mr-8 mt-2 flex items-center justify-start">
                            @foreach($listing->tags as $tag)
                                <span class="inline-block mr-2 tracking-wide text-indigo-500 text-xs font-medium title-font py-0.5 px-1.5 border border-indigo-500 uppercase">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                        <p class="leading-relaxed text-gray-900">{{ $listing->content }}</p>
                    </div>
                    <div class="w-full md:w-1/4 pl-4">
                        <img
                            src="/storage/{{ $listing->logo }}"
                            alt="{{ $listing->company }} logo"
                            class="max-w-full mb-4"
                        >
                        <p class="leading-relaxed text-base">
                            <strong>Location: </strong>{{ $listing->location }}<br>
                            <strong>Company: </strong>{{ $listing->company }}
                        </p>
                        <div class="flex justify-between mt-4">
                            {{-- @if(Auth::check() && Auth::user()->id == $listing->user_id) --}}
                            {{-- href="{{ route('listings.show', $listing->slug) }}" --}}
                            {{-- <a href="{{ route('listings.edit', $listing) }}" class="inline-block ...">Edit</a> --}}

                                {{-- <a href="{{ route('listings.edit', $listing->id) }}" class="inline-block ...">Edit</a> --}}
                                <button id="deleteButton" type="button" class="inline-block ...">Delete</button>
                                <form id="deleteForm" action="{{ route('listings.Adestroy', $listing->slug) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <script>
                                    document.getElementById("deleteButton").addEventListener("click", function() {
                                        if (confirm("Are you sure you want to delete this item?")) {
                                            document.getElementById("deleteForm").submit();
                                        }
                                    });
                                </script>
                            {{-- @endif --}}
                            {{-- <a href="{{ route('listings.apply', $listing->slug) }}" class="block ...">Apply Now</a> --}}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>
