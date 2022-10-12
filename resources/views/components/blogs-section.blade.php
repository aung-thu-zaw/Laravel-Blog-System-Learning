@props(["blogs","categories","currentCategory"])

<section class="container text-center" id="blogs">
    <h1 class="display-5 fw-bold mb-4">Blogs</h1>

    {{-- Category Dropdown --}}
    <x-category-dropdown />

    <form action="/" method="GET" class="my-3">
        <div class="input-group mb-3">

            @if (request("category"))
            <input type="hidden" autocomplete="false" class="form-control" name="category" />
            @endif


            @if (request("username"))
            <input type="hidden" autocomplete="false" class="form-control" name="username" />
            @endif



            <input type="text" autocomplete="false" class="form-control" value="{{ request('searchblog') }}"
                name="searchblog" placeholder="Search Blogs..." />



            <button class="input-group-text bg-primary text-light" id="basic-addon2" type="submit">
                Search
            </button>
        </div>
    </form>


    <div class="row">

        @forelse ($blogs as $blog)

        <x-blogs-card :blog="$blog" />

        @empty


        <p class="alert alert-danger text-center text-danger">Not Found Any Blogs</p>

        @endforelse
    </div>

    {{ $blogs->links() }}
</section>
