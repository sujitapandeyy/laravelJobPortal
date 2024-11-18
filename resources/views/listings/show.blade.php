<x-app-layout>
    <section class="text-gray-600 body-font overflow-hidden">
        <h2 class="text-2xl font-medium text-gray-900 title-font">
            All Listings to user
        </h2>
        <div class="container px-5 py-24 mx-auto">
            <div class="mb-12">
                <h2 class="text-2xl font-medium text-gray-900 title-font">
                    {{ $listing->title }}
                </h2>
            </div>
            <div class="-my-6">
                <div class="flex flex-wrap md:flex-nowrap">
                    <div class="content w-full md:w-3/4 pr-4 leading-relaxed text-base">
                        {!! $listing->content !!}
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
                            @if(Auth::check() && Auth::user()->id == $listing->user_id)
                                <button id="deleteButton" type="button" class="inline-block ...">Delete</button>
                                <form id="deleteForm" action="{{ route('listings.destroy', $listing->id) }}" method="POST" style="display: none;">
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
                              <a href="{{ route('listings.edit', $listing) }}" class="inline-block ...">Edit</a>

                            @endif
                            <a href="{{ route('listings.apply', $listing->slug) }}" class="block ...">Apply Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
