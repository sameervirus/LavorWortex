@extends('layouts.app')
@section('title', app()->getLocale() == 'ar' ? $post->title_ar : $post->title)
@section('cssFiles')
<link rel="stylesheet" href="{{asset('vendors/fancybox-3.0/dist/jquery.fancybox.min.css')}}">
@endsection
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
            <li class="breadcrumb--separator">&nbsp;</li>
            <li class="breadcrumb--entry" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a class="breadcrumb--link" href="{{route('post', $post->slug)}}" title="{{ $post->title }}" itemprop="item">
                    <link itemprop="url" href="{{route('post', $post->slug)}}">
                    <span class="breadcrumb--title" itemprop="name">{{ app()->getLocale() == 'ar' ? $post->title_ar : $post->title }}</span>
                </a>
                <meta itemprop="position" content="0">
            </li>            
        </ul>
    </nav>

    <div class="content-main--inner">
        <div class="content--wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="custom-page--content content block">
                        <div class="content--custom">
                            <div class="news--main">
                                <div class="news--date mb-3">{{ date('F j, Y', strtotime($post->updated_at)) }}</div>
                                <h1 class="news--title mb-3">{{ app()->getLocale() == 'ar' ? $post->title_ar : $post->title }}</h1>
                                <div class="news--content">
                                    <div class="news-text-wrap">
                                        {!! app()->getLocale() == 'ar' ? $post->body_ar : $post->body !!}
                                    </div>
                                </div>
                                @if($post->hasMedia('post_img'))
                                <div class="news--gallery">
                                    @foreach($post->getMedia('post_img') as $image)
                                    <div class="news--gallery-item">
                                        <span class="news--gallery-link">
                                            <a href="{{ $image->getUrl() }}" data-fancybox="group">
                                            <img src="{{ $image->getUrl('thumb') }}" class="news--gallery-image" alt=""></a>
                                        </span>
                                    </div>
                                    @endforeach                                    
                                </div>
                                @endif
                                <div class="news--overview">
                                    <a href="{{route('news')}}" class="news--overview-link" title="To the news overview">
                                        <i class="fa fa-chevron-left" aria-hidden="true"></i> {{__('To the news overview')}}
                                    </a>
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
<script src="{{asset('vendors/fancybox-3.0/dist/jquery.fancybox.min.js')}}"></script>
@endsection