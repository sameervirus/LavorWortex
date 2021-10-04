<div class="form-group">
    <label for="categroy" class="col-md-2 control-label">Categroy</label>

    <div class="col-md-5">
        <input type="text" name="category" value="{{ $item->category ?? '' }}" class="form-control" list="category" autocomplete="off">
        <datalist id="category">
            @foreach(\App\Admin\Product\Product::groupBy('category')->select('category')->get() as $category)
            <option value="{{$category->category}}" {{ @$item && $item->category == $category->category ? 'selected' : '' }}>{{ \Str::title(str_replace('_', ' ', $category->category)) }}</option>
            @endforeach
        </datalist>
    </div>
    <div class="col-md-5">
        <input type="text" class="form-control" name="category_ar" required placeholder="التصنيف" value="{{ $item->category_ar ?? '' }}">
    </div>
</div>

<div class="form-group">
    <label for="name" class="col-md-2 control-label">Name المنتج</label>

    <div class="col-md-5">
        <input id="name" type="text" class="form-control" name="model" required placeholder="Product Name" value="{{ $item->name ?? '' }}">
    </div>
    <div class="col-md-5">
        <input type="text" class="form-control" name="model_ar"  value="{{ $item->name_ar ?? '' }}" required placeholder="اسم المنتج بالعربي">

    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-2 control-label">Features المواصفات</label>

    <div class="col-md-5">
        <textarea type="text" name="details" id="description" class="form-control" row="4" placeholder="Features">{!! $item->details ?? '' !!}</textarea>
    </div>
    <div class="col-md-5">
        <textarea type="text" name="details_ar" class="form-control" row="4" placeholder="المواصفات">{!! $item->details_ar ?? '' !!}</textarea>
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Code التحميلات</label>
    <div class="col-md-3">
        <input type="text" class="form-control" name="code" value="" placeholder="Code">
    </div>
    <div class="col-md-3">
        <input type="text" class="form-control" name="code_name" value="" placeholder="Code Name">
    </div>
    <div class="col-md-4">
        <input id="data_sheet" type="file" class="form-control" 
        name="data_sheet" value="{{ $item->data_sheet ?? '' }}" placeholder="التحميلات">
    </div>
    <p class="text-right">If you want only code and name without file choose pdf file name 1.pdf</p>
</div>

<div class="form-group{{ $errors->has('img') ? ' has-error' : '' }}">
    <label for="img" class="col-md-2 control-label">Product Images</label>
    
    <div class="col-md-10">
        <input id="img" type="file" class="form-control" name="file[]" value="" accept="image/*" multiple {{ @$item ? '' : 'required' }}>
        <p class="help-block">Use High resolution images</p>
    </div>
</div>