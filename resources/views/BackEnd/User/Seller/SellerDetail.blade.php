@extends('layouts.dashboard.User.headeruser')
@section('content')
<div class="row"><!-- row 2 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <div class="panel panel-default"><!-- panel panel-default begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
                <h3 class="panel-title"><!-- panel-title begin -->
                    <i class="fa fa-tags"></i>تفاصيل التاجر
                </h3><!-- panel-title finish -->
            </div><!-- panel-heading finish -->
            
            <div class="panel-body"><!-- panel-body begin -->
                <h4>معلومات التاجر :</h4>
                <table class="table table-striped table-bordered table-hover"><!-- table begin -->
                    <thead>
                        <tr>
                            <th>إسم التاجر</th>
                            <th>رقم التلفون</th>
                            <th>العنوان</th>
                            <th>ملاحظات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $sellers->name }}</td>
                            <td>{{ $sellers->phone }}</td>
                            <td>{{ $sellers->address }}</td>
                            <td>{{ $sellers->note }}</td>
                        </tr>
                    </tbody>
                </table><!-- table finish -->
                
                <h4>المنتجات:</h4>
                <table class="table table-striped table-bordered table-hover"><!-- table begin -->
                    <thead>
                        <tr>
                            <th>إسم المنتج</th>
                            <th>الكمية</th>
                            <th>سعر البيع</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            @if ($product->seller_id == $sellers->id)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->original_price }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table><!-- table finish -->
            </div><!-- panel-body finish -->
        </div><!-- panel panel-default finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 2 finish -->
@endsection