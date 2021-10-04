@extends('wortex.layouts.app')
@section('title', app()->getLocale() == 'ar' ? $post->title_ar : $post->title)
@section('content')

<div class="page-title">
    <div class="title-block">
        <div>
            <h1>{{__('News & events')}}</h1>
        </div>
        <div class="breadcrumb"><a href="{{route('wortex.home')}}">{{__('Home')}}</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="{{route('wortex.news')}}">{{__('News & events')}}</a>&nbsp;&nbsp;/&nbsp;&nbsp;{{ app()->getLocale() == 'ar' ? $post->title_ar : $post->title }}</div>
    </div>
</div>

<section class="section section-lg bg-default">
    <div class="container">
        <div class="row row-60 row-xl-75">
            <div class="col-lg-8">
                <div class="single-post section-style-2">
                    <h5 class="text-spacing-50 font-weight-normal text-transform-none">{{ app()->getLocale() == 'ar' ? $post->title_ar : $post->title }}</h5>
                    <div class="group-md group-middle mb-2">
                        <time class="post-classic-time" datetime="{{ $post->updated_at->format('Y-m-d') }}">
                        {{  app()->getLocale() == 'ar' ? ArabicDate($post->updated_at) : $post->updated_at->format('F j, Y') }}</time>
                    </div>
                    <img src="{{ $post->getFirstMedia('post_img')->getUrl() }}" alt="" width="100%">
                    @if(app()->getLocale() == 'ar')
                    {!! $post->body_ar !!}
                    @else
                    {!! $post->body !!}
                    @endif
                    <div class="row">
                        @foreach($post->getMedia('post_img') as $image)
                        @continue($loop->index == 0)
                        <div class="col-md-4">
                            <a class="fancybox" href="{{ $image->getFullUrl() }}" rel="group">
                                <img src="{{ $image->getUrl('thumb') }}" class="w-100" alt="{{ $image->name }}">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="inset-left-xl-40">
                    <div class="aside row row-60 row-xl-75">

                        <div class="aside-item col-md-6 col-lg-12">
                            <h6 class="aside-title">{{__('Popular News & Event')}}</h6>
                            <div class="list-popular-post">
                                @foreach(App\Admin\Post::orderBy('updated_at', 'DESC')->get() as $item)
                                @continue($post->id == $item->id)
                                <div class="list-popular-post-item">
                                    <!-- Post Minimal-->
                                    <article class="post post-minimal">
                                        <div class="unit unit-spacing-2 align-items-center unit-spacing-md">
                                            <div class="unit-left">
                                                <a class="post-minimal-figure" href="{{ route('wortex.post', $item->slug) }}"><img src="{{ $item->getFirstMedia('post_img')->getUrl('thumb') }}" alt="" width="106" height="104"></a>
                                            </div>
                                            <div class="unit-body">
                                                <p class="post-minimal-title"><a href="{{ route('wortex.post', $item->slug) }}">{{ app()->getLocale() == 'ar' ? $item->title_ar : $item->title }}</a></p>
                                                <div class="post-minimal-time">
                                                    <time datetime="{{ $item->updated_at->format('Y-m-d') }}">{{ app()->getLocale() == 'ar' ? ArabicDate($post->updated_at) : $post->updated_at->format('F j, Y') }}</time>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
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