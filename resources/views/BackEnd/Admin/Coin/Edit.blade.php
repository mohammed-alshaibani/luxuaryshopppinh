@extends('layouts.dashboard.header')

@section('content')
<div class="container">
    <h1>تعديل سعر العملة</h1>
   
    <form action="{{ route('edit_coin', $coin->id) }}" method="POST" class="d-inline">
    @csrf
    @method('PUT')
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <input type="hidden" id="id" name="id" value="{{ $coin->id }}">

        <div class="mb-3">
            <label for="name" class="form-label">اسم العملة</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $coin->name }}" required>
        </div>

        <div class="mb-3">
            <label for="value" class="form-label">سعر الصرف مقابل اليمني</label>
            <input type="decimal" class="form-control" id="value" name="value" value="{{ $coin->value }}" required>
        </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
</div>

@endsection

