<div class="form-group">
    <label for="name" class="col-md-2 control-label">Title</label>

    <div class="col-md-5">
        <input id="name" type="text" class="form-control" name="title" value="{{$item->title ?? ''}}" required placeholder="Title">
    </div>
    <div class="col-md-5">
        <input type="text" class="form-control" name="title_ar" value="{{$item->title_ar ?? ''}}"  placeholder="العنوان">
    </div>
</div>

<div class="form-group">
    <label for="body" class="col-md-2 control-label">Body</label>

    <div class="col-md-5">
		<textarea type="text" name="body" id="body" class="form-control" row="2">{{$item->body ?? ''}}</textarea>
    </div>
    <div class="col-md-5">
        <textarea type="text" name="body_ar" class="form-control" row="2">{{$item->body_ar ?? ''}}</textarea>
    </div>
</div>
                                 
<div class="form-group">
    <label for="img" class="col-md-2 control-label">Image</label>
	
    <div class="col-md-10">
        <input id="img" type="file" class="form-control" name="img[]" value="" accept="image/*" multiple {{ @$item && $item->hasMedia('post_img') ? '' : 'required' }}>
		<p class="help-block">Use High resolution images</p>
    </div>
</div>