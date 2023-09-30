@include('FrontEnd.header')

<div class="py-3 py-md-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shadow bg-white p-3">
                    <h4 class="text-primary">
                        <i class="fa fa-shopping-cart text-dark"></i> تفاصيل طلب الإرجاع
                    </h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>تفاصيل الفاتورة المراد إرجاعها</h5>
                            <hr>
                            <h6>رقم الفاتورة: {{ $order->id }}</h6>
                            <h6>إجمالي الطلب: {{ $order->total }}</h6>
                            <h6>رسوم التوصيل: {{ $order->delivery_price }}</h6>
                            <h6>إجمالي الفاتورة: {{ $order->total + $order->delivery_price }}</h6>
                            <h6>تاريخ الطلب: {{ $order->order_date }}</h6>
                            <h6>حالة الطلب: {{ $order->status }}</h6>
                            <h6>ملاحظات: {{ $order->note }}</h6>
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
                        <h5>تفاصيل المنتجات المطلوب إرجاعها</h5>
                        <hr>
                        @foreach ($return_product as $returnItem)
                    <div class="form-group">
                        <label>{{ $returnItem->product->name }}</label>
                        <input type="text" class="form-control" value="{{ $returnItem->quantity }}" readonly>
                    </div>
                            @endforeach
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('FrontEnd.footer')