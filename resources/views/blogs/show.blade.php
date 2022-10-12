<x-layout>
    <!-- singloe blog section -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 my-5 mx-auto text-center">
                <img src="/storage/{{ $blog->thumbnail }}" class="card-img-top my-2" alt="..." />

                <h3 class="my-2">{{ $blog->title }}</h3>


                <p class="fs-6 text-secondary">
                    <a href="/?username={{ $blog->author->username }}" class="text-decoration-none">
                        {{ $blog->author->name}}
                    </a>
                    <span> - {{ $blog->created_at->diffForHumans() }}</span>
                </p>

                <div class="tags my-3">
                    <a href="/?category={{ $blog->category->slug }}">
                        <span class="badge bg-warning">{{ $blog->category->name }}<span>
                    </a>
                </div>

                <!-- Subscribe From  -->

                <div class="my-3">
                    @auth
                    <form action="/blogs/{{ $blog->slug }}/subscription" method="POST">
                        @csrf

                        @if (auth()->user()->isSubscribed($blog))

                        <button type="submit" class="btn btn-danger">Unsubscribe</button>

                        @else

                        <button type="submit" class="btn btn-primary text-white">Subscribe</button>
                        @endif

                    </form>
                    @endauth
                </div>



                <p class="lh-md">
                    {!! $blog->body !!}
                </p>
            </div>
        </div>
    </div>

    <!-- Blog Comment Box -->
    @auth
    <x-blog-comment-box :blog="$blog" />
    @else
    <p class="text-center">Please <a href="/login" class="fw-bold">login</a> to participate in this discussion.</p>
    @endauth


    <!-- Blog Comments -->
    @if ($blog->comments->count())
    <x-blog-comments :comments="$blog->comments()->latest()->paginate(3)" />
    @endif

    <!-- blogs you may like -->
    <x-blogs-you-may-like :randomBlogs="$randomBlogs" />

    <!-- Footer -->
    <x-footer-section />



</x-layout>
