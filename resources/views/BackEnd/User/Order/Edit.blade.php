@extends('layouts.dashboard.User.headeruser')

@section('content')

@section('content')
<div class="py-3 py-md-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="shadow bg-white p-3">

                    <h4 class="text-primary">
                        <i class="fa fa-shopping-cart text-dark"></i> تفاصيل الطلب
                    </h4>
                    <hr>
                    <form action="{{ route('update_order_user', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <h3>تفاصيل الفاتورة</h3>
                                <hr>
                                <h5>رقم الفاتورة: {{ $order->id }}</h5>
                                <h5> إجمالي الطلب : {{ $order->total }}</h5>
                                <h5>  طريقة الدفع : {{ $order->payment_method }}</h5>
                                <h5> رسوم التوصيل : <input type="number" step="0.01" name="delivery_price" class="form-control" value="{{ $order->delivery_price }}">
                                </h5>
                                <h5>  إجمالي الفاتورة : {{$order->total + $order->delivery_price}}</h5>

                                <h5>تاريخ الطلب: {{ $order->order_date }}</h5>

                                <h5>حالة الطلب:
                                    <select name="status" class="form-control">
                                        @foreach ($statusOptions as $option)
                                            <option value="{{ $option }}" {{ $order->status == $option ? 'selected' : '' }}>
                                                {{ $option }}
                                            </option>
                                        @endforeach
                                    </select>
                                </h5>
                                <h5>ملاحظات:
                        <textarea name="note" class="form-control">{{ $order->note }}</textarea>
                                   </h5>                            
                        </div>
                            <div class="col-md-6">
                                <h>تفاصيل المستخدم</h3>
                                <hr>
                                <h5>اسم المستخدم: {{ $order->fullname }}</h5>
                                <h5>رقم الهاتف:
                                    <input type="text" name="phone" class="form-control" value="{{ $order->phone }}">
                                </h5>
                                <h5>العنوان الأول:
                                    <input type="text" name="address1" class="form-control" value="{{ $order->address1 }}">
                                </h6>
                                <h5>العنوان الثاني:
                                    <input type="text" name="address2" class="form-control" value="{{ $order->address2 }}">
                                </h5>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">حفظ التعديلات</button> <!-- Updated button text -->
                    </form>
                    <br>
                    <div class="card-body p-4">
                    <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
            <th class="text-right">رقم الصنف للمنتج</th>
                <th class="text-right">اسم المنتج</th>
                <th class="text-right">السعر</th>
                <th class="text-right">العدد</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderDetails as $item)
                <tr>
                <td>{{ $item->product->tag }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>
                        <span class="badge bg-success">{{ $item->price }}</span>
                    </td>
                    <td>{{ $item->quant }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection