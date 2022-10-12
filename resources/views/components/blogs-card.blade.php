@props(["blog"])
<div class="col-md-4 mb-4">
    <div class="card">
        {{-- <img src="/storage/{{ $blog->thumbnail }}" class="card-img-top" alt="..." /> --}}

        {{-- OR --}}


        <img src='{{ asset("storage/$blog->thumbnail") }}' class="card-img-top" alt="..." />
        <div class="card-body">
            <h3 class="card-title">{{ $blog->title }}</h3>
            <p class="fs-6 text-secondary">
                <a href="/?username={{ $blog->author->username }}{{ request(" searchblog") ? "&searchblog="
                    .request("search") : null }}{{ request("category") ? "&category=" .request("category") : null }}"
                    class="text-decoration-none">
                    {{ $blog->author->name}}
                </a>
                <span> - {{ $blog->created_at->diffForHumans() }}</span>
            </p>
            <div class="tags my-3">
                <a href="/?category={{ $blog->category->slug }}">
                    <span class="badge bg-warning">{{ $blog->category->name }}<span>
                </a>
            </div>
            <p class="card-text">
                {{ $blog->intro }}
            </p>
            <a href="/blogs/{{ $blog->slug }}" class="btn btn-primary">Read More</a>
        </div>
    </div>
</div>
