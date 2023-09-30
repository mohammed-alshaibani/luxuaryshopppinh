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
            <form action="{{ route('Product.Store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="tag"> رقم الصنف</label>
                    <input type="text" class="form-control" id="tag" name="tag" placeholder="أدخل إسم المنتج">
                </div>
                <div class="form-group">
                    <label for="name">إسم المنتج</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="أدخل إسم المنتج">
                </div>
                <div class="form-group">
                    <label for="image">صورة المنتج</label>
                    <input type="file" class="form-control" id="image" name="image[]" multiple>
                </div>
                <div class="form-group">
                    <label for="seller_price"> سعر التكلفة</label>
                    <input type="number" class="form-control" id="seller_price" name="seller_price" placeholder="أدخل سعر المنتج من التاجر">
                </div>
                <div class="form-group">
                    <label for="original_price">سعر البيع</label>
                    <input type="number" class="form-control" id="original_price" name="original_price" placeholder=" أدخل سعر المنتج">
                </div>
                <div class="form-group">
                    <label for="discounted_price">السعر بعد التخفيض</label>
                    <input type="number" class="form-control" id="discounted_price" name="discounted_price" placeholder=" أدخل سعر المنتج بعد التخفيض">
                </div>
              
                <div class="form-group">
                    <label for="quantity">الكمية</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="أدخل الكمية" value="{{ old('quantity', 0) }}" required>
                </div>
                <div class="form-group">
                    <label for="description">وصف المنتج</label>
                    <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                </div>
       <div class="form-group">
         <label for="category">القسم الرئيسي</label>
          <select class="form-control" id="category" name="category_id">
        <option value="">اختر القسم الرئيسي</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="subcategory">القسم الفرعي</label>
    <select class="form-control" id="subcategory_id" name="subcategory_id">
        <option value="">-- اختر القسم الفرعي --</option>
    </select>
</div>
<div class="form-group">
         <label for="seller">إسم التاجر </label>
          <select class="form-control" id="seller_id" name="seller_id">
        <option value="">اختر إسم التاجر </option>
        @foreach ($sellers as $seller)
            <option value="{{ $seller->id }}">{{ $seller->name }}</option>
        @endforeach
    </select>
</div>
                    <div class="form-group">
                        <label for="status"> نشر المنتج</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ $product->status ? 'selected' : '' }}>نعم</option>
                            <option value="0" {{ $product->status ? '' : 'selected' }}> لا</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="featured">منتج مميز</label>
                        <select name="featured" id="featured" class="form-control">
                            <option value="1" {{ $product->featured ? 'selected' : '' }}>نعم</option>
                            <option value="0" {{ $product->featured ? '' : 'selected' }}>لا</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="latest">منتج حديث</label>
                        <select name="latest" id="latest" class="form-control">
                            <option value="1" {{ $product->latest ? 'selected' : '' }}>نعم</option>
                            <option value="0" {{ $product->latest ? '' : 'selected' }}>لا</option>
                        </select>
                    </div>
                   
                  <button type="submit" class="btn btn-primary">حفظ</button>
</form>

<script>
    var categoryDropdown = document.getElementById('category');
    var subcategoryDropdown = document.getElementById('subcategory_id');

    categoryDropdown.addEventListener('change', function() {
        var categoryId = this.value;

        // Clear existing subcategory options
        subcategoryDropdown.innerHTML = '<option value="">-- اختر القسم الفرعي --</option>';

        if (categoryId) {
            fetch('/dashboard/Product/get-subcategories/' + categoryId)
                .then(response => response.json())
                .then(data => {
                    data.forEach(subcategory => {
                        var option = document.createElement('option');
                        option.value = subcategory.id;
                        option.textContent = subcategory.name;
                        subcategoryDropdown.appendChild(option);
                    });
                });
        }
    });
</script>
@endsection