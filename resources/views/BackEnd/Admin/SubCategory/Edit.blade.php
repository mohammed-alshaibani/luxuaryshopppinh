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
      <h1>تعديل المنتج</h1>
      <form action="{{ route('Subcategory.Update', $subcategories->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="name">إسم القسم الفرعي</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="أدخل إسم القسم الفرعي" value="{{ $subcategories->name }}">
        </div>
        <div class="form-group">
          <label for="category_id">القسم الرئيسي</label>
          <select name="category_id" id="category_id" class="form-control">
            @foreach ($categories as $category)
              <option value="{{ $category->id }}" @if ($category->id == $subcategories->category_id) selected @endif>{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-primary">حفظ</button>
      </form>
    </div>
  </div>
</div>
@endsection