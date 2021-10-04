@extends('layouts.app')
@section('title', __('News & events'))
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
                <a class="breadcrumb--link" href="{{route('news')}}" title="{{__('News & events')}}" itemprop="item">
                    <link itemprop="url" href="{{route('news')}}">
                    <span class="breadcrumb--title" itemprop="name">{{__('News & events')}}</span>
                </a>
                <meta itemprop="position" content="0">
            </li>            
        </ul>
    </nav>

    <div class="products content-main--inner">
        <div class="content--wrapper">
            <div class="row">
                <div class="col-md-2">
                    
                </div>
                <div class="col-md-8">
                    <div class="custom-page--content content block">
                        <div class="content--custom">
                            <h1 class="custom-page--tab-headline">{{__('News & events')}}</h1>
                            @foreach($items as $item)
                            <div class="news-listing--entry">
                                <div class="news-listing--image-wrap">
                                    <a href="{{ route('post', $item->slug) }}" class="news-listing--image-link" title="{{ $item->title }}">
                                        <img src="{{ $item->getFirstMedia('post_img')->getUrl('thumb') }}" alt="{{ $item->title }}" class="news-listing--image">
                                    </a>
                                </div>
                                <div class="news-listing--content">
                                    <h2 class="news-listing--title">
                                        <a href="{{ route('post', $item->slug) }}" title="{{ $item->title }}">
                                            @if(app()->getLocale() == 'ar')
                                            {{ $item->title_ar }}
                                            @else
                                            {{ $item->title }}
                                            @endif
                                        
                                        </a>
                                    </h2>
                                    <span class="news-listing--date">{{ date('F j, Y', strtotime($item->updated_at)) }}</span>

                                    <div class="news-listing--text">
                                        @if(app()->getLocale() == 'ar')
                                        {{\Str::limit(strip_tags($item->body_ar),50,'...')}}
                                        @else
                                        {{\Str::limit(strip_tags($item->body),50,'...')}}
                                        @endif
                                    </div>

                                    <a href="{{ route('post', $item->slug) }}" class="news-listing--link" title="{{ $item->title }}">
                                        <i class="fa fa-chevron-right" aria-hidden="true"></i> {{__('Read more')}}
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
@section('jsFiles')

@endsection