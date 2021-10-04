@extends('layouts.app')
@section('title', \Str::title(str_replace('_', ' ', $products->first()->category)))
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
            <li class="breadcrumb--entry" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a class="breadcrumb--link" href="{{route('products.products')}}" title="Products" itemprop="item">
                    <link itemprop="url" href="{{route('products.products')}}">
                    <span class="breadcrumb--title" itemprop="name">{{__('Products')}}</span>
                </a>
                <meta itemprop="position" content="0">
            </li>
            <li class="breadcrumb--separator">&nbsp;</li>
            <li class="breadcrumb--entry is--active" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a class="breadcrumb--link" href="{{route('products.category', $products->first()->category)}}" title="{{\Str::title(str_replace('_', ' ', $products->first()->category))}}" itemprop="item">
                    <link itemprop="url" href="{{route('products.category', $products->first()->category)}}">
                    <span class="breadcrumb--title" itemprop="name">
                        @if(app()->getLocale() == 'ar')
                        {{ $products->first()->category_ar }}
                        @else
                        {{ \Str::title(str_replace('_', ' ', $products->first()->category)) }}
                        @endif
                    </span>
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
                        @if(app()->getLocale() == 'ar')
                        {{ $products->first()->category_ar }}
                        @else
                        {{ \Str::title(str_replace('_', ' ', $products->first()->category)) }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div id="six--framemenu" class="col-md-12">
                        @foreach($products as $product)
                        <div class="framemenu--list-item column-desktop--3 column-tablet--3">
                            <div class="framemenu--list-item-box is-mobile--button">
                                <a class="framemenu--list-item-image" href="{{route('products.product', [$product->category, $product->model])}}" title="{{\Str::title(str_replace('_', ' ', $product->model))}}" style="height:287px; background: url({{$product->getMedia('images')->first()->getUrl('thumb')}}) no-repeat center center;"></a>
                                <a class="framemenu--list-item-link link-row-desktop--1 link-row-tablet--1" href="{{route('products.product', [$product->category, $product->model])}}" title="{{\Str::title(str_replace('_', ' ', $product->model))}}">
                                    @if(app()->getLocale() == 'ar')
                                    {{$product->model_ar}}
                                    @else
                                    {{\Str::title(str_replace('_', ' ', $product->model))}}
                                    @endif
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
