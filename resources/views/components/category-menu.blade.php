<div>
    <!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->
</div>

<ul id="menu-header" class="menu">
    @foreach($categories->take(9) as $category)
        <li class="menu-item {{ $category->submenu->count() ? 'menu-item-has-children' : '' }}">
            <a href="{{ url('category/'.$category->slug) }}">{{ $category->name }}</a>
            @if($category->submenu->count())
                <ul class="sub-menu menu-sub-content">
                    @foreach($category->submenu as $sub)
                        <li class="menu-item">
                            <a href="{{ url('category/'.$sub->slug) }}">{{ $sub->name }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
