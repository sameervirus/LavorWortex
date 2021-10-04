@extends('layouts.app')
@section('title', __('Contact Us'))
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
                <a class="breadcrumb--link" href="{{route('contacts')}}" title="{{__('Contact Us')}}" itemprop="item">
                    <link itemprop="url" href="{{route('contacts')}}">
                    <span class="breadcrumb--title" itemprop="name">{{__('Contact Us')}}</span>
                </a>
                <meta itemprop="position" content="0">
            </li>            
        </ul>
    </nav>

    <div class="products content-main--inner">
        <div class="content--wrapper">
            <div class="container">
                <div class="row">                
                    <div class="col-md-6">
                        <div class="custom-page--content content block">
                            <div class="content--custom">
                                <h1 class="custom-page--tab-headline">{{__('Contact Us')}}</h1>

                                <h2>{{__('SALES AND GALLERY')}}</h2>
                                <p><span>{{__('Address')}}</span>:<br> {{ $site_content['address'] }}</p>
                                <p><span>{{__('Telephone')}}</span> <a href="tel:{{ $site_content['tel'] }}">{{ $site_content['tel'] }}</a><br> <span>{{__('Fax')}}</span> {{ $site_content['fax'] }}<br><span>{{__('Mob')}}</span> <a href="tel:{{ $site_content['mob'] }}">{{ $site_content['mob'] }}</a> <br><span>{{__('Email')}}</span>: <a href="mailto:{{ $site_content['email'] }}">{{ $site_content['email'] }}</a></p>
                                
                                <h2>{{__('SERVICE CENTER AND SPARE PARTS')}}</h2>
                                <p>{{__('Address')}}:<br> {{ $site_content['address2'] }}</p>
                                <p><span>{{__('Telephone')}}</span> <a href="tel:{{ $site_content['tel2'] }}">{{ $site_content['tel2'] }}</a><br><span>{{__('Fax')}}</span> {{ $site_content['fax2'] }}<br><span>{{__('Mob')}}</span> <a href="tel:{{ $site_content['mob2'] }}">{{ $site_content['mob2'] }}</a><br><span>{{__('Email')}}</span>: <a href="mailto:{{ $site_content['email'] }}">{{ $site_content['email'] }}</a></p>
                                
                                <h2>{{__('MANAGEMENT')}}</h2>
                                <p>{{__('Address')}}:<br> {{ $site_content['address-management'] }}</p>
                                <p><span>{{__('Telephone')}}</span> <a href="tel:{{ $site_content['tel-management'] }}">{{ $site_content['tel-management'] }}</a><br> <span>{{__('Mob')}}</span> <a href="tel:{{ $site_content['mob-management'] }}">{{ $site_content['mob-management'] }}</a><br><span>{{__('Email')}}</span>: <a href="mailto:{{ $site_content['email-management'] }}">{{ $site_content['email-management'] }}</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="forms--content content">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <p></p>
                            <p>{{__('Write an email to us.')}}</p>
                            <p>{{__('We look forward to hearing from you.')}}</p>
                            <p></p>
                            @if (Session::has('feedback'))
                                    
                                @if (Session::get('feedback') == 'sucsses')
                                    <div class="alert alert-success alert-dismissible show" role="alert">
                                      <strong>Your message had been received, we will answer you shortly</strong>
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                @endif

                                @if(Session::get('feedback') == 'fail')
                                    <div class="alert alert-warning alert-dismissible show" role="alert">
                                      <strong>Something went wrong please try again!</strong>
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                @endif

                            @else
                            <form id="support" name="support" class="forms--main ng-pristine ng-valid" method="post" action="{{route('feed')}}">
                                @csrf 
                                @honeypot

                                <div class="forms--inner-form">

                                    <div class="form--entry normal">

                                        <label for="company">{{__('Company')}}</label>
                                        <input type="text" name="company" id="company" class="">

                                    </div>

                                    <div class="form--entry normal">

                                        <label for="name">{{__('Name')}}*</label>
                                        <input type="text" name="name" id="name" class=" is--required required" required aria-required="true">

                                    </div>

                                    <div class="form--entry normal">

                                        <label for="address">{{__('Address')}}</label>
                                        <input type="text" name="address" id="address" class="">

                                    </div>

                                    <div class="form--entry normal">

                                        <label for="subject">{{__('Subject')}}*</label>
                                        <input type="text" name="subject" id="subject" class=" is--required required" required aria-required="true">

                                    </div>

                                    <div class="form--entry normal">

                                        <label for="phone">{{__('Phone')}}*</label>
                                        <input type="text" name="phone" id="phone" class=" is--required required" required aria-required="true">

                                    </div>

                                    <div class="form--entry normal">

                                        <label for="email">{{__('Email Address')}}*</label>
                                        <input type="email" name="email" id="email" class=" is--required required" required aria-required="true">

                                    </div>

                                    <div class="form--entry normal">

                                        <label for="comment">{{__('Comment')}}*</label>
                                        <textarea name="comment" id="comment" class=" is--required required" required  style="height: 100px"></textarea>

                                    </div>

                                    <div class="forms--required form--entry is--half">
                                        * {{__('this field is mandatory')}}
                                    </div>

                                    <div class="form--entry is--half">
                                        <button class="btn is--warning" type="submit" name="Submit" value="submit">{{__('Send')}}</button>
                                    </div>

                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.153342178704!2d31.239631214472467!3d30.032458326095032!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1458474aa4f9cd79%3A0x9b4b80813db567d2!2sEl-Khalig%20El-Masry%2C%20El-Sayeda%20Zainab%2C%20Cairo%20Governorate!5e0!3m2!1sen!2seg!4v1583438598069!5m2!1sen!2seg" style="width: 100%; height: 450px" frameborder="0" style="border:0;" allowfullscreen=""></iframe></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('jsFiles')

@endsection