<x-admin-layout>


    <h3 class="text-center my-5 pt-5">Blog Create Form</h3>


        <div class="card d-flex p-3 my-3 shadow-sm">
            <form action="/admin/blogs/store" method="POST" enctype="multipart/form-data">
                @csrf
                <x-form.input name="title" />
                <x-form.input name="slug" />
                <x-form.input name="intro" />
                <x-form.textarea name="body" />
                <x-form.input name="thumbnail" type="file" />

                <x-form.input-wrapper>
                    <x-form.label name="Category" />
                    <select name="category_id" id="selectBox" class="form-control">
                        @foreach ($categories as $category)
                        <option {{ $category->id==old("category_id") ? "selected" : "" }} value="{{ $category->id }}">{{
                            $category->name
                            }}</option>
                        @endforeach
                    </select>
                    <x-error name="category_id" />
                </x-form.input-wrapper>


                <div class="d-grid my-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

</x-admin-layout>
