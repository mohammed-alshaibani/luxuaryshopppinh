@extends('layouts.dashboard.header')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h1>إنشاء  بيانات تاجر جديد</h1>
      <form action="{{ route('Seller.Store') }}" method="post">
        @csrf
        <input type="hidden" id="id" name="id" value="{{ $sellers->id ?? '' }}">
        <div class="form-group">
          <label for="name">إسم التاجر</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="أدخل إسم التاجر">
        </div>

        <div class="form-group">
          <label for="phone">رقم الهاتف</label>
          <input type="number" class="form-control" id="phone" name="phone" placeholder="أدخل رقم التاجر">
        </div>

        <div class="form-group">
          <label for="address"> العنوان</label>
          <input type="text" class="form-control" id="address" name="address">
        </div>

        <div class="form-group">
          <label for="note"> ملاحظات</label>
          <input type="text" class="form-control" id="note" name="note">
        </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
      </form>
    </div>
  </div>
</div>
@endsection
