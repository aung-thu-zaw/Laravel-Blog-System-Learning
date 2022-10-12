<div class="">
    <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
            data-bs-toggle="dropdown">
            {{ isset($currentCategory) ? $currentCategory->name : "Filter By Category" }}
        </a>

        <ul class="dropdown-menu">
            @foreach ($categories as $category)
            <li>
                <a class="dropdown-item" href="/?category={{ $category->slug }}{{ request("searchblog")
                    ? "&searchblog=" .request("searchblog") : null }} {{request("username") ? "&username="
                    .request("username") : null }} ">
                    {{ $category->name }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
