<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if(app()->getLocale() == 'ar') dir="rtl" @endif>
<head>
    <meta charset="utf8mb4">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ $site_content['title']  ?? '' . ' - ' . $site_content['description'] ?? '' }}</title>
    <meta name="description" content="{{$site_content['title']}} {{ $site_content['description'] }}">
    <meta name="keywords" content="{{$site_content['title']}},{{$site_content['keywords']}}">
    <link rel="icon" type="image/png" href="{{ asset('images/'. $site_content['favicon']) }}">

    @if(Route::currentRouteName() != 'products.product')
    <!-- Open Graph -->
    <meta property="og:title" content="{{ $site_content['title'] }}" />
    <meta property="og:type" content="Trading Company" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:description" content="{{ $site_content['description'] }}" />
    <meta property="og:image" content="{{url('images/main_image.png')}}" />
    @endif

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-154353990-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-154353990-2');
    </script>


    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('node_modules/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Red+Hat+Display:400,500,700,900&amp;display=swap">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/core.min.css') }}">
    @yield('cssFiles', '')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}?v={{time()}}">
    @if(app()->getLocale() == 'ar')
        <link href="{{ asset('css/ar.css') }}?v={{time()}}" rel="stylesheet">
    @endif
    <style type="text/css">
        :root {
            --main: #495057;
            --second: #1864ab;
            --second-light: #3d87cc;
        }
    </style>
</head>

<body>
	<div class="preloader">
      <div id="splash" style="background-image: url('{{ asset('images/splash.jpg')}}');"></div>
    </div>
    <div class="page">
    <input type="checkbox" id="mobi-toggle">
    <div class="pumps-1">
        <div class="menu-home">
            <div class="pumps-header">
                <div class="menu-home-time"><span class="top-icons icon-top-time fas fa-clock"></span>{{ $site_content['opening'] }} </div>
                <div class="menu-home-contact">
                    <a href="tel:{{ $site_content['mob'] }}"><span class="top-icons icon-top-tel fas fa-phone-alt"></span> {{ $site_content['mob'] }} </a>
                    <a href="mailto:{{ $site_content['email'] }}"><span class="top-icons icon-top-mail fas fa-envelope"></span>{{ $site_content['email'] }}</a>
                    </script>
                </div>
            </div>
        </div>
        <div class="menu-top-container">
            <div class="pumps-header">
                <div class="logo" itemscope="" itemtype="http://schema.org/Organization">
                    <a href="{{route('wortex.home')}}" itemprop="url" title="{{ $site_content['title'] }}"><img itemprop="logo" src="{{asset ('images/'. $site_content['logo'])}}" alt="{{ $site_content['title'] }}"></a>
                </div>
                <label id="navOverlay" for="mobi-toggle"></label>
                <div class="menu-top">
                    <label for="mobi-toggle"><i class="fa fa-bars"></i></label>
                    <div id="mainNav">
                        <ul class="navx navbar-navx">
                            <li class="dropdown home-active"><a href="{{route('wortex.home')}}">{{__('Home')}}</a></li>
                            <li class="dropdown"><a href="javascript:void(0)">{{__('Products')}}</a>
                                <ul class="dropdown-menux">
                                    @foreach(\App\Admin\Wproduct::groupBy('category')->get() as $category)
                                    <li><a href="{{route('wortex.category',$category->category)}}">
                                        @if(app()->getLocale() == 'ar')
                                            {{ $category->category_ar }}
                                            @else
                                            {{ \Str::title(str_replace('_', ' ', $category->category)) }}
                                            @endif
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown"><a href="{{route('wortex.news')}}">{{__('News & events')}}</a></li>
                            <li class="dropdown"><a href="{{route('wortex.distributors')}}">{{__('Distributors')}}</a></li>
                            <li class="dropdown"><a href="{{route('wortex.contacts')}}">{{__('Contact us')}}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="widget-container">
                    <div class="social-top">
                        @foreach ($site_content as $key => $value)
                        @if (Str::startsWith($key,'social_') && @$value && $key != 'social_rss')
                            <a href="{{$value}}" target="_blank">
                                <i class="fab fa-{{ str_replace('social_','',$key)}}"></i>
                            </a>
                        @endif
                        @endforeach
                        @foreach (language()->allowed() as $code => $name)
                            <a href="{{ language()->back($code) }}" title="{{ $name }}" class="lang-flags">
                                <img src="{{ asset('images/'. $code . '.png') }}"></a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('content')
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <strong>© {{ $site_content['title'] }} <span class="copyright-year">2020</span><span></span></strong>
                    <br>
                    <br>
                    <a href="{{route('wortex.home')}}" title="{{ $site_content['title'] }}"><img src="{{asset ('images/'. $site_content['logo'])}}" alt="{{ $site_content['title'] }}"></a>
                </div>
                <div class="col-md-4">
                    <strong>{{__('Products')}}<span></span></strong>
                    <ul>
                        @foreach(\App\Admin\Wproduct::groupBy('category')->get() as $category)
                        <li><a href="{{route('wortex.category',$category->category)}}">
                            @if(app()->getLocale() == 'ar')
                            {{ $category->category_ar }}
                            @else
                            {{ \Str::title(str_replace('_', ' ', $category->category)) }}
                            @endif
                        </a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-4" itemscope="" itemtype="http://schema.org/Organization">
                    <div class="footer-contact">
                        <strong>{{__('Contact us')}}<span></span></strong>
                        <p>
                            <a href="tel:{{ $site_content['mob'] }}"><span class="footer-icon"><i class="fa fa-phone"></i></span><span itemprop="telephone">{{ $site_content['mob'] }}</span></a>
                            <br>
                            <a href="mailto:{{ $site_content['email'] }}"><span class="footer-icon"><i class="fa fa-envelope"></i></span>{{ $site_content['email'] }}</a>
                            <br>
                            @foreach ($site_content as $key => $value)
                            @if (Str::startsWith($key,'social_') && @$value && $key != 'social_rss')
                                <a href="{{$value}}" target="_blank">
                                    <span class="footer-icon"><i class="fab fa-{{ str_replace('social_','',$key)}}"></i></span>
                                </a>
                            @endif
                            @endforeach
                        </p>
                    </div>
                    <div id="mc_embed_signup">
                        <form action="{{route('wortex.newsletter')}}" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate">
                            @csrf @honeypot
                            <div id="mc_embed_signup_scroll" class="footer-newsletter">
                                <div>
                                    <input type="email" value="" name="email" class="required email" id="mce-EMAIL" placeholder="{{__('Subscribe to our newsletter')}}">
                                </div>
                                <div>
                                    <input type="submit" value="{{__('Go')}}" name="subscribe" id="mc-embedded-subscribe" class="›">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--End mc_embed_signup-->
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <ul>
                <li><a href="{{route('wortex.home')}}">{{__('All rights reserved')}} © {{ $site_content['title'] }}</a></li>
                <li><a href="/sitemap.xml">{{__('Sitemap')}}</a></li>
                <li class="{{ app()->getLocale() == 'ar' ? 'float-left' : 'float-right'}}"><a href="//www.raindesigner.com" target="_blank" rel="nofollow">{{__('Powered by')}} RainDesigner</a></li>
            </ul>
        </div>
    </div>
    </div>
    <script src="{{ asset('js/core.min.js')}}?v=2"></script>
    @yield('jsFiles')
    <script src="{{ asset('js/script.js')}}?v=2"></script>
    @if (Session::has('newsletter'))
        <script type="text/javascript">
            @if(Session::get('newsletter') == 'success')
            alert('Thank you for join our newsletter');
            @elseif(Session::get('newsletter') == 'fail')
            alert('Something went wrong please try again');
            @endif
        </script>
    @endif
</body>

</html>