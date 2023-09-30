@extends('layouts.dashboard.header')

@section('content')
<div class="container">
    <h1>إنشاء كوبون</h1>
   
    <form action="{{ route('Coupon.Store') }}" method="POST" id="create-coupon-form">
        @csrf
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
            <input type="text" class="form-control" id="code" name="code" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">النوع</label>
            <select class="form-select" id="type" name="type" required>
                <option value="per" {{ $coupons->per ? '' : 'selected'  }}>نسبة مئوية</option>
                <option value="fixed" {{ $coupons->fixed ? 'selected' : '' }}>مبلغ محدد</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="value" class="form-label">قيمة الخصم</label>
            <input type="number" class="form-control" id="value" name="value" required>
        </div>


        <div class="mb-3" wire:ignore>
            <label for="valid_date" class="form-label">تاريخ الإنتهى</label>
            <input type="date" class="form-control" id="valid_date" name="valid_date" placeholder="تاريخ الإنتهى" required>
        </div>
        <div class="form-group">
            <label for="max_user">عدد المستخدمين الأقصى</label>
            <input type="number" class="form-control" id="max_user" name="max_user" required>
        </div>

        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
</div>

@push('script')
<script>
    $(function() {
        $('#valid_date').datetimepicker({
            format: 'Y-MM-DD'
        }).on('dp.change', function(ev) {
            var date = $('#valid_date').val();
            @this.set('valid_date', date);
        });
    });
</script>
@endpush
@endsection

