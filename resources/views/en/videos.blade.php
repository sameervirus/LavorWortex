@extends('layouts.app')
@section('title', \Str::title($items->first()->type ?? ''))
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
                <a class="breadcrumb--link" href="{{route('media.videos')}}" title="{{ __('Videos') }}" itemprop="item">
                    <link itemprop="url" href="{{route('media.videos')}}">
                    <span class="breadcrumb--title" itemprop="name">{{ __('Videos') }}</span>
                </a>
                <meta itemprop="position" content="0">
            </li>            
        </ul>
    </nav>

    <div class="products content-main--inner">
        <div class="content--wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <aside class="sidebar-main" style="display: block;">
                            <div class="sidebar--categories-wrapper">        
                                <div class="shop-sites--container" style="display: block;">
                                    <ul class="shop-sites--navigation sidebar--navigation navigation--list is--drop-down is--level0" role="menu">
                                        <li class="navigation--entry" role="menuitem">
                                            <a class="navigation--link" href="{{route('media.files')}}" title="{{ __('Downloads') }}">{{ __('Downloads') }}</a>
                                        </li>
                                        <li class="navigation--entry is--active" role="menuitem">
                                            <a class="navigation--link is--active" href="{{route('media.videos')}}" title="{{ __('Videos') }}">{{ __('Videos') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div>
                    <div class="col-md-8">
                        <div class="custom-page--content content block">
                            <div class="content--custom">
                                <h1 class="custom-page--tab-headline">{{ __('Videos') }}</h1>
                                @foreach($items->chunk(2) as $chunk)
                                <div class="grid--wrap is--twocol has--spacing-bottom">
                                    @foreach($chunk as $item)
                                    <div class="grid--column">
                                        <p>
                                            <strong>
                                                @if(app()->getLocale() == 'ar')
                                                {{ $item->name_ar }}
                                                @else
                                                {{ $item->name }}
                                                @endif
                                            </strong>
                                        </p>
                                        <div class="video--spacer">
                                            <iframe frameborder="0" src="https://www.youtube.com/embed/{{youtube_code($item->link)}}" width="100%" height="100%" allowfullscreen=""></iframe>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('jsFiles')

@endsection