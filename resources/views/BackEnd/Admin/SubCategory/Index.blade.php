@extends('layouts.dashboard.header')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  جميع الأقسام الفرعية
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-tags fa-fw"></i> الأقسام الفرعية
                </h3>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered">
        <thead>
            <tr>
                <th>إسم القسم الفرعي</th>
                <th>القسم الرئيسي</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subcategories as $subcategory)
                <tr>
                    <td>{{ $subcategory->name }}</td>
                    <td>
                            @foreach ($categories as $category)
                                @if ($category->id === $subcategory->category_id)
                                    {{ $category->name }}
                                @endif
                            @endforeach
                        </td>
                    
<td>
    <div class="btn-group" style="display: inline;">
        <a href="{{ route('Subcategory.Edit', ['id' => $subcategory->id]) }}" class="btn btn-primary">
            <i class="fa fa-edit"></i> تعديل
        </a>
        <form action="{{ route('Subcategory.Destroy', ['id' => $subcategory->id]) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من رغبتك في حذف هذا القسم الفرعي؟')">
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
                {{ $subcategories->links() }}
                </div>
            </div><!-- panel-body finish -->
            
        </div><!-- panel panel-default finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 2 finish -->

@endsection
