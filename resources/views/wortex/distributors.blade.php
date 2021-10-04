@extends('wortex.layouts.app')
@section('title', __('Distributors'))
@section('content')

<div class="page-title">
    <div class="title-block">
        <div>
            <h1>{{__('Distributors')}}</h1>
        </div>
        <div class="breadcrumb"><a href="{{route('wortex.home')}}">{{__('Home')}}</a>&nbsp;&nbsp;/&nbsp;&nbsp;{{__('Distributors')}}</div>
    </div>
</div>

<section class="section section-lg bg-default">
    <div class="container">
        <div class="row row-40 justify-content-center">
            <div class="col-md-12 col-lg-12 col-xl-12 distributors">
            
            <table id="distributors" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Address')}}</th>
                        <th>{{__('City')}}</th>
                        <th>{{__('Phone')}}</th>
                        <th>{{__('Location')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($distributors as $distributor)
                    <tr>
                        {{-- 'name','city', 'address', 'phone', 'location',
                        'name_ar','city_ar', 'address_ar', 'sort_order' --}}
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ app()->getLocale() == 'ar' ? $distributor->name_ar : $distributor->name }}</td>
                        <td>{{ app()->getLocale() == 'ar' ? $distributor->address_ar : $distributor->address }}</td>
                        <td>{{ app()->getLocale() == 'ar' ? $distributor->city_ar : $distributor->city }}</td>
                        <td>{{ $distributor->phone }}</td>
                        <td><a href="{{ $distributor->location }}" target="_blank">{{ __('Map') }}</a></td>
                    </tr>
                    @empty
                        <h1>No Distributors at this time</h1>
                    @endforelse
                </tbody>
            </table>
            
            </div>
        </div>
    </div>
</section>

@endsection

@section('cssFiles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap4.min.css">
@endsection

@section('jsFiles')
<script src="{{asset('vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#distributors').DataTable({
            @if(app()->getLocale() == 'ar')
            "language": {
                "url": "{{url('vendors/datatables.net/js/Arabic.json')}}"
            }
            @endif
        });
    } );
</script>

@endsection