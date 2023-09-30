@extends('layouts.dashboard.header')
@section('content')

<div class="row"><!-- row 1 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <ol class="breadcrumb"><!-- breadcrumb begin -->
            <li class="active"><!-- active begin -->
                
                <i class="fa fa-dashboard"></i> لوحة التحكم / التجار   
                
            </li><!-- active finish -->
        </ol><!-- breadcrumb finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 1 finish -->

<div class="row"><!-- row 2 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <div class="panel panel-default"><!-- panel panel-default begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
               <h3 class="panel-title"><!-- panel-title begin -->
               
                   <i class="fa fa-tags"></i>   التجار 
                
               </h3><!-- panel-title finish --> 
               <a href="{{ route('Seller.Create') }}" class="btn btn-primary">
            <i class="fa fa-edit"></i>إنشاء
        </a>
            </div><!-- panel-heading finish -->

<div class="panel-body"><!-- panel-body begin -->
                @if ($sellers->isEmpty())
                    <p>لا يوجد تجار</p>
                @else
                    <div class="table-responsive"><!-- table-responsive begin -->
                        <table class="table table-striped table-bordered table-hover"><!-- table table-striped table-bordered table-hover begin -->
                            <thead>
                                <tr>
                                <th>إسم التاجر</th>
                                <th> رقم التلفون </th>
                                <th> العنوان </th>
                                <th> ملاحظات </th>
                                <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sellers as $seller)
                                    <tr>
                                        <td>{{ $seller->name }}</td>
                                        <td>{{ $seller->phone }}</td>
                                        <td>{{ $seller->address }}</td>
                                        <td>{{ $seller->note }}</td>
                                        <td>
                    <div class="btn-group" style="display: inline;">
                       <a href="{{ route('Seller.Edit', ['id' => $seller->id]) }}" class="btn btn-primary">
                         <i class="fa fa-edit"></i> تعديل
                        </a>
                        <a href="{{ route('Seller.Detail', ['id' => $seller->id]) }}" class="btn btn-success">
                         <i class="fa fa-show"></i> تفاصيل التاجر
                        </a>
               <form action="{{ route('Seller.Destroy',  ['id' => $seller->id])}}" method="POST" class="d-inline">
                 @csrf
                 @method('DELETE')
                     <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من رغبتك في حذف هذا التاجر؟')">
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
                    {{ $sellers->links() }}
                </div>
        </div><!-- panel panel-default finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 2 finish -->

@endsection