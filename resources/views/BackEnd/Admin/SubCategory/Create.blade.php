@extends('layouts.dashboard.header')
@section('content')

<div class="container">
  <div class="row">
  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
    <div class="col-lg-12">
      <h1>منتج جديد</h1>
      <form action="{{ route('Subcategory.Store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="name">إسم القسم الفرعي</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="أدخل إسم القسم الفرعي">
        </div>
       
        <div class="form-group">
            <label for="category_id">القسم الرئيسي</label>
            <select name="category_id" id="category_id" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
      </form>
    </div>
  </div>
</div>
@endsection
