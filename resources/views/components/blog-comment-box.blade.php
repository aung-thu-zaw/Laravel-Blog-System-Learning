@props(["blog"])
<section class="container">
    <div class="col-md-10 mx-auto">
        <div class="card d-flex p-3 my-3 shadow-sm">
            <form action="/blogs/{{ $blog->slug }}/comments" method="POST">
                @csrf
                <div class="mb-3">
                    <textarea class="form-control" name="comment" cols="10" rows="5"
                        placeholder="Say Something ..."></textarea>

                    <x-error name="comment" />
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>
