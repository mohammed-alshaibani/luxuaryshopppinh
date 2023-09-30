@extends('layouts.dashboard.header')
@section('content')

<div class="row"><!-- row 1 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <ol class="breadcrumb"><!-- breadcrumb begin -->
            <li class="active"><!-- active begin -->
                
                <i class="fa fa-dashboard"></i> لوحة التحكم / طرق الدفع  
                
            </li><!-- active finish -->
        </ol><!-- breadcrumb finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 1 finish -->

<div class="row"><!-- row 2 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <div class="panel panel-default"><!-- panel panel-default begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
               <h3 class="panel-title"><!-- panel-title begin -->
               
                   <i class="fa fa-tags"></i>  طرق الدفع 
                
               </h3><!-- panel-title finish --> 
               <a href="{{ route('Paying.Create') }}" class="btn btn-primary">
            <i class="fa fa-edit"></i>إنشاء
        </a>
            </div><!-- panel-heading finish -->
            
            <div class="panel-body"><!-- panel-body begin -->
                <div class="table-responsive"><!-- table-responsive begin -->
                    <table class="table table-striped table-bordered table-hover"><!-- table table-striped table-bordered table-hover begin -->
                        
                    <thead>
                            <tr>
                                <th>إسم البنك/الصراف</th>
                                <th>رقم الحساب </th>
                                <th>شعار البنك/الصراف </th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pay as $paying)
                            <tr>
                                <td>{{ $paying->name }}</td>           
                                <td>{{ $paying->account_number }}</td>
                                <td>
                                    <img src="/images/bank_logo/{{ $paying->logo}}" style="width:50px;height:50px;">
                                </td>
                                <td>
                    <div class="btn-group" style="display: inline;">
                       <a href="{{ route('Paying.Edit', ['id' => $paying->id]) }}" class="btn btn-primary">
                         <i class="fa fa-edit"></i> تعديل
                        </a>
               <form action="{{ route('Paying.Destroy',  ['id' => $paying->id])}}" method="POST" class="d-inline">
                 @csrf
                 @method('DELETE')
                  <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من رغبتك في حذف هذا الحساب ؟')">
                   <i class="fa fa-trash"></i> حذف
                 </button>
              </form>
                   </div>
                   </td>
 
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        
                    </table><!-- table table-striped table-bordered table-hover finish -->
                </div><!-- table-responsive finish -->
                <div class="text-center">
                    {{ $pay->links() }}
                </div>
            </div><!-- panel-body finish -->
            
        </div><!-- panel panel-default finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 2 finish -->

@endsection