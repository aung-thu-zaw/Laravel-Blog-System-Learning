<x-admin-layout>

    <h3 class="mt-5 p-5 text-center">Blogs</h3>
    <div class="card d-flex p-3 my-3 shadow-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">intro</th>
                    <th scope="col" colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($blogs as $blog)
                <tr>
                    <td scope="row"><a href="/blogs/{{ $blog->slug }}" target="_blank">{{ $blog->title }}</a></td>
                    <td>{{ $blog->intro }}</td>
                    <td>
                        <a href="/admin/blogs/{{ $blog->slug }}/edit" class="btn btn-warning">Edit</a>
                    </td>
                    <td>
                        <form action="/admin/blogs/{{ $blog->slug }}/delete" method="POST">
                            @csrf

                            {{-- Overwrite Method --}}
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $blogs->links() }}

    </div>

</x-admin-layout>
