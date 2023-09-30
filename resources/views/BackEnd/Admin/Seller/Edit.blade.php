@extends('layouts.dashboard.header')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h1>تحديث معلومات التاجر</h1>
      <form action="{{ route('Seller.Update', $sellers->id) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" id="id" name="id" value="{{ $sellers->id }}">

        <div class="form-group">
          <label for="name">إسم التاجر </label>
          <input type="text" class="form-control" id="name" name="name" value="{{ $sellers->name }}">
        </div>
        
        <div class="form-group">
          <label for="phone">رقم الهاتف</label>
          <input type="number" class="form-control" id="phone" name="phone" value="{{ $sellers->phone }}">
        </div>
        <div class="form-group">
          <label for="address"> العنوان</label>
          <input type="text" class="form-control" id="address" name="address" value="{{ $sellers->address }}">
        </div>

        <div class="form-group">
          <label for="note"> ملاحظات</label>
          <input type="text" class="form-control" id="note" name="note" value="{{ $sellers->note }}">
        </div>

        <button type="submit" class="btn btn-primary">تحديثات</button>
      </form>
    </div>
  </div>
</div>
@endsection