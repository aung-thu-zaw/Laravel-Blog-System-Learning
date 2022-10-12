<!-- navbar -->
<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">Creative Coder</a>
        <div class="d-flex">
            <a href="#home" class="nav-link">Home</a>
            <a href="#blogs" class="nav-link">Blogs</a>


            {{-- @auth
            <a href="" class="nav-link text-decoration-none text-info">{{ auth()->user()->name }}</a>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary text-white btn-link text-decoration-none">Logout</button>
            </form>
            @else
            <a href="/register" class="nav-link text-warning">Register</a>
            @endauth --}}

            @guest

            <a href="/register" class="nav-link text-info">Register</a>

            <a href="/login" class="nav-link text-info">Login</a>

            @else

            {{-- @if (auth()->user()->can("admin"))
            <a href="/admin/blogs/" class="nav-link text-decoration-none text-info">
                Dashboard
            </a>
            @endif --}}

            {{-- = --}}

            @can("admin")
            <a href="/admin/blogs/" class="nav-link text-decoration-none text-info">
                Dashboard
            </a>
            @endcan

            <a href="" class="nav-link text-decoration-none text-warning">
                <span><img src="{{ auth()->user()->avatar }}" alt="" class="rounded-circle" width="35"
                        height="35"></span>
                {{ auth()->user()->name }}
            </a>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary text-white btn-link text-decoration-none">Logout</button>
            </form>

            @endguest





        </div>
    </div>
</nav>