@extends('layouts.app')
@section('title', strtoupper(str_replace('_', ' ', $product->model)))
@section('cssFiles')
<!-- Open Graph -->
    <meta property="og:title" content="{{ strtoupper(str_replace('_', ' ', $product->model)) }}" />
    <meta property="og:type" content="Trading Company" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:description" content="{{\Str::limit(strip_tags($product->features),50,'...')}}" />
    <meta property="og:image" content="{{$product->getMedia('images')->first()->getUrl()}}" />
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
                <a class="breadcrumb--link" href="{{route('products.products')}}" title="Products" itemprop="item">
                    <link itemprop="url" href="{{route('products.products')}}">
                    <span class="breadcrumb--title" itemprop="name">{{__('Products')}}</span>
                </a>
                <meta itemprop="position" content="0">
            </li>
            <li class="breadcrumb--separator">&nbsp;</li>
            <li class="breadcrumb--entry" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a class="breadcrumb--link" href="{{route('products.category', $product->category)}}" title="{{\Str::title(str_replace('_', ' ', $product->category))}}" itemprop="item">
                    <link itemprop="url" href="{{route('products.category', $product->category)}}">
                    <span class="breadcrumb--title" itemprop="name">
                        @if(app()->getLocale() == 'ar')
                        {{ $product->category_ar }}
                        @else
                        {{ \Str::title(str_replace('_', ' ', $product->category)) }}
                        @endif
                    </span>
                </a>
                <meta itemprop="position" content="0">
            </li>
            <li class="breadcrumb--separator">&nbsp;</li>
            <li class="breadcrumb--entry is--active" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a class="breadcrumb--link" href="{{route('products.product', [$product->category,$product->model])}}" title="{{strtoupper(str_replace('_', ' ', $product->model))}}" itemprop="item">
                    <link itemprop="url" href="{{route('products.product', [$product->category, $product->model])}}">
                    <span class="breadcrumb--title" itemprop="name">
                        @if(app()->getLocale() == 'ar')
                        {{ $product->model_ar }}
                        @else
                        {{strtoupper(str_replace('_', ' ', $product->model))}}
                        @endif
                        
                    </span>
                </a>
                <meta itemprop="position" content="0">
            </li>
        </ul>
    </nav>

    <div class="products content-main--inner">
        <div class="content--wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content product--details" itemscope="" itemtype="http://schema.org/Product" data-ajax-variants-container="true">
                            <div class="product--detail-upper block-group">
                                <div class="product--infoWrap">
                                    <header class="product--header">
                                        <h1 class="product--title" itemprop="name">
                                            @if(app()->getLocale() == 'ar')
                                            {{ $product->model_ar }}
                                            @else
                                            {{strtoupper(str_replace('_', ' ', $product->model))}}
                                            @endif
                                        </h1>
                                        @if(app()->getLocale() == 'ar')
                                        {{ $product->category_ar }}
                                        @else
                                        {{ \Str::title(str_replace('_', ' ', $product->category)) }}
                                        @endif
                                        <br>
                                    </header>
                                    <div class="product--description-wrap">
                                        <h3 class="product--description-title">{{__('Product information')}}</h3>
                                        <div class="product--description" itemprop="description">
                                            @if(app()->getLocale() == 'ar')
                                            {!! $product->features_ar !!}
                                            @else
                                            {!! $product->features !!}
                                            @endif
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="product--image-container image-slider product--image-zoom" dir="ltr">
                                    <div class="exzoom" id="exzoom">
                                      <!-- Images -->
                                      <div class="exzoom_img_box">
                                        <ul class='exzoom_img_ul'>
                                            @foreach($product->getMedia('images') as $image)
                                            <li><img src="{{$image->getUrl()}}"/></li>
                                            @endforeach
                                        </ul>
                                      </div>
                                      <!-- <a href="https://www.jqueryscript.net/tags.php?/Thumbnail/">Thumbnail</a> Nav-->
                                      <div class="exzoom_nav"></div>
                                      <!-- Nav Buttons -->
                                      <p class="exzoom_btn">
                                          <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                          <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                                      </p>
                                    </div>
                                </div>

                            </div>
                            <div class="product--info-col-wrap">
                                <div class="spareparts--wrap product--info-col">
                                    <div class="product--properties panel">
                                        @isset($product->technical_data)
                                        <h3 class="spareparts--title">{{__('Technical data')}}</h3>
                                        @if(app()->getLocale() == 'ar')
                                        {!! $product->technical_data_ar !!}
                                        @else
                                        {!! $product->technical_data !!}
                                        @endif
                                        @endisset
                                    </div>
                                </div>
                                
                                <div class="spareparts--wrap product--info-col">
                                    @if($product->hasMedia('sheets'))
                                    <p class="spareparts--headline">{{__('Downloads')}}</p>
                                        <div class="manuals--content">
                                            <div class="manuals--item">
                                                <a href="{{ $product->getMedia('sheets')->first()->getUrl() }}" class="manuals--link" alt="{{ $product->getMedia('sheets')->first()->name }}" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{ $product->getMedia('sheets')->first()->name }}</a>
                                            </div>
                                        </div>
                                        <p></p>
                                    @endif
                                    <p class="spareparts--headline">{{__('Get a qoute?')}}</p>
                                    <a data-fancybox data-src="#hidden-content" href="javascript:;" class="btn is--warning spareparts--link" rel="nofollow">
                                        <i class="fa fa-edit fa-lg" aria-hidden="true"></i> {{__('To Sales team')}}
                                    </a>
                                    <br>
                                    <br>
                                    <p class="spareparts--information">
                                        {{__('Should you require spare parts that are not listed in our sales documents or in our spare parts shop, please contact our service centre. Our service centre is also happy to help you.')}}
                                    </p>
                                    <div class="spareparts--information--servicecenter">
                                        <p class="spareparts--information--servicecenter--center">
                                            <strong>{{__('Service Centre')}}</strong>
                                            <br><span>{{__('Telephone')}}</span> <a href="tel:01022269577">01022269577</a>
                                            <br><span>{{__('Fax')}}</span> {{ $site_content['fax'] }}
                                            <br><span>{{__('Whatsapp')}}</span> <a href="https://wa.me/01277800713" target="_blank">01277800713</a>
                                            <br><a href="mailto:{{ $site_content['email'] }}">{{ $site_content['email'] }}</a>
                                        </p>
                                        <p class="spareparts--information--servicecenter--text">
                                            <strong>{{__('Office hours')}}</strong>
                                            <br> Sat. - Thu.: 10:00 AM to 7:00 PM
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="product--info-col-wrap">
                                <div class="spareparts--wrap product--info-col">
                                    <div class="product--properties panel">
                                        @isset($product->accessories)
                                        <h3 class="spareparts--title">{{__('Accessories')}}</h3>
                                        
                                        @if(app()->getLocale() == 'ar')
                                        {!! $product->accessories_ar !!}
                                        @else
                                        {!! $product->accessories !!}
                                        @endif
                                        @endisset
                                    </div>
                                </div>
                                <div class="spareparts--wrap product--info-col">
                                    <div class="product--properties panel">
                                        @isset($product->optional)
                                        <h3 class="spareparts--title">{{__('Optional')}}</h3>
                                        
                                        @if(app()->getLocale() == 'ar')
                                        {!! $product->optional_ar !!}
                                        @else
                                        {!! $product->optional !!}
                                        @endif
                                        @endisset
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
<div style="display: none;" id="hidden-content">
    <form id="inquiry_form" class="form-horizontal" method="post" action="{{route('feed')}}">
        @csrf 
        @honeypot
        <fieldset>

            <!-- Form Name -->
            <legend>Product Inquiry</legend>

            <!-- Text input-->
            <div class="form-group row">
                <label class="col-md-3 control-label" for="name">Name</label>
                <div class="col-md-8">
                    <input id="name" name="name" type="text" placeholder="" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group row">
                <label class="col-md-3 control-label" for="phone">Phone</label>
                <div class="col-md-8">
                    <input id="phone" name="phone" type="text" placeholder="" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group row">
                <label class="col-md-3 control-label" for="email">Email</label>
                <div class="col-md-8">
                    <input id="email" name="email" type="text" placeholder="" class="form-control input-md" required="">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group row">
                <label class="col-md-3 control-label" for="product">Product</label>
                <div class="col-md-8">
                    <input id="product_inquiry" name="subject" type="text" placeholder="" class="form-control input-md" value="Your Inquiry for {{strtoupper(str_replace('_', ' ', $product->model))}}" readonly="">

                </div>
            </div>

            <!-- Textarea -->
            <div class="form-group row">
                <label class="col-md-3 control-label" for="massage">Massage</label>
                <div class="col-md-8">
                    <textarea class="form-control" id="massage" name="comment"></textarea>
                </div>
            </div>

            <!-- Button (Double) -->
            <div class="form-group row">
                <label class="col-md-3 control-label" for="button1id"></label>
                <div class="col-md-8">
                    <button id="button1id" name="button1id" type="submit" class="btn is--warning spareparts--link">{{__('Send')}}</button>
                </div>
            </div>

        </fieldset>
    </form>
</div>
@endsection
@section('jsFiles')
<script type="text/javascript">

    $(function(){

        $("#exzoom").exzoom({
            exzoom_previewd:'left',
            autoPlay: false
        });

    });

@if (Session::has('feedback'))
                                    
    @if (Session::get('feedback') == 'sucsses')

        alert('Your Inquiry has been sent, we will contact you shortly');
        
    @endif

    @if(Session::get('feedback') == 'fail')
        
    @endif

@endif
</script>
@endsection
