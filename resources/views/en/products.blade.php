@extends('layouts.app')
@section('title', 'Products')
@section('content')
<section class="content-main container block-group">

    <nav class="content--breadcrumb block">
        <ul class="breadcrumb--list" role="menu" itemscope="" itemtype="http://schema.org/BreadcrumbList">
            <li class="breadcrumb--entry is--home" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a class="breadcrumb--link" href="{{route('home')}}" title="Home" itemprop="item">
                    <link itemprop="url" href="{{route('home')}}">
                    <span class="breadcrumb--title" itemprop="name"><i class="fa fa-home" aria-hidden="true"></i></span>
                </a>
            </li>
            <li class="breadcrumb--separator">&nbsp;</li>
            <li class="breadcrumb--entry is--active" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a class="breadcrumb--link" href="{{route('products.products')}}" title="Products" itemprop="item">
                    <link itemprop="url" href="{{route('products.products')}}">
                    <span class="breadcrumb--title" itemprop="name">{{__('Products')}}</span>
                </a>
                <meta itemprop="position" content="0">
            </li>
        </ul>
    </nav>

    <div class="products content-main--inner">
        <div class="content--wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="html--title">
                        {{__('Products')}}
                    </div>

                    <div class="html--content">
                        <p>{{__('Here you find our complete product lineup')}}:</p>
                    </div>
                </div>
            </div>
            <div class="row is--ctl-listing">
                <div class="col-md-12 emotion--wrapper">
                    <div class="html--content">
                        <div class="catalog--main">
                            @foreach(\App\Admin\Product\Product::groupBy('category')->get() as $category)
                            <a class="catalog--entry" title="{{ \Str::title(str_replace('_', ' ', $category->category)) }}" href="{{route('products.category', $category->category)}}"> <img class="catalog--image" src="{{$category->getMedia('images')->first()->getUrl('thumb')}}" alt="{{ \Str::title(str_replace('_', ' ', $category->category)) }}"> <span class="catalog--label">
                                @if(app()->getLocale() == 'ar')
                                {{ $category->category_ar }}
                                @else
                                {{ \Str::title(str_replace('_', ' ', $category->category)) }}
                                @endif
                            </span> </a>
                            @endforeach                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
