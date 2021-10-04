@extends('admin.admin')
 
@section('title', 'Site Content')

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
      .favicon, .logo {height: 150px!important;}
    </style>
@endsection

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Site Content <small></small></h3>
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
                        <h2>Main Website Content <small>after make your changes press save change buttom to take active</small></h2>
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
                        @if(Auth::id() == 1)
                        <p>
                            <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".add-user"><i class="fa fa-plus"></i> Add Content </a>
                        </p>
                        @endif
                        <br>
                        @if(count($sitecontent) > 0)
                        <form id="site-identity" action="{{route('sitecontent.update' , ['sitecontent' => $sitecontent[0] ] )}}" class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
                            
                            {{ csrf_field() }} {{ method_field('PUT') }}
                            
                            @foreach ($sitecontent as $value)

                            @if ($value->code == 'logo' || $value->code == 'favicon' || $value->code == 'logo-light')

                            <div class="form-group">
                                <label for="details" class="col-md-3 control-label">{{$value->code}}</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="image view view-first {{$value->code}}">
                                      <img src="{{asset('images/'. $value->content )}}" alt="image" id="{{$value->id}}">
                                      <div class="mask no-caption">
                                        <div class="tools tools-bottom">
                                          <input type="file" name="{{$value->code}}" id="file_{{$value->id}}" data-id="{{$value->id}}" class="inputfile" />
                                          <label for="file_{{$value->id}}">Change Picture</label>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>

                            @else

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="{{$value->code}}">{{Str::title(str_replace('-',' ',$value->code))}} </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="{{$value->code}}" id="{{$value->code}}" class="form-control col-md-7 col-xs-12" value="{{$value->content}}">
                                </div>
                            </div>                             

                            @endif


                            @endforeach

                            
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Save Change</button>
                                </div>
                            </div>
                            <input type="hidden" name="lang" value="{{$lang}}">
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade add-user" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel2">Add Content</h4>
        </div>                                
        <form class="form-horizontal" role="form" method="POST" action="{{route('sitecontent.store')}}" enctype="multipart/form-data">                              
        <div class="modal-body">
          
            {{ csrf_field() }}

            <input type="hidden" name="_method" value="POST">
            <input type="hidden" name="lang" value="{{$lang}}">

            <div class="form-group">
                <label for="category" class="col-md-2 control-label">Code</label>
                <div class="col-md-10">
                    <input id="category" type="text" class="form-control" 
                    name="code" value="" required>                    
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="col-md-2 control-label">Content</label>
                <div class="col-md-10">
                    <input id="name" type="text" class="form-control" name="content" value="" required>
                </div>
            </div>

            <div class="form-group{{ $errors->has('img') ? ' has-error' : '' }}">
                <label for="img" class="col-md-2 control-label">Images</label>
                
                <div class="col-md-10">
                    <input id="img" type="file" class="form-control" name="file" value="" accept="image/*">
                    <p class="help-block">Use High resolution images</p>
                </div>
            </div>                              
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
        </form>                                
      </div>
    </div>
</div>
@endsection

@section('jsFiles')
    
    <!-- iCheck -->
    <script src="{{asset('vendors/iCheck/icheck.min.js')}}"></script>
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
    </script>

@endsection
