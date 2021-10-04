<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if(app()->getLocale() == 'ar') dir="rtl" @endif>
<head>
    <meta charset="utf8mb4">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ $site_content['title']  ?? '' . ' - ' . $site_content['description'] ?? '' }}</title>
    <meta name="description" content="{{ $site_content['description'] }}">
    <meta name="keywords" content="{{$site_content['keywords']}}">
    <link rel="icon" type="image/png" href="{{ asset('images/'. $site_content['favicon']) }}">

    @if(Route::currentRouteName() != 'products.product')
    <!-- Open Graph -->
    <meta property="og:title" content="{{ $site_content['title'] }}" />
    <meta property="og:type" content="Trading Company" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:description" content="{{ $site_content['description'] }}" />
    <meta property="og:image" content="{{url('images/main_image.png')}}" />
    @endif
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">    
    <link rel="stylesheet" href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CLato%7CComfortaa:300,400,700%7COpen+Sans:300,400,600,700">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-UA-154353990-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-154353990-1');
    </script>

    <!-- Styles -->
    <link href="{{ asset('css/basscss.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-grid.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ui.css') }}" rel="stylesheet">
    @yield('cssFiles', '')

    <!--[if lt IE 10]>
    <div style='background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/..">
            <img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820"
                 alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."/>
        </a>
    </div>
    <script src="js/html5shiv.min.js"></script>
    <![endif]-->
    @if(app()->getLocale() == 'ar')
        <link href="{{ asset('css/ar.css') }}" rel="stylesheet">
    @endif
</head>
<body>
    <div class="page-wrap">
        <header class="header">
            <div class="header--navigation">
                <a class="logo" href="#" title="{{ $site_content['title'] }}"><img src="{{asset ('images/'. $site_content['logo'])}}" alt="{{ $site_content['title'] }}" class="logo--image"></a>
                <nav class="shop--navigation block-group">
                    <ul class="navigation--list block-group">
                        {{-- <li class="navigation--entry entry--search">
                            <a class="entry--link entry--trigger" href="#show-hide--search" title="Show / close Search">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </a>
                            <div class="main-search--wrap">
                                <form action="search" method="get" class="main-search--form ng-pristine ng-valid">
                                    <input type="search" name="sSearch" class="main-search--field" autocomplete="off" autocapitalize="off" placeholder="Search term..." maxlength="30">
                                    <button type="submit" class="main-search--button">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                        <span class="main-search--text">Search</span>
                                    </button>
                                    <div class="form--ajax-loader">&nbsp;</div>
                                </form>
                                <div class="main-search--results"></div>
                            </div>
                        </li> --}}

                        <li class="navigation--entry entry--language">
                            @if(app()->getLocale() == 'en')
                            <span class="entry--link entry--trigger" title="English">
                                <span class="entry--trigger-title">EN</span>
                                <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
                            </span>
                            @else
                            <span class="entry--link entry--trigger" title="عربي">
                                <span class="entry--trigger-title">AR</span>
                                <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
                            </span>

                            @endif

                            <div class="main-language--wrap">
                                @foreach (language()->allowed() as $code => $name)
                                    <a href="{{ language()->back($code) }}" title="{{ $name }}" class="main-language--entry">{{ $name }}</a>
                                @endforeach
                            </div>

                        </li>

                        <ul class="header--social">
                            <li class="header--social-label">{{__('Follow us')}}:</li>
                            @foreach ($site_content as $key => $value)
                            @if (Str::startsWith($key,'social_') && @$value && $key != 'social_rss')
                            <li class="header--social-item">
                                <a class="social--icon" target="_blank" rel="nofollow" href="{{$value}}" title="{{ Str::title(str_replace('social_','',$key))}}">
                                    <i class="fa fa-{{ str_replace('social_','',$key)}} fa-lg" aria-hidden="true"></i>
                                </a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </ul>
                </nav>
            </div>
            <!-- RD Navbar -->
            <nav  class="rd-navbar rd-navbar-original rd-navbar-static navigation-main">
                <span class="rd-navbar-toggle toggle-original navigation--trigger" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><i></i></span>
                <div class="rd-navbar-outer js--menu-scroller">
                    <div class="rd-navbar-inner toggle-original-elements">


                        <div class="rd-navbar-subpanel">
                            <div class="rd-navbar-nav-wrap toggle-original-elements navigation--list-wrapper">
                                <!-- RD Navbar Nav -->
                                <ul class="rd-navbar-nav navigation--list container js--menu-scroller--list">
                                    <li class="active navigation--entry has--sub js--menu-scroller--item">
                                        <a class="navigation--link is--first active" href="{{route('home')}}" title="Home" itemprop="url"><i class="fa fa-home fa-lg" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="rd-navbar--has-dropdown rd-navbar-submenu navigation--entry has--sub js--menu-scroller--item">
                                        <a class="navigation--link" href="{{route('products.products')}}">{{__('Products')}}</a><span class="rd-navbar-submenu-toggle"></span>

                                        <!-- RD Navbar Dropdown -->
                                        <ul class="rd-navbar-dropdown rd-navbar-open-right subnavigation--list">
                                            @foreach(\App\Admin\Product\Product::groupBy('category')->get() as $category)
                                            <li class="subnavigation--entry">
                                                <a class="subnavigation--link" href="{{route('products.category',$category->category)}}">
                                                    @if(app()->getLocale() == 'ar')
                                                    {{ $category->category_ar }}
                                                    @else
                                                    {{ \Str::title(str_replace('_', ' ', $category->category)) }}
                                                    @endif
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <!-- END RD Navbar Dropdown --> 
                                    </li>
                                    <li class="navigation--entry has--sub js--menu-scroller--item">
                                        <a class="navigation--link" href="#media">{{__('Media Library')}}</a>
                                        <ul class="rd-navbar-dropdown rd-navbar-open-right subnavigation--list">
                                            <li class="subnavigation--entry">
                                                <a class="subnavigation--link" href="{{route('media.files')}}">{{ __('Downloads') }}</a>
                                            </li>
                                            <li class="subnavigation--entry">
                                                <a class="subnavigation--link" href="{{route('media.videos')}}">{{ __('Videos') }}</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="navigation--entry has--sub js--menu-scroller--item">
                                        <a class="navigation--link" href="{{route('news')}}">{{__('News & events')}}</a>
                                    </li>
                                    <li class="navigation--entry has--sub js--menu-scroller--item">
                                        <a class="navigation--link" href="{{route('distributors')}}">{{__('Distributors')}}</a>
                                    </li>
                                    <li class="navigation--entry has--sub js--menu-scroller--item">
                                        <a class="navigation--link" href="{{route('contacts')}}">{{__('Contact us')}}</a>
                                    </li>
                                </ul>
                                <!-- END RD Navbar Nav -->
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- END RD Navbar -->
        </header>
        <div class="main-outerWrap">
            @yield('content')
        </div>
        <footer class="footer">
            <div class="footer--wrap">
                <div class="footer--copyright">© 2020 | {{ $site_content['title'] }} </div>
                <nav class="footer--nav">
                    <ul>
                        <li role="menuitem">
                            <a href="/sitemap.xml" title="{{__('Sitemap')}}">{{__('Sitemap')}}</a>
                        </li>
                        <li role="menuitem">
                            <a href="{{route('products.products')}}" title="{{__('Products')}}">{{__('Products')}}</a>
                        </li>
                        <li role="menuitem">
                            <a href="{{route('media.files')}}" title="{{__('Media Library')}}">{{__('Media Library')}}</a>
                        </li>
                        <li role="menuitem">
                            <a href="{{route('news')}}" title="{{__('News & events')}}">{{__('News & events')}}</a>
                        </li>
                        <li role="menuitem">
                            <a href="{{route('distributors')}}" title="{{__('Distributors')}}">{{__('Distributors')}}</a>
                        </li>
                        <li role="menuitem">
                            <a href="{{route('contacts')}}" title="Contacts">{{__('Contact us')}}</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </footer>
    </div>
    
    
    <!-- Scripts -->

    <!-- Additional Functionality Scripts -->    
    <script src="{{asset('js/core.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    @yield('jsFiles', '')
</body>
</html>
