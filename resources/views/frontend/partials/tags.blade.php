@php
$tags = App\Models\Product::where('status', true)
->where('tags', '!=', '')
->pluck('tags')
->flatMap(fn ($item) => explode(',', $item))
->map(fn ($item) => trim($item))
->unique()
->filter()
->values();
@endphp
<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">Product tags</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">
            @foreach($tags->take(15) as $tag)
            <a class="item {{ request()->route('tag') == $tag ? 'active' : '' }}" title="{{ $tag }}"
                href="{{ route('frontend.tag', urlencode($tag)) }}">
                {{ $tag }}
            </a>
            @endforeach
        </div>
    </div>
</div>