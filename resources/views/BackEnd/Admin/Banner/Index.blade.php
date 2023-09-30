@extends('layouts.dashboard.header')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> جميع العروض
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-tags fa-fw"></i> العروض
                </h3>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th> صورة الإعلان</th>
                                <th> المنتج</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($banners as $banner)
                                    <tr>
                                        <td>
                                            @if($banner->image)
                                                <img src="{{ asset('/images/banner_image/' . $banner->image) }}" alt="{{ optional($banner->product)->name }}" class="img-thumbnail" style="width:50px;height:50px;">
                                            @else
                                                <span class="label label-warning">لا يوجد صورة</span>
                                            @endif
                                        </td>
                                        <td>
                @if($banner->product_id)
                    {{ $banner->product->name }}
                @else
                    <span class="label label-danger">لا يوجد منتج</span>
                @endif
            </td>
                                    
<td>
    <div class="btn-group" style="display: inline;">
        <a href="{{ route('Banner.Edit', ['id' => $banner->id]) }}" class="btn btn-primary">
            <i class="fa fa-edit"></i> تعديل
        </a>
        <form action="{{ route('Banner.Destroy', ['id' => $banner->id]) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من رغبتك في حذف هذا الإعلان؟')">
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
                        {{ $banners->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection