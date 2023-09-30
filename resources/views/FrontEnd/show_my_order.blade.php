@include('FrontEnd.header')

<div class="py-3 py-md-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="shadow bg-white p-3">

                    <h4 class="text-primary">
                        <i class="fa fa-shopping-cart text-dark"></i>تفاصيل الطلب
                    </h4>
                    <hr>
                    <div class="row">
                        @if($s->orderItem)
                        @endif
                        <div class="col-md-6">
                            <h5>تفاصيل الفاتورة</h5>
                            <hr>
                            <h6>رقم الفاتورة: {{$s->id}}</h6>
                            <h6>إجمالي الطلب:{{$s->total}} بريال اليمني </h6>
                            <h6>رسوم التوصيل: {{$s->delivery_price}}</h6>
                            <h6>إجمالي الفاتورة:  @php
                        $yem = $s->total+$s->delivery_price;
                       @endphp
         {{$yem}}  بريال اليمني
                        @foreach($c as $coin)
                        @php
                          $round = round($yem / $coin->value ,PHP_ROUND_HALF_UP);
                        @endphp
                      - {{$round}} ب{{$coin->name}}
                        @endforeach</h6>
                            <h6>تاريخ الطلب: {{$s->order_date}}</h6>
                            <h6>حالة الطلب: {{$s->status}}</h6>
                            <h6>ملاحظات: {{$s->note}}</h6>
                        </div>
                        <div class="col-md-6">
                            <h5>تفاصيل المستخدم</h5>
                            <hr>
                            <h6>اسم المستخدم: {{$s->fullname}}</h6>
                            <h6>رقم الهاتف:{{$s->phone}}</h6>
                            <h6>العنوان الأول:{{$s->address1}}</h6>
                            <h6>العنوان الثاني:{{$s->address2}}</h6>
                        </div>
                    </div>
                    <br>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>اسم المنتج</th>
                                        <th>السعر</th>
                                        <th>العدد</th>
                                    </tr>
                                </thead>
                                <tbody>
        @foreach ($s->orderDetails as $item)
        <tr>
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
@include('FrontEnd.footer')