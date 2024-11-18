<x-app-layout>
    <x-Ahero></x-Ahero>

    <section class="container px-5 py-12 mx-auto">
        <div class="mb-12">
            <!-- Admin dashboard content goes here -->
            <h2 class="text-2xl font-medium text-gray-900 title-font px-4">Admin Dashboard</h2>
            <!-- Example admin dashboard content -->
            <div class="-my-6">
                <div class="py-6 px-4 flex flex-wrap md:flex-nowrap border-b border-gray-100 bg-white hover:bg-gray-100">
                    <div class="md:w-16 md:mb-0 mb-6 mr-4 flex-shrink-0 flex flex-col">
                        <!-- Admin dashboard content item -->
                        <img src="/admin-img.png" alt="Admin Image" class="w-16 h-16 rounded-full object-cover">
                    </div>
                    <div class="md:w-1/2 mr-8 flex flex-col items-start justify-center">
                        <!-- Admin dashboard content item -->
                        <h2 class="text-xl font-bold text-gray-900 title-font mb-1">Admin Feature 1</h2>
                        <p class="leading-relaxed text-gray-900">Description of Admin Feature 1</p>
                    </div>
                    <span class="md:flex-grow flex items-center justify-end">
                        <!-- Timestamp for admin dashboard content -->
                        <span>2 hours ago</span>
                    </span>
                </div>
                <!-- More admin dashboard content items can be added here -->
            </div>
        </div>
    </section>

    <!-- Admin footer -->
    <x-admin-footer></x-admin-footer>
</x-app-layout>
