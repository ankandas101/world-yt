
<ul>
    @foreach($categories as $category)
        <li class="cat-item cat-item-{{ $category->id }}">
            <a href="{{ url('category/'.$category->slug) }}">{{ $category->name }}</a>
        </li>
    @endforeach
</ul>
