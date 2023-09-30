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
                    <i class="fa fa-tags"></i>  صفحات التوضيحية
                </h3><!-- panel-title finish -->



<div class="panel-body"><!-- panel-body begin -->
@if ($staticPages->isEmpty())
    <p>لم يتم إضافة أي صفحة</p>
@else
                    <div class="table-responsive"><!-- table-responsive begin -->
                        <table class="table table-striped table-bordered table-hover"><!-- table table-striped table-bordered table-hover begin -->
                            <thead>
                                <tr>
                <th>إسم الصفحة</th>
                <th>العنوان</th>
                <th>تاريخ التحديث </th>
                <th>تعديل الصفحة</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($staticPages as $staticPage)
                <tr>
                    <td>{{ $staticPage->name }}</td>
                    <td>{{ $staticPage->title }}</td>
                    <td>{{ $staticPage->update_date }}</td>
                    <td>
                        <a href="{{ route('static_pages.edit', $staticPage->id) }}" class="btn btn-sm btn-primary">تعديل الصفحة</a>
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