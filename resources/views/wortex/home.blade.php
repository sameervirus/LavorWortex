@extends('wortex.layouts.app')
@section('title', __('Home'))
@section('content')
    <div class="home-banner" dir="ltr">
        @foreach($slides as $slide)
        <div><img class="sl-img" src="{{asset('images/slider/' . $slide->image)}}"></div>
        @endforeach
    </div>
    <section class="bg-grey">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-xl-8 text-center">
                    <h2 class="font-weight-bold">{{__('Who we are')}}</h2>
                    <div class="section-body">
                        @if(app()->getLocale() == 'ar')
                        {!! $pages->where('page', 'who-we-are')->first()->content_ar !!}
                        @else
                        {!! $pages->where('page', 'who-we-are')->first()->content !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-transparent bg-white">
        <div class="container">
            <div class="row row-40 flex-lg-row-reverse">
                <div class="col-lg-5 text-center">
                    <img src="{{asset('images/wortex-logo.png')}}" alt="" width="100%" style="margin-top: 30%">
                </div>
                <div class="col-lg-7">
                    <h2>Wortex</h2>
                    @if(app()->getLocale() == 'ar')
                    {!! $pages->where('page', 'wortex')->first()->content_ar !!}
                    @else
                    {!! $pages->where('page', 'wortex')->first()->content !!}
                    @endif
                </div>
            </div>
        </div>
    </section>
    @if($posts->count() > 0)
    <section class="section section-xl bg-default {{ app()->getLocale() == 'ar' ? 'text-md-right dir-ltr':'text-md-left'}}">
        <div class="container">
            <div class="tabs-custom tabs-post" id="tabs-9">
                <div class="row align-items-md-end align-items-xl-start">
                    <div class="col-md-6 tab-content-3 wow fadeInUp">
                        <div class="tab-content">
                            @foreach($posts as $post)
                            <div class="tab-pane fade show {{ $loop->index == 0 ? 'active' : '' }}" id="tabs-9-{{ $loop->iteration }}">
                                <div class="post-amy-figure">
                                    <img src="{{ $post->getFirstMedia('post_img')->getUrl() }}" alt="" width="570" height="505">
                                    <a href="{{ route('wortex.post', $post->slug) }}"><span class="icon linearicons-link2"><i class="fas fa-link"></i></span></a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6 index-1">
                        <h3 class="tabs-post-title oh-desktop"><span class="d-inline-block wow slideInDown">{{__('News & events')}}</span></h3>
                        <ul class="nav nav-tabs">
                            @foreach($posts as $post)
                            <li class="nav-item wow fadeInRight" role="presentation"><a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}" href="#tabs-9-{{ $loop->iteration }}" data-toggle="tab"></a>
                                <div class="post-amy">
                                    <h5 class="post-amy-title"><a href="{{ route('wortex.post', $post->slug) }}">{{ app()->getLocale() == 'ar' ? $post->title_ar:$post->title }}</a></h5>
                                    <ul class="post-amy-info list-inline">
                                        <li class="post-amy-time"><span class="icon fas fa-clock"></span>
                                            <time datetime="{{ $post->updated_at->format('Y-m-d') }}">{{ Carbon\Carbon::createFromDate( $post->updated_at->format('Y-m-d') )->diffForHumans() }}</time>
                                            
                                    </ul>
                                </div>
                            </li>
                            @endforeach                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection