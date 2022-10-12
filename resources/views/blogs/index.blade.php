<x-layout>

    @if (session("success"))
    <div class="alert alert-success my-5">
        <p class="text-center mb-0">{{ session("success") }}</p>
    </div>
    @endif

    <!-- hero section -->
    <x-hero-section />

    <!-- blogs section -->
    <x-blogs-section :blogs="$blogs" />

    <!-- Footer -->
    <x-footer-section />

</x-layout>
