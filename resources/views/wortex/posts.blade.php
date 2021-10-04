@extends('wortex.layouts.app')
@section('title', __('News & events'))
@section('content')

<div class="page-title">
    <div class="title-block">
        <div>
            <h1>{{__('News & events')}}</h1>
        </div>
        <div class="breadcrumb"><a href="{{route('wortex.home')}}">{{__('Home')}}</a>&nbsp;&nbsp;/&nbsp;&nbsp;{{__('News & events')}}</div>
    </div>
</div>

<section class="section section-lg bg-default">
    <div class="container">
        <div class="row row-40 justify-content-center">
            @forelse($items as $post)
            <div class="col-md-6 col-lg-5 col-xl-4">
                
                <!-- Services Classic-->
                <article class="services-classic">
                    <a class="services-classic-figure" href="{{ route('wortex.post', $post->slug) }}"><img src="{{ $post->getFirstMedia('post_img')->getUrl() }}" alt="" width="370" height="274"></a>
                    <div class="services-classic-caption">
                        <div class="unit align-items-lg-center">
                            <div class="unit-left"><span class="services-classic-icon mdi mdi-road-variant"></span></div>
                            <div class="unit-body">
                                <h5 class="services-classic-title"><a href="{{ route('wortex.post', $post->slug) }}">{{ app()->getLocale() == 'ar' ? $post->title_ar:$post->title }}</a></h5>
                            </div>
                        </div>
                    </div>
                </article>
                
            </div>
            @empty
            <h1>No News & Event at this time</h1>
            @endforelse

        </div>
    </div>
</section>

@endsection
@section('jsFiles')

@endsection