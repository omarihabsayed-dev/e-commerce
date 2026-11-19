@php
$navCategories = App\Models\Category::with(['subCategories.subSubCategories'])
->orderBy('name', 'asc')
->get();
@endphp
<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">

            @foreach($navCategories->take(8) as $category)
            <li class="dropdown menu-item"> <a href="{{ url('/category/' . $category->slug) }}" class="dropdown-toggle"
                    data-toggle="dropdown"><i class="icon {{ $category->icon }}" aria-hidden="true"></i>{{
                    $category->name }}</a>
                @if($category->subCategories->count() > 0)
                <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        <div class="row">
                            @foreach($category->subCategories as $sub)
                            <div class="col-sm-12 col-md-3">
                                <a href="{{ route('frontend.subcategory', $sub->slug) }}">
                                    <h2 class="title">{{ $sub->name }}</h2>
                                </a>
                                <ul class="links list-unstyled">
                                    @foreach($sub->subSubCategories as $subsub)
                                    <li><a href="{{ route('frontend.subsubcategory', $subsub->slug) }}">{{
                                            $subsub->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- /.yamm-content -->
                </ul>
                @endif
                <!-- /.dropdown-menu -->
            </li>
            @endforeach
            <!-- /.menu-item -->
        </ul>
        <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>
<!-- /.side-menu -->