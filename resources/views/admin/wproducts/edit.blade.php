@extends('admin.admin')

@section('title', 'Products')

@section ('cssFiles')
    <style type="text/css">
      .inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
      }
      .inputfile + label {
          font-size: 1.25em;
          font-weight: 700;
          color: white;
          background-color: black;
          display: inline-block;
          padding: 0 20px;
      }

      .inputfile:focus + label,
      .inputfile + label:hover {
          background-color: red;
      }
      .inputfile + label {
        cursor: pointer; /* "hand" cursor */
      }
      .thumbnail .image {height: auto!important;}
      .image img {width: 100%}
    </style>
@endsection

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Products<small></small></h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        @if (session('message'))
            <div id="back-message" class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Oh yeah!</strong> {{session('message')}}
             </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{ $item->name ?? 'Product' }} <small></small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      @if(@$item)
                        <form 
                            class="form-horizontal" 
                            role="form" 
                            method="POST" 
                            action="{{route('wproducts.update', ['wproduct' => $item] ) }}" 
                            enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                      @else
                        <form class="form-horizontal" role="form" method="post" action="{{route('wproducts.store') }}" enctype="multipart/form-data">

                      @endif
                                
                            {{ csrf_field() }} 
                            @include('admin.wproducts.form')
               
                          <a href="{{route('wproducts.index')}}" type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                          <button type="submit" class="btn btn-primary">Save</button>
       
                        </form>
                        </div>
                          
                        
                       
                    </div>
                </div>
                 <hr/> 
                <div class="row">
                <h1>Product Data</h1>
                    @if(@$item && count($item->getMedia('images')) > 0)
                    @foreach($item->getMedia('images') as $image)
                        <div class="col-md-3 img-frame well">
                          <div class="thumbnail">
                            <div class="image view view-first">
                              <img src="{{$image->getUrl('thumb')}}">                              
                              <div class="mask">
                                <p></p>
                                <div class="tools tools-bottom">
                                  <a href="#" class="image_delete" data-img="{{$image->id}}"><i class="fa fa-times"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    @endforeach
                    @endif
                    @if(@$item && $item->hasMedia('data_sheet'))
                    @foreach($item->getMedia('data_sheet') as $pdf)
                        <div class="col-md-3 img-frame well">
                            <span>{{ $pdf->getCustomProperty('code') }} - {{ $pdf->getCustomProperty('code_name') }}</span>
                          <div class="thumbnail">
                            <div class="image view view-first">
                                <a target="_blank" href="{{ $pdf->getUrl() }}">
                                    <img src="{{asset('images/pdf.png')}}">
                                </a>
                                <div class="mask">
                                  <p></p>
                                  <div class="tools tools-bottom">
                                    <a href="#" class="image_delete" data-img="{{$pdf->id}}"><i class="fa fa-times"></i></a>
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('jsFiles')
    
    <!-- iCheck -->
    <script src="{{asset('vendors/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('vendors/tinymce/js/tinymce/tinymce.min.js')}}"></script>
    <script type="text/javascript">
      
      function readURL(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#' + id).attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
      } 

      $(".inputfile").change(function(){
          var img = $(this).data('id');
          readURL(this, img);
      });



      tinymce.init({
          selector: 'textarea',
          height: 200,
          images_upload_url: '/',
          theme: 'modern',
          plugins: 'code print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help paste',
          toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link media image | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | code',
          image_advtab: true,
          relative_urls : false,
          remove_script_host : false,
          document_base_url : "{{url('/uploads/')}}",

          content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i'
          ],
          images_upload_handler: function (blobInfo, success, failure) {
             var xhr, formData;
             xhr = new XMLHttpRequest();
             xhr.withCredentials = false;
             xhr.open('POST', "{{ url('/admin/upload/img') }}");
             var token = '{{ csrf_token() }}';
             xhr.setRequestHeader("X-CSRF-Token", token);
             xhr.onload = function() {
                 var json;
                 if (xhr.status != 200) {
                     failure('HTTP Error: ' + xhr.status);
                     return;
                 }
                 json = JSON.parse(xhr.responseText);

                 if (!json || typeof json.location != 'string') {
                     failure('Invalid JSON: ' + xhr.responseText);
                     return;
                 }
                 success(json.location);
             };
             formData = new FormData();
             formData.append('file', blobInfo.blob(), blobInfo.filename());
             xhr.send(formData);
         }
         });
@if(@$item)
      $("body").on("click",".image_delete",function (e) {
        e.preventDefault();
        if (confirm('Are you sure ?')) {
          var tr =  $( this ).parents( ".img-frame" );
          var img = $(this).data('img');

          $.post("{{route('wdelimg')}}",{_token:"{{ csrf_token() }}",id: "{{ $item->id }}", imgs: img }).done(function( data ) {
            if (data == 'ok') {
              tr.slideUp('slow').remove();
            } else {
              alert ("Server is down please try again");
            }
          });
        }
      });
@endif
    </script>
@endsection
