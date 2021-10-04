<div class="form-group">
    <label for="categroy" class="col-md-2 control-label">Categroy</label>

    <div class="col-md-5">
        <select class="form-control" id="categroy" name="category" required>
            <option>Choose Categroy</option>
            @foreach(\App\Admin\Product\Product::groupBy('category')->select('category')->get() as $category)
            <option value="{{$category->category}}" {{ @$item && $item->category == $category->category ? 'selected' : '' }}>{{ \Str::title(str_replace('_', ' ', $category->category)) }}</option>
            @endforeach
        </select>        
    </div>
    <div class="col-md-5">
        <input type="text" class="form-control" name="category_ar" required placeholder="التصنيف" value="{{ $item->category_ar ?? '' }}">
    </div>
</div>

<div class="form-group">
    <label for="name" class="col-md-2 control-label">Model المنتج</label>

    <div class="col-md-5">
        <input id="name" type="text" class="form-control" name="model" required placeholder="Product Name" value="{{ $item->model ?? '' }}">
    </div>
    <div class="col-md-5">
        <input type="text" class="form-control" name="model_ar"  value="{{ $item->model_ar ?? '' }}" required placeholder="اسم المنتج بالعربي">

    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-2 control-label">Features المواصفات</label>

    <div class="col-md-5">
        <textarea type="text" name="features" id="description" class="form-control" row="4" placeholder="Features">{!! $item->features ?? '' !!}</textarea>
    </div>
    <div class="col-md-5">
        <textarea type="text" name="features_ar" class="form-control" row="4" placeholder="المواصفات">{!! $item->features_ar ?? '' !!}</textarea>
    </div>
</div>

<div class="form-group">
    <label for="technical_data" class="col-md-2 control-label">Technical Data المواصفات الفنية</label>

    <div class="col-md-5">
        <textarea type="text" name="technical_data" id="technical_data" class="form-control" row="4" placeholder="Technical Data">{!! $item->technical_data ?? '' !!}</textarea>
    </div>
    <div class="col-md-5">
        <textarea type="text" name="technical_data_ar" class="form-control" row="4" placeholder="المواصفات الفنية">{!! $item->technical_data_ar ?? '' !!}</textarea>
    </div>
</div>

<div class="form-group">
    <label for="accessories" class="col-md-2 control-label">Accessories الملحقات</label>

    <div class="col-md-5">
        <textarea type="text" name="accessories" id="accessories" class="form-control" row="4" placeholder="Accessories">{!! $item->accessories ?? '' !!}</textarea>
    </div>
    <div class="col-md-5">
        <textarea type="text" name="accessories_ar" class="form-control" row="4" placeholder="الملحقات">{!! $item->accessories_ar ?? '' !!}</textarea>
    </div>
</div>

<div class="form-group">
    <label for="optional" class="col-md-2 control-label">Optional الخيارات</label>

    <div class="col-md-5">
        <textarea type="text" name="optional" id="optional" class="form-control" row="4" placeholder="Optional">{!! $item->optional ?? '' !!}</textarea>
    </div>
    <div class="col-md-5">
        <textarea type="text" name="optional_ar" class="form-control" row="4" placeholder="الخيارات">{!! $item->optional_ar ?? '' !!}</textarea>
    </div>
</div>

<div class="form-group">
    <label for="data_sheet" class="col-md-2 control-label">Data Sheet التحميلات</label>

    <div class="col-md-10">
        <input id="data_sheet" type="file" class="form-control" 
        name="data_sheet" value="{{ $item->data_sheet ?? '' }}" placeholder="التحميلات">
    </div>
</div>

<div class="form-group{{ $errors->has('img') ? ' has-error' : '' }}">
    <label for="img" class="col-md-2 control-label">Product Images</label>
    
    <div class="col-md-10">
        <input id="img" type="file" class="form-control" name="file[]" value="" accept="image/*" multiple {{ @$item ? '' : 'required' }}>
        <p class="help-block">Use High resolution images</p>
    </div>
</div>