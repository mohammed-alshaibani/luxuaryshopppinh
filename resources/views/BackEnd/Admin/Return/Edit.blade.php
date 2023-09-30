

@extends('layouts.dashboard.User.headeruser')

@section('content')

<div class="py-3 py-md-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="shadow bg-white p-3">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h4 class="text-primary">
                        <i class="fa fa-shopping-cart text-dark"></i>تحرير طلب الإرجاع
                    </h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h3>تفاصيل الفاتورة</h3>
                            <hr>
                            <h5>رقم الفاتورة: {{ $order->id }}</h5>
                            <h5>إجمالي الطلب: {{ $order->total }}</h5>
                            <h5>رسوم التوصيل: {{ $order->delivery_price }}</h5>
                            <h5>إجمالي الفاتورة: {{ $order->total + $order->delivery_price }}</h6>
                            <h5>تاريخ الطلب: {{ $order->order_date }}</h5>
                            <h5>حالة الطلب: {{ $order->status }}</h5>
                        </div>

                        <div class="col-md-6">
                            <h3>تفاصيل المستخدم</h3>
                            <hr>
                            <h5>اسم المستخدم: {{ $return->order->fullname }}</h5>
                            <h5>رقم الهاتف: {{ $return->order->phone }}</h5>
                            <h5>العنوان الأول: {{ $return->order->address1 }}</h5>
                            <h5>العنوان الثاني: {{ $return->order->address2 }}</h5>
                        </div>
                    </div>
                    <br>
                    <div class="card-body p-4">
                        <form action="{{ route('BackEnd.Return.Update', ['id' => $return->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="order_id" value="{{ $return->order_id }}">
                            <input type="hidden" name="reason" value="{{ $return->reason }}">
                            @foreach ($return_product as $index => $returnItem)
                                <div class="form-group">
                                    <label>{{ $returnItem->product->name }}</label>
                                    <input type="hidden" name="return_order_details[{{ $index }}][product_id]" value="{{ $returnItem->product_id }}">
                                    <input type="text" class="form-control" name="return_order_details[{{ $index }}][quantity]" value="{{ $returnItem->quantity }}">
                                </div>
                            @endforeach
                            <div class="form-group">
                                <label for="status">حالة الطلب</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="قيد التحقق" @if ($return->status === 'قيد التحقق') selected @endif>قيد التحقق</option>
                                    <option value="تم الإرجاع" @if ($return->status === 'تم الإرجاع') selected @endif>تم الإرجاع</option>
                                    <option value="ملغي" @if ($return->status === 'ملغي') selected @endif>ملغي</option>
                                </select>
                            </div>
                            <h6>ملاحظات:
                        <textarea name="note" class="form-control">{{ $order->note }}</textarea>
                                   </h6>   
                            <button type="submit" class="btn btn-primary">تحديث طلب الإرجاع</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

