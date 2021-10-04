@extends('wortex.layouts.app')
@section('title', \Str::title(str_replace('-', ' ', $products->first()->category)))
@section('content')

<div class="solar-pumps-2">
    <div class="solar-pumps-section">
        <div class="water-pumps" id="Divider_ProductDetails" style="visibility: visible; display: block; position: static;">
            <div xmlns="http://www.w3.org/1999/xhtml" class="pro-main">
                
                <div class="nav_table">
                    <div class="nav_back">
                        <a href="javascript:void(0)" onclick="javascript:history.go(-1)">
                            <span class="arrow-back">◄</span> {{__('Back')}}
                        </a>
                    </div>
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                    <div class="nav_history" id="Tree_ecat_history" style="visibility: visible;"><a href="javascript:void(0);"><u>{{ app()->getLocale() == 'ar' ? $products->first()->category_ar : \Str::title(str_replace('-', ' ', $products->first()->category)) }}</u></a></div>
                    <div class="nav_page" id="page_navigation" style="visibility: visible; display: block;"></div>
                    <div class="row">&nbsp;</div>
                </div>
                <div class="nav_title pt-3 pb-3">
                    <div>
                        <h1>{{ app()->getLocale() == 'ar' ? $products->first()->category_ar : \Str::title(str_replace('-', ' ', $products->first()->category)) }}</h1></div>
                </div>
                <div class="row">&nbsp;</div>
                @if($products->count() > 0)
                @foreach($products as $product)
                <div class="pro-summary">
                    <a href="{{route('wortex.product', [$product->category, $product->slug])}}">
                        <div>
                            <img src="{{$product->getFirstMedia('images')->getUrl()}}" alt="{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name }}" itemprop="image">
                        </div>
                        <div>
                            <h3>{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name }}</h3>
                        </div>
                    </a>
                </div>
                @endforeach
                @endif
            </div>
            <div xmlns="http://www.w3.org/1999/xhtml" class="row"></div>
        </div>
    </div>
</div>
@endsection
