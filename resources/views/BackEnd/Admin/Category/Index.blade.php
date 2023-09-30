@extends('layouts.dashboard.header')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> جميع الأقسام
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-tags fa-fw"></i> الأقسام
                </h3>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>إسم القسم</th>
                                <th>صورة القسم</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                
                                <td>
                                    @if($category->image)
                                    <img src="{{ asset('/images/category_image/' . $category->image) }}" alt="{{ $category->name }}" class="img-thumbnail" style="width:50px;height:50px;">
                                    @else
                                    <span class="label label-warning">لا يوجد صورة</span>
                                    @endif
                                </td>
                               
                                <td>
    <div class="btn-group" style="display: inline;">
        <a href="{{ route('Category.Edit', ['id' => $category->id]) }}" class="btn btn-primary btn-sm" style="margin-right: 5px;">
            <i class="fa fa-edit"></i> تعديل
        </a>
        <form action="{{ route('Category.Destroy', ['id' => $category->id]) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('حذفك لهذا القسم سيخيفي جميع المنتجات والأقسام الفرعية التابعة له،فهل أنت متأكد من حذف القسم؟')">
                <i class="fa fa-trash"></i> حذف
            </button>
        </form>
    </div>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection