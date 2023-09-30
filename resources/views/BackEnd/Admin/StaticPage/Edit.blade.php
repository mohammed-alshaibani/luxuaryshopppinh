@extends('layouts.dashboard.header')
@section('content')
<h1>تعديل صفحة التوضيحية </h1>
@if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
    <form action="{{ route('static_pages.update', $staticPage->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">إسم الصفحة</label>
            <select name="name" id="name" class="form-control">
                <option value="about" {{ $staticPage->name === 'about' ? 'selected' : '' }}>من نحن</option>
                <option value="privacy" {{ $staticPage->name === 'privacy' ? 'selected' : '' }}>سياسة الخصوصية</option>
                <option value="contact_us" {{ $staticPage->name === 'contact_us' ? 'selected' : '' }}>تواصل معانا </option>
                <option value="privacy_return" {{ $staticPage->name === 'privacy_return' ? 'selected' : '' }}>سياسة الإسترداد </option>
            </select>
        </div>

        <div class="form-group">
            <label for="title">العنوان</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $staticPage->title }}" required>
        </div>

        <div class="form-group">
            <label for="content">المحتوى</label>
            <textarea name="content" id="content" class="form-control" rows="5" required>{{ $staticPage->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">تحديث</button>
    </form>
@endsection