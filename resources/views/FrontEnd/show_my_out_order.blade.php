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
                        <div class="col-md-6">
                            <h5>تفاصيل الفاتورة</h5>
                            <hr>
                            <h6>  رقم الفاتورة  : {{$s->id}}</h6>
                            <h6> تاريخ الطلب    :{{$s->date}}  </h6>
                            <h6>حالة الطلب: {{$s->status}}</h6>
                            <h6>رد خدمة العملاء : {{$s->comment}}</h6>
                        </div>
                        <div class="col-md-6">
                            <h5>تفاصيل المستخدم</h5>
                            <hr>
                            <h6> اسم المستخدم : {{Auth::user()->name}}</h6>
                            <h6> الايميل       :{{Auth::user()->email}}</h6>
                            <h6> رقم التلفون  :{{Auth::user()->phone}}</h6>
                        </div>
                    </div>
                    <br>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table">
                                <thead> 
                                    <tr>  
                                        <th> رابط المنتج</th>
                                        <th> لون المنتج</th>
                                        <th>السعر</th>
                                        <th>الحجم</th>
                                        <th>العدد</th>
                                        <th>ملاحظات</th>
                                    </tr>
                                </thead>
                                @foreach ($l as $item)
                                <tbody>    
                                    <tr>
                                        <td>{{$item->url}}</td>
                                        <td>{{$item->color}}</td>   
                                        <td>
                                            <span class="badge bg-success">{{$item->price}}</span> 
                                        </td>     
                                        <td>{{$item->size}}</td>
                                        <td>{{$item->qty}}</td>
                                        <td>{{$item->note}}</td>
                                    </tr>       
                                </tbody>
                                @endforeach
                            </table>
                        </div>                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('FrontEnd.footer')