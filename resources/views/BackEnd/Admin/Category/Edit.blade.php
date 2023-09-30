@extends('layouts.dashboard.header')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> تعديل قسم
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-edit"></i> تعديل قسم
                </h3>
            </div>

            <div class="panel-body">
            @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <form action="{{ route('Category.Update', ['id' => $category->id]) }}" method="POST" enctype="multipart/form-data">                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $category->id }}"> <!-- Hidden input field for category ID -->
                    <div class="form-group">
                        <label for="name">اسم القسم:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
                    </div>
                    <div class="form-group">
                    <label for="status">عرض القسم</label>
                    <select name="status" id="status" class="form-control" value="{{ $category->status }}">
                        <option value="1" {{ $category->status ? 'selected' : '' }}>نعم</option>
                        <option value="0" {{ $category->status ? '' : 'selected' }}>لا</option>
                    </select>
                     </div>
                    <div class="form-group">
                        <label for="image">صورة القسم:</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @if($category->image)
                        <img src="{{ asset('images/category_image/' . $category->image) }}" alt="{{ $category->name }}" class="img-thumbnail" width="100">
                        @endif
                    </div>
                    <input type="hidden" name="category_id" value="{{ $category->id }}"> <!-- Hidden input field for category ID -->
                    <button type="submit" class="btn btn-primary">تحديث</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection