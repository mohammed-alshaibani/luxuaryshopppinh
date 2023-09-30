@extends('layouts.dashboard.header')

@section('content')
<div class="container">
    <h1>تعديل الكوبون</h1>
   
    <form action="{{ route('Coupon.Update', $coupon->id) }}" method="POST" id="edit-coupon-form">
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
        <div class="mb-3">
            <label for="code" class="form-label">الإسم</label>
            <input type="text" class="form-control" id="code" name="code" value="{{ $coupon->code }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">النوع</label>
            <select class="form-select" id="type" name="type" required>
                <option value="per" {{ $coupon->type == 'per' ? 'selected' : '' }}>نسبة مئوية</option>
                <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>مبلغ محدد</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="value" class="form-label">قيمة الخصم</label>
            <input type="number" class="form-control" id="value" name="value" value="{{ $coupon->value }}" required>
        </div>

        <div class="mb-3">
            <label for="valid_date" class="form-label">تاريخ الإنتهاء</label>
            <input type="text" class="form-control" id="valid_date" name="valid_date" value="{{ \Carbon\Carbon::parse($coupon->valid_date)->format('Y-m-d') }}" required>
        </div>

        <div class="form-group">
            <label for="max_user">عدد المستخدمين الأقصى</label>
            <input type="number" class="form-control" id="max_user" name="max_user" value="{{ $coupon->max_user }}" required>
        </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#valid_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
        });
    });
</script>
@endpush