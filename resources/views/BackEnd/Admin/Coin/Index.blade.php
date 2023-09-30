@extends('layouts.dashboard.header')

@section('content')

<div class="row"><!-- row 1 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <ol class="breadcrumb"><!-- breadcrumb begin -->
            <li class="active"><!-- active begin -->
                <i class="fa fa-dashboard"></i> لوحة التحكم / عملات
            </li><!-- active finish -->
        </ol><!-- breadcrumb finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 1 finish -->

<div class="row"><!-- row 2 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <div class="panel panel-default"><!-- panel panel-default begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
                <h3 class="panel-title"><!-- panel-title begin -->
                    <i class="fa fa-tags"></i>  العملات
                </h3><!-- panel-title finish -->
                <a href="{{ route('coin.create') }}" class="btn btn-primary">
            <i class="fa fa-edit"></i>إنشاء
        </a>
            </div><!-- panel-heading finish -->

            <div class="panel-body"><!-- panel-body begin -->
                @if ($c->isEmpty())
                    <p>لا يوجد عملات</p>
                @else
                    <div class="table-responsive"><!-- table-responsive begin -->
                        <table class="table table-striped table-bordered table-hover"><!-- table table-striped table-bordered table-hover begin -->
                            <thead>
                    <th>اسم العملة</th>
                    <th>سعر الصرف </th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>

                @foreach($c as $coin)
                <tr>
                    <td>{{$coin->name}}</td>
                    <td>{{$coin->value}}</td>
                 <td>
    <div class="btn-group" style="display: inline;">
        <a href="{{ route('coin.edit',['id' => $coin->id])}}"  class="btn btn-primary">
            <i class="fa fa-edit"></i> تعديل
        </a>
        <form action="{{ route('coin.destroy',['id' => $coin->id])}}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من رغبتك في حذف هذا العملة؟')">
        <i class="fa fa-trash"></i> حذف
    </button>
</td>
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

        </div><!-- panel panel-default finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 2 finish -->

@endsection