<!-- https://daisyui.com/components/breadcrumbs/ -->
<nav class="breadcrumbs pb-3 pt-4 text-sm sm:pt-4">
    <ul>
        @foreach ($breadcrumbs as $breadcrumb)
            @if($loop->last)
            <li>{{ $breadcrumb['name'] }}</li>
            @else
            <li><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a></li>
            @endif
        @endforeach
    </ul>
</nav>
