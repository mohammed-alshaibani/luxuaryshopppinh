@extends('layouts.dashboard.header')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h1>إنشاء طريقة دفع جديدة</h1>
      <form action="{{ route('Paying.Store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="id" name="id" value="{{ $paying->id ?? '' }}">
        <div class="form-group">
          <label for="name">إسم البنك/الصراف</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="أدخل إسم البنك /الصراف">
        </div>

        <div class="form-group">
          <label for="account_number">رقم الحساب</label>
          <input type="number" class="form-control" id="account_number" name="account_number" placeholder="أدخل سعر البنك /الصراف">
        </div>

        <div class="form-group">
          <label for="logo">شعار البنك/الصراف</label>
          <input type="file" class="form-control" id="logo" name="logo" multiple>
        </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
      </form>
    </div>
  </div>
</div>
@endsection
