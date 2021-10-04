@extends('layouts.app')
@section('title', __('Distributors'))
@section('content')
<section class="content-main container block-group">

    <nav class="content--breadcrumb block">
        <ul class="breadcrumb--list" role="menu" itemscope="" itemtype="http://schema.org/BreadcrumbList">
            <li class="breadcrumb--entry is--home" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a class="breadcrumb--link" href="{{route('home')}}" title="Home" itemprop="item">
                    <link itemprop="url" href="{{route('home')}}">
                    <span class="breadcrumb--title" itemprop="name"><i class="fa fa-home" aria-hidden="true"></i></span>
                </a>
            </li>
            <li class="breadcrumb--separator">&nbsp;</li>
            <li class="breadcrumb--entry" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a class="breadcrumb--link" href="{{route('distributors')}}" title="{{__('Distributors')}}" itemprop="item">
                    <link itemprop="url" href="{{route('distributors')}}">
                    <span class="breadcrumb--title" itemprop="name">{{__('Distributors')}}</span>
                </a>
                <meta itemprop="position" content="0">
            </li>            
        </ul>
    </nav>

    <div class="products content-main--inner">
        <div class="content--wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="custom-page--content content block">
                        <div class="content--custom">
                            <h1 class="custom-page--tab-headline">{{__('Distributors')}}</h1>
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
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
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