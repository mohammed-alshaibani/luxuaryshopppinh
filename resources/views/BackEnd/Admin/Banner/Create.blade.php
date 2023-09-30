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
                    <i class="fa fa-plus"></i> إضافة عرض جديد
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

                <form action="{{ route('Banner.Store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                
                    <div class="form-group">
                        <label for="image">صورة الإعلان:</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                    <div class="form-group">
                            <label for="status">إعلان رئيسي</label>
                      <select class="form-control" id="status" name="status" required>
                          <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>لا</option>
                           <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>نعم</option>
                     </select>
                  </div>

                    <div class="form-group">
          <label for="category">المنتج</label>
          <select class="form-control" id="product" name="product_id">
            @foreach ($products as $product)
              <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
          </select>
        </div>
                    <button type="submit" class="btn btn-primary">إضافة</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection