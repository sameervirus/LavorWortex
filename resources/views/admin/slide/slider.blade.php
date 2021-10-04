@extends('admin.admin')

@section('title', 'Slider')

@section ('cssFiles')
    <!-- Switchery -->
    <link href="{{asset('vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
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
      .thumbnail .image {height: auto!important;min-height: 120px;}
    </style>
@endsection

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Slider Setting<small></small></h3>
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
            <div class="col-md-8 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Slider Images <small>Change and Sort the sliders</small></h2>
                  <a href="#newModal" class="btn btn-default pull-right" data-toggle="modal"><span class="glyphicon glyphicon-plus-sign"></span> Add New Slide</a>
                  <div class="clearfix"></div>
                </div>
                @if (count($slider) > 0)

                <div class="x_content">
                  <ul class="list-unstyled timeline">
                    @foreach ($slider as $slide)
                    <li>
                      {!! Form::open(['method' => 'PUT', 'files' => true, 'route' => ['slider.update', $slide->id]]) !!}
                      <div class="block">
                        <div class="tags">
                          <a href="" class="tag">
                            <span>Slide {{ $loop->iteration }}</span>
                          </a>
                        </div>
                        <div class="block_content">
                          <div class="thumbnail">
                            <div class="image view view-first">
                              <img style="width: 100%; display: block;" src="{{asset('images/slider/'. $slide->image )}}" alt="image" id="{{$slide->id}}">
                              <div class="mask no-caption">
                                <div class="tools tools-bottom">
                                  <input type="file" name="file" id="file_{{$slide->id}}" data-id="{{$slide->id}}" class="inputfile" />
                                  <label for="file_{{$slide->id}}">Change Image</label>
                                </div>
                              </div>
                            </div>
                          </div>                          
                          <div id="data_{{ $slide->id}}">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                              <textarea type="textarea" name="header" placeholder="Title" class="form-control">{{ $slide->header }}</textarea>
                            </div>                            
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                              <textarea type="textarea" name="caption" placeholder="Title 2" class="form-control">{{ $slide->caption }}</textarea>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="modal-footer">
                            <a class="btn btn-danger" onclick="event.preventDefault();
                              document.getElementById('del_{{$slide->id}}').click();">Delete</a>
                            <button type="submit" class="btn btn-primary" data-id="{{ $slide->id }}">Save</button>
                          </div>
                        </div>
                      </div>
                      {!! Form::close() !!}
                      {!! Form::open(['method' => 'DELETE', 'route' => ['slider.destroy', $slide->id], 'onsubmit' => "return confirm('هل تريد حقاً حذف هذا slide?');" ]) !!}
                       <button type="submit" class="hidden" id="del_{{$slide->id}}">Delete</button>
                      {!! Form::close() !!}
                    </li>
                    @endforeach                    
                  </ul>
                </div>
                @endif
              </div>
            </div>
          </div>

          <!-- Create new Slide -->
           <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
             <div class="modal-dialog">
               <div class="modal-content">
               <form id="add-menu" action="{{url('admin/slider')}}" class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
               {{ csrf_field() }}
               <input id="to_change" type="hidden" name="_method" value="POST">
               
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Provide details of the new Slide item</h4>
                  </div>
                  <div class="modal-body">
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                      <textarea type="textarea" name="header" placeholder="Title" class="form-control"></textarea>
                    </div>                            
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                      <textarea type="textarea" name="caption" placeholder="Title 2" class="form-control"></textarea>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                      <label class="control-label">Select File</label>
                      <input name="file" type="file" class="" required>
                    </div>
                  </div>
                 <div class="clearfix"></div>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                   <button id="form_submit" type="submit" class="btn btn-primary">Create</button>
                 </div>
               </form>               
               </div><!-- /.modal-content -->
             </div><!-- /.modal-dialog -->
           </div><!-- /.modal -->
          
    </div>
</div>
@endsection

@section('jsFiles')
    
    <!-- Switchery -->
    <script src="{{asset('vendors/switchery/dist/switchery.min.js')}}"></script>
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
