@extends('layouts.app')
@section('title', __('Home'))
@section('content')
<section class="content-main container block-group is--fullscreen">
    <div class="content-main--inner">
        <div class="content--wrapper">
            <div class="content content--home">
                <div class="content--emotions">
                    <div class="emotion--wrapper is--fullscreen">

                        <section class="emotion--container emotion--column-12 emotion--mode-resize emotion--0" data-emotion="true" data-gridmode="resize" data-fullscreen="true" data-columns="12" data-cellspacing="0" data-cellheight="80" data-basewidth="1160">

                            <div class="emotion--element row-1 start-col-1 start-row-1 col-xs-12 start-col-xs-1 row-xs-7 start-row-xs-1 col-s-12 start-col-s-1 row-s-7 start-row-s-1 col-m-12 start-col-m-1 row-m-7 start-row-m-1 col-l-12 start-col-l-1 row-l-7 start-row-l-1 col-xl-12 start-col-xl-1 row-xl-8 start-row-xl-1" style="padding-left: 0rem; padding-bottom: 0rem; height: 100%; top: 0%;padding-right: 0;">

                                <div class="full-video" data-fullvideo="true">
                                    {{-- <video poster="images/parallax1.jpg" playsinline="" autoplay="" muted="" loop="">
                                        <source src="/video/giphy.mp4" type="video/mp4">
                                    </video> --}}
                                    <div class="youhover"></div>
                                    <iframe 
                                    style="width: 100%;height: 100%" 
                                    src="https://www.youtube.com/embed/{{ youtube_code($pages->firstWhere('page', 'video')->content) }}?autoplay=1&controls=0&frameborder=0&showinfo=0&loop=1&mute=1&playlist={{ youtube_code($pages->firstWhere('page', 'video')->content) }}" allow="autoplay">
                                    </iframe>
                                </div>

                            </div>

                            <div class="emotion--sizer-xs col--1" data-rows="7" style="height: 560px;"></div>

                            <div class="emotion--sizer-s col--1" data-rows="7" style="height: 560px;"></div>

                            <div class="emotion--sizer-m col--1" data-rows="7" style="height: 560px;"></div>

                            <div class="emotion--sizer-l col--1" data-rows="7" style="height: 560px;"></div>

                            <div class="emotion--sizer-xl col--1" data-rows="8" style="height: 640px;"></div>

                            <div class="emotion--sizer col-1" data-rows="1" style="height: 80px;"></div>

                        </section>
                    </div>
                    
                    <div class="catelouge">

                        <div class="row no-gutters">
                            <div class="col-sm-12">
                                <div class="divide">
                                    <a href="/en/products/">
                                        <h1 class="divider--headline">{{__('Our online catalogue')}}</h1>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row no-gutters">
                            <div class="col-sm-12">
                                <div class="tiles--main">
                                    @foreach(\App\Admin\Product\Product::groupBy('category')->get() as $category)
                                    <div class="tiles--entry">
                                        <div class="tiles--image tiles--image--{{ $loop->iteration % 2 == 0 ? 2 : 5 }}" style="background: url('{{$category->getMedia('images')->first()->getUrl()}}') center no-repeat; background-size: cover;">&nbsp;</div>
                                        <a class="tiles--link" title="{{ \Str::title(str_replace('_', ' ', $category->category)) }}" href="{{route('products.category', $category->category)}}"> 
                                            <span class="tiles--label">
                                                @if(app()->getLocale() == 'ar')
                                                {{ $category->category_ar }}
                                                @else
                                                {{ \Str::title(str_replace('_', ' ', $category->category)) }}
                                                @endif
                                            </span> 
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="about-us">

                        <div class="row no-gutters">
                            <div class="col-sm-12">
                                <div class="divide">
                                    <a href="javascript:void(0);">
                                        <h1 class="divider--headline">{{__('Who we are')}}</h1>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="row no-gutters">
                                <div class="col-sm-7">
                                    <div class="parallaxs"></div> 
                                </div>
                                <div class="col-sm-5">
                                    <div class="text-box">
                                        <div class="dig-pub--text">
                                            @if(app()->getLocale() == 'ar')
                                            {!! $pages->where('page', 'home-who-we-are')->first()->content_ar !!}
                                            @else
                                            {!! $pages->where('page', 'home-who-we-are')->first()->content !!}
                                            @endif
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                    </div>

                    <div class="newslatter">

                        <div class="row no-gutters">
                            <div class="col-sm-12">
                                <div class="divide">
                                    <a href="javascript:void(0);">
                                        <h1 class="divider--headline">{{__('Join our newsletter')}}</h1>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="newsletter">
                                        <form action="{{route('newsletter')}}" method="post" class="row justify-content-md-center">
                                        @csrf @honeypot
                                            <input type="email" name="email" class="col-sm-6">
                                            <input type="submit" class="btn is--warning col-sm-1 offset-md-1 p-0" value="{{__('Go')}}">
                                        </form>
                                    </div> 
                                </div>
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

@if (Session::has('newsletter'))
    <script type="text/javascript">
        alert('Thank you for join our newsletter');
    </script>
@endif

@endsection