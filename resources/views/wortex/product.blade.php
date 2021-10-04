@extends('wortex.layouts.app')
@section('title', app()->getLocale() == 'ar' ? $product->name_ar : $product->name )
@section('cssFiles')
<!-- Open Graph -->
    <meta property="og:title" content="{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name }}" />
    <meta property="og:type" content="Trading Company" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:description" content="{{\Str::limit(strip_tags($product->details),50,'...')}}" />
    <meta property="og:image" content="{{$product->getMedia('images')->first()->getUrl()}}" />
@endsection
@section('content')

<div id="product" class="pt-4 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="nav_table mb-3">
                    <div class="nav_back">
                        <a href="javascript:void(0)" onclick="javascript:history.go(-1)">
                          <span class="arrow-back">◄</span> {{__('Back')}}</a>
                    </div>
                    <div>&nbsp;</div>
                    <div class="nav_history" id="Tree_ecat_history" style="visibility: visible;">
                        <a href="{{route('wortex.category', $product->category)}}">{{ app()->getLocale() == 'ar' ? $product->category_ar : \Str::title(str_replace('_', ' ', $product->category)) }}</a>
                        &nbsp;<span>&gt;</span>&nbsp;
                        <a href="javascript:void(0);"><u>{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name }}</u></a></div>
                    <div class="nav_page" id="page_navigation" style="visibility: visible; display: block;"></div>
                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-md-4 {{app()->getLocale() == 'ar' ? ' order-1' : ''}} pt-3">
                @if($product->hasMedia('images'))
                <img class="xzoom" src="{{$product->getFirstMedia('images')->getUrl('small')}}" xoriginal="{{$product->getFirstMedia('images')->getUrl()}}" width="100%" />

                <div class="xzoom-thumbs">
                @foreach($product->getMedia('images') as $image)
                  <a href="{{$image->getUrl()}}">
                    <img class="xzoom-gallery" width="80" src="{{$image->getUrl('thumb')}}"  xpreview="{{$image->getUrl('small')}}">
                  </a>
                @endforeach                  
                </div>
                @endif
                
            </div>
            <div class="col-md-8 pro-details">
                <h3>{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name }}</h3>
                <div class="pro-text">
                    @if(app()->getLocale() == 'ar')
                    {!! $product->details_ar !!}
                    @else
                    {!! $product->details !!}
                    @endif
                </div>
                @if($product->hasMedia('data_sheet'))
                <table class="table pro-table-main mobile-table-view">
                    <tbody>
                        <tr>
                            <td class="pro-table-header">{{__('Code')}}</td>
                            <td class="pro-table-header"></td>
                            <td class="pro-table-header">&nbsp;</td>
                            <td class="pro-table-header">&nbsp;</td>
                            <td class="pro-table-header email_remove">&nbsp;</td>
                        </tr>
                        @foreach($product->getMedia('data_sheet') as $datasheet)
                        <tr>
                            <td>{{ $datasheet->getCustomProperty('code') }}</td>
                            <td></td>
                            <td>&nbsp;</td>
                            <td>{{ $datasheet->getCustomProperty('code_name') }}</td>
                            <td class="email_remove">
                                @if($datasheet->name != 1)
                                <a href="{{ $datasheet->getUrl() }}" target="_blank" title="{{ $datasheet->name }}">
                                    <img class="blink-image" src="{{asset('images/pdf.png')}}">
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif

                <div class="pro-details-btn email_remove">
                    <div>
                        <a href="javascript:void(0)" class="pro-details-btn-long" data-toggle="modal" data-target="#quoteModal" data-whatever="{{ $product->name }}" title="Request a Quote">{{__('Get a Quote')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="quoteModal" tabindex="-1" role="dialog" aria-labelledby="quoteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="quoteModalLabel">{{__('Get a Quote')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('wortex.quote')}}" method="post">
        @honeypot @csrf
      <div class="modal-body">
          <input type="hidden" name="subject" value="">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">{{__('Name')}}:</label>
            <input type="text" class="form-control" id="recipient-name" name="name" required>
          </div>
          <div class="form-group">
            <label for="recipient-email" class="col-form-label">{{__('Email')}}:</label>
            <input type="email" class="form-control" id="recipient-email" name="email" required>
          </div>
          <div class="form-group">
            <label for="recipient-phone" class="col-form-label">{{__('Phone')}}:</label>
            <input type="text" class="form-control" id="recipient-phone" name="phone" required>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">{{__('Message')}}:</label>
            <textarea class="form-control" name="comment" id="message-text"></textarea>
          </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
        <button type="submit" class="btn btn-primary">{{__('Send')}}</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('jsFiles')
<script type="text/javascript">
    $('#quoteModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-title').text('Quote Request for ' + recipient)
      modal.find('.modal-body input[name=subject]').val('{{__('Get a Quote')}} ' + recipient)
    })
</script>
@if(Session::has('quote'))
    <script type="text/javascript">
        @if(Session::get('quote') == 'success')
        alert('Your request has been received');
        @elseif(Session::get('quote') == 'fail')
        alert('Something went wrong please try again');
        @endif
    </script>
@endif
@endsection