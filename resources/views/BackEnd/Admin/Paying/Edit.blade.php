@extends('layouts.dashboard.header')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h1>تحديث معلومات البنك/الصراف</h1>
      <form action="{{ route('Paying.Update', $pay->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" id="id" name="id" value="{{ $pay->id }}">

        <div class="form-group">
          <label for="name">إسم البنك/الصراف </label>
          <input type="text" class="form-control" id="name" name="name" value="{{ $pay->name }}">
        </div>
        
        <div class="form-group">
          <label for="account_number">رقم الحساب</label>
          <input type="number" class="form-control" id="account_number" name="account_number" value="{{ $pay->account_number }}">
        </div>
        <div class="form-group">
          <label for="logo">شعار البنك/الصراف</label>
          <input type="file" class="form-control" id="logo" name="logo" value="{{ $pay->logo }}" multiple>
        </div>

        <button type="submit" class="btn btn-primary">تحديثات</button>
      </form>
    </div>
  </div>
</div>
@endsection