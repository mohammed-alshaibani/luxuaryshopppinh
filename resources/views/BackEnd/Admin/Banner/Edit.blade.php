@extends('layouts.dashboard.header')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> إضافة  عرض جديد
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-plus"></i> تحديث بيانات الإعلان
                </h3>
            </div>

            <div class="panel-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
      <form action="{{ route('Banner.Update', ['id' => $banner->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
     
        <input type="hidden" name="id" value="{{ $banner->id }}"> 
     
        <div class="form-group">
          <label for="image">صورة العرض</label>
          <input type="file" class="form-control" id="image" name="image[]" multiple>
          @if ($banner->image)
            <div class="mt-3">
              <p>الصور الحالية</p>
                <img src="{{ asset('images/banner_image/'.$banner->image) }}" alt="{{ $banner->name }}" class="img-thumbnail">
            </div>
          @endif
        </div>
        
        <div class="form-group">
    <label for="status">إعلان رئيسي</label>
    <select class="form-control" id="status" name="status" required>
        <option value="0" {{ (old('status') == 0 || old('status', $banner->status) == 0) ? 'selected' : '' }}>لا</option>
        <option value="1" {{ (old('status') == 1 || old('status', $banner->status) == 1) ? 'selected' : '' }}>نعم</option>
    </select>
</div>
        <div class="form-group">
          <label for="product">المنتج</label>
          <select class="form-control" id="product" name="product_id">
            @foreach ($products as $product)
              <option value="{{ $product->id }}" @if ($product->id == $product->product_id) selected @endif>{{ $product->name }}</option>
            @endforeach
          </select>
        </div>
     
        <button type="submit" class="btn btn-primary">تحديث</button>
      </form>
    </div>
  </div>
</div>
@endsection