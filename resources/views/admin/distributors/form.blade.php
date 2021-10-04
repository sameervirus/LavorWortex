@foreach(getTableColumns('distributors') as $col)
@continue(in_array($col, ['id', 'created_at', 'updated_at', 'sort_order']))
@continue(Str::contains($col, '_ar'))

@if(! in_array($col, ['phone', 'location']))
<div class="form-group">
    <label for="{{$col}}" class="col-md-2 control-label">{{ Str::title($col) }}</label>

    <div class="col-md-5">
        <input id="{{$col}}" type="text" class="form-control" name="{{$col}}" value="{{$item[$col] ?? ''}}" required placeholder="ُEnglish">
    </div>
    <div class="col-md-5">
        <input type="text" class="form-control" name="{{$col}}_ar" value="{{ $item[$col . '_ar'] ?? ''}}" placeholder="عربي">
    </div>
</div>
@else
<div class="form-group">
    <label for="{{$col}}" class="col-md-2 control-label">{{ Str::title($col) }}</label>

    <div class="col-md-10">
        <input id="{{$col}}" type="text" class="form-control" name="{{$col}}" value="{{$item[$col] ?? ''}}" required placeholder="ُEnglish">
    </div>
</div>
@endif
@endforeach