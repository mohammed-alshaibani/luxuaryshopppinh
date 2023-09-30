@extends('layouts.dashboard.header')

@section('content')

<div class="row"><!-- row 1 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <ol class="breadcrumb"><!-- breadcrumb begin -->
            <li class="active"><!-- active begin -->
                <i class="fa fa-dashboard"></i> لوحة التحكم / الكوبونات
            </li><!-- active finish -->
        </ol><!-- breadcrumb finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 1 finish -->

<div class="row"><!-- row 2 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <div class="panel panel-default"><!-- panel panel-default begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
                <h3 class="panel-title"><!-- panel-title begin -->
                    <i class="fa fa-tags"></i>  الكوبونات
                </h3><!-- panel-title finish -->
                <a href="{{ route('Coupon.Create') }}" class="btn btn-primary">
            <i class="fa fa-edit"></i>إنشاء
        </a>
            </div><!-- panel-heading finish -->

            <div class="panel-body"><!-- panel-body begin -->
                @if ($coupons->isEmpty())
                    <p>لا يوجد كوبون</p>
                @else
                    <div class="table-responsive"><!-- table-responsive begin -->
                        <table class="table table-striped table-bordered table-hover"><!-- table table-striped table-bordered table-hover begin -->
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>النوع</th>
                                    <th>قيمة الخصم</th>
                                    <th>تاريخ الانتهاء</th>
                                    <th>العدد المسموح</th>
                                    <th>العدد المستخدم حتى الآن</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                <tr>
                    <td>{{ $coupon->code }}</td>
                    <td>
            @if ($coupon->type == 'per')
                نسبة مئوية 
            @elseif ($coupon->type == 'fixed')
                خصم ثابتة
            @endif
        </td>                 <td>{{ $coupon->value }}</td>	                    
                    <td>{{ is_string($coupon->valid_date) ? $coupon->valid_date : $coupon->valid_date->format('Y-m-d') }}</td>                   
                     <td>{{ $coupon->max_user }}</td>
                     <td>{{ $coupon->usered_copuon }}</td>
                    <td>
    <div class="btn-group" style="display: inline;">
        <a href="{{ route('Coupon.Edit', $coupon->id) }}" class="btn btn-primary">
            <i class="fa fa-edit"></i> تعديل
        </a>
        <form action="{{ route('Coupon.Destroy', $coupon->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من رغبتك في حذف هذا الكوبون؟')">
                <i class="fa fa-trash"></i> حذف
            </button>
        </form>
    </div>
</td>
                                
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- table-responsive finish -->
                @endif
            </div><!-- panel-body finish -->
            <div class="text-center">
                    {{ $coupons->links() }}
                </div>
        </div><!-- panel panel-default finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 2 finish -->

@endsection