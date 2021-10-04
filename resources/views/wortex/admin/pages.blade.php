@extends('admin.admin')
 
@section('title', $data->page)

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>{{ Str::title($data->page) }} <small></small></h3>
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
                        <h2>{{ Str::title($data->page) }} <small>after make your changes press save change buttom to take active</small></h2>
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
                        <br>
                        <form id="site-pages" action="{{ route('pages.update', $data) }}" class="form-horizontal form-label-left" novalidate="" method="POST">
                            {{ csrf_field() }}                            
                            
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="{{$data->page}}">{{ Str::title($data->page) }}</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    @if($data->page == 'video')
                                    <input type="text" name="content" id="{{$data->page}}" class="form-control col-md-7 col-xs-12" value="{{$data->content}}" placeholder="Youtube Link">
                                    @else
                                    <textarea type="text" name="content" id="{{$data->page}}" class="form-control col-md-7 col-xs-12" row="10">{{$data->content}}</textarea>
                                    <textarea type="text" name="content_ar" id="{{$data->page}}" class="form-control col-md-7 col-xs-12" row="10">{{$data->content_ar}}</textarea>
                                    @endif                                    
                                </div>
                            </div>
                            <input type="hidden" name="page" value="{{$data->page}}">
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Save Change</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
	<script>
        tinymce.init({
        selector: 'textarea',
        height: 200,
        theme: 'modern',
        plugins: 'code print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help paste',
        toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link media image | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | code',
        image_advtab: true,
        paste_enable_default_filters: false,
        //paste_as_text: true,
            relative_urls : false,
            remove_script_host : false,
            convert_urls : true, 
        content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i'
        ]
      });
	</script>

@endsection
