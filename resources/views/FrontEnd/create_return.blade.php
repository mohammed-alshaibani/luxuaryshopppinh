@include('FrontEnd.header')

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
                        <i class="fa fa-shopping-cart text-dark"></i> طلب إرجاع المنتج
                    </h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                        <h5>تفاصيل الفاتورة</h5>
                            <hr>
                            <h6>رقم الفاتورة: {{$order->id}}</h6>
                            <h6>إجمالي الطلب: {{$order->total}}</h6>
                            <h6>رسوم التوصيل: {{$order->delivery_price}}</h6>
                            <h6>إجمالي الفاتورة: {{$order->total + $order->delivery_price}}</h6>
                            <h6>تاريخ الطلب: {{$order->order_date}}</h6>
                            <h6>حالة الطلب: {{$order->status}}</h6>
                            <h6>ملاحظات: {{$order->note}}</h6>
                        </div>
                        <div class="col-md-6">
                            <h5>تفاصيل المستخدم</h5>
                            <hr>
                            <h6>اسم المستخدم: {{ $order->fullname }}</h6>
                            <h6>رقم الهاتف: {{ $order->phone }}</h6>
                            <h6>العنوان الأول: {{ $order->address1 }}</h6>
                            <h6>العنوان الثاني: {{ $order->address2 }}</h6>
                        </div>
                    </div>

                    <br>

                    <div class="card-body p-4">
                        <form action="{{ route('FrontEnd.Return.Store') }}" method="POST">
                            @csrf
                           
                            @guest
    <div class="form-group">
        <label for="status">حالة الإرجاع</label>
        <input type="text" class="form-control" id="status" name="status" value="{{ $defaultStatus }}" readonly>
    </div>
                            @endguest
                            <hr>
                            <h5>تفاصيل المنتجات</h5>
                            <hr>
                            @foreach ($order->orderDetails as $orderItem)
                                <div class="form-group">
                                    <label for="quantity{{ $orderItem->product->id }}">الكمية المراد إرجاعها من المنتج: {{ $orderItem->product->name }}</label>
                                    <input type="number" class="form-control" id="quantity{{ $orderItem->product->id }}" name="return_order_details[{{ $loop->index }}][quantity]" min="0" required>
                                    <input type="hidden" name="return_order_details[{{ $loop->index }}][product_id]" value="{{ $orderItem->product->id }}">
                                </div>
                            @endforeach
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <div class="form-group">
                                <label for="reason">سبب الإرجاع</label>
                                <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="note">ملاحظة إضافية (اختياري)</label>
                                <input type="text" class="form-control" id="note" name="note">
                            </div>
                            <div class="form-group">
    <label for="status">حالة الإرجاع</label>
    <input type="text" class="form-control" id="status" name="status" value="{{ $defaultStatus }}" readonly>
                                       </div>
                            <button type="submit" class="btn" id="mybtn">إرسال طلب الإرجاع</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('FrontEnd.footer')