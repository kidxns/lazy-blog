<div class="col-12 mt-3 animated fadeInUp">
    <ul class="list-group">
        @foreach($categories ?? '' as $category)
        <a href="">
            <li class="list-group-item d-flex justify-content-between align-items-center text-dark text-capitalize fz-13 border-0">
                {{ $category -> categories  }}
                <kbd class="fz-12">{{ count($category->posts) }}</span>
            </li>
            <hr />
        </a>
        @endforeach
    </ul>
</div>
