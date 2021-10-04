@extends('wortex.layouts.app')
@section('title', __('Contact Us'))
@section('content')


<div class="page-title">
    <div class="title-block">
        <div>
            <h1>{{__('Contact Us')}}</h1>
        </div>
        <div class="breadcrumb"><a href="{{route('wortex.home')}}">{{__('Home')}}</a>&nbsp;&nbsp;/&nbsp;&nbsp;{{__('News & events')}}</div>
    </div>
</div>

<div class="container back_page">
    <div class="contact-us-block" itemtype="http://schema.org/organization" itemscope="">

        <div>
            <div><i class="fa fa-map"></i></div>
            <div class="contact-us-block-text" itemscope="" itemtype="http://schema.org/PostalAddress">
                <h2>{{__('Address')}}</h2>
                <p>
                    <span itemprop="addresslocality">{{ $site_content['address'] }}</span>
                    <br>
                </p>
            </div>
        </div>

        <div>
            <div><i class="fa fa-phone"></i>
            </div>
            <div class="contact-us-block-text">
                <h2>{{__('Numbers')}}</h2>
                <p>
                    <span>{{__('Telephone')}}:</span> <a href="tel:{{ $site_content['tel'] }}"><span itemprop="telephone">{{ $site_content['tel'] }}</span></a>
                    <br>
                    <span>{{__('Fax')}}:</span> <span itemprop="faxNumber">{{ $site_content['fax'] }}</span>
                    <br>
                </p>
            </div>
        </div>

        <div>
            <div><i class="fas fa-clock"></i></div>
            <div class="contact-us-block-text">
                <h2>{{__('Working Hours')}}</h2>
                <p>{{ $site_content['opening'] }}</p>
            </div>
        </div>
        <div class="lockdown-block">
            <h2><i class="fas fa-address-book"></i>{{__('Contact details')}}</h2>
            <div class="contact-address2">
                <strong>{{__('SALES AND GALLERY')}}</strong>
                <p>
                    <span>{{__('Address')}}: </span>
                    {{ $site_content['address'] }}<br/>
                    <span>{{__('Telephone')}}</span> <a href="tel:{{ $site_content['tel'] }}">{{ $site_content['tel'] }}</a><br> <span>{{__('Fax')}}</span> {{ $site_content['fax'] }}<br><span>{{__('Mob')}}</span> <a href="tel:{{ $site_content['mob'] }}">{{ $site_content['mob'] }}</a> <br><span>{{__('Email')}}</span>: <a href="mailto:{{ $site_content['email'] }}">{{ $site_content['email'] }}</a>
                </p>
            </div>
            <div class="contact-address">
                <strong>{{__('SERVICE CENTER AND SPARE PARTS')}}</strong>
                <p>
                    <span>{{__('Address')}}: </span>
                    {{ $site_content['address2'] }}<br/>
                    <span>{{__('Telephone')}}</span> <a href="tel:{{ $site_content['tel2'] }}">{{ $site_content['tel2'] }}</a><br><span>{{__('Fax')}}</span> {{ $site_content['fax2'] }}<br><span>{{__('Mob')}}</span> <a href="tel:{{ $site_content['mob2'] }}">{{ $site_content['mob2'] }}</a><br><span>{{__('Email')}}</span>: <a href="mailto:{{ $site_content['email'] }}">{{ $site_content['email'] }}</a>
                </p>
            </div>
            <div class="contact-address2">
                <strong>{{__('MANAGEMENT')}}</strong>
                <p><span>{{__('Address')}}</span>: {{ $site_content['address-management'] }}<br/>
                <span>{{__('Telephone')}}</span> <a href="tel:{{ $site_content['tel-management'] }}">{{ $site_content['tel-management'] }}</a><br> <span>{{__('Mob')}}</span> <a href="tel:{{ $site_content['mob-management'] }}">{{ $site_content['mob-management'] }}</a><br><span>{{__('Email')}}</span>: <a href="mailto:{{ $site_content['email-management'] }}">{{ $site_content['email-management'] }}</a></p>
            </div>
        </div>
    </div>
    <div class="contactus-enquiry">

        <div class="contactus-map">
            <h2>{{__('Find us here')}}</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.153342178704!2d31.239631214472467!3d30.032458326095032!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1458474aa4f9cd79%3A0x9b4b80813db567d2!2sEl-Khalig%20El-Masry%2C%20El-Sayeda%20Zainab%2C%20Cairo%20Governorate!5e0!3m2!1sen!2seg!4v1583438598069!5m2!1sen!2seg" width="100%" height="370" frameborder="0" style="border:0" allowfullscreen=""></iframe>
        </div>

        <div class="contactus-block-enquiry" id="Enquiry_Divider">
            <h2>{{__('Get in touch with us')}}</h2>
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
             <form class="forms--main ng-pristine ng-valid" method="post" action="{{route('wortex.feed')}}">
             @csrf 
             @honeypot
            <table border="0" cellpadding="0" cellspacing="0" class="enquiry">
                <tbody>
                    <tr>
                        <td></td>
                        <td>
                            <input placeholder="{{__('Name')}} * " type="text" name="name" required>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input placeholder="{{__('Phone Number')}} *" type="text" name="phone" required>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input placeholder="{{__('Email Address')}} *" type="text" name="email" required>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input placeholder="{{__('Company')}} *" type="text" name="company" required>
                        </td>
                    </tr>
                    

                    <tr>
                        <td colspan="2">
                            <textarea placeholder="{{__('Message')}} *" name="comment" rows="4" cols="30" required></textarea>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn1">{{__('Send')}}</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            </form>
            @endif
        </div>
    </div>
    

</div>


@endsection
@section('jsFiles')

@endsection