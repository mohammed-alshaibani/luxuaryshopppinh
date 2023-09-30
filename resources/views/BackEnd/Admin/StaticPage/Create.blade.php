@extends('layouts.dashboard.header')
@section('content')
<h1>إنشاء محتوى لصفحة التوضيحية</h1>

    <form action="{{ route('static_pages.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">إسم الصفحة</label>
            <select name="name" id="name" class="form-control">
                <option value="about">من نحن</option>
                <option value="privacy">سياسة الخصوصية</option>
                <option value="contact_us">تواصل معانا </option>
                <option value="privacy_return">سياسة الإستيرداد </option>
            </select>
        </div>

        <div class="form-group">
            <label for="title">العنوان</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="content">المحتوى</label>
            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
@endsection