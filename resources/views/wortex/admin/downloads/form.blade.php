<div class="form-group">
    <label for="type" class="col-md-2 control-label">Type</label>

    <div class="col-md-10">
        <select class="form-control" id="type" name="type" required>
            <option disabled selected="">Choose Type</option>
            <option value="file" {{ @$item && $item->type == 'file'? 'selected' : '' }}>File</option>
            <option value="video" {{ @$item && $item->type == 'video'? 'selected' : '' }}>YouTube Video</option>
        </select>        
    </div>
</div>

<div class="form-group">
    <label for="name" class="col-md-2 control-label">الاسم</label>

    <div class="col-md-5">
        <input id="name" type="text" class="form-control" name="name" required placeholder="Name" value="{{ $item->name ?? '' }}">
    </div>
    <div class="col-md-5">
        <input type="text" class="form-control" name="name_ar"  value="{{ $item->name_ar ?? '' }}" required placeholder="الاسم">

    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-2 control-label">Description الوصف</label>

    <div class="col-md-5">
        <textarea type="text" name="description" id="description" class="form-control" row="2" placeholder="Features">{!! $item->description ?? '' !!}</textarea>
    </div>
    <div class="col-md-5">
        <textarea type="text" name="description_ar" class="form-control" row="2" placeholder="الوصف">{!! $item->description_ar ?? '' !!}</textarea>
    </div>
</div>

<div class="form-group">
    <label for="link" class="col-md-2 control-label">YouTube Link</label>

    <div class="col-md-10">
        <input id="link" type="text" class="form-control" name="link" value="{{ $item->link ?? '' }}" {{ @$item->link ? '' : 'disabled' }}>
    </div>
</div>

<div class="form-group">
    <label for="data_sheet" class="col-md-2 control-label">Data Sheet التحميلات</label>

    <div class="col-md-10">
        <input id="data_sheet" type="file" class="form-control fileUpload" 
        name="data_sheet" value="" placeholder="التحميلات" {{ @$item && $item->hasMedia('download_file') ? '' : 'disabled' }}>
    </div>
</div>

<div class="form-group">
    <label for="img" class="col-md-2 control-label">Image</label>
    
    <div class="col-md-10">
        <input id="img" type="file" class="form-control fileUpload" name="img" value="" accept="image/*" {{ @$item && $item->hasMedia('download_img') ? '' : 'disabled' }}>
    </div>
</div>