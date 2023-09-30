@include('FrontEnd.header')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">حسابي</a></li>
                    <li class="breadcrumb-item">الاعدادت</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-11 ">
        <div class="container  mt-5">
            <div class="row">
               
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">طلباتي</h2>
                            <h2 class="h5 mb-0 pt-2 pb-2"> لعرض تفاصيل الفاتورة يرجى النقر فوق رقم الطلب</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead> 
                                        <tr>
                                            <th>رقم الطلب</th>
                                            <th>تاريخ الطلب</th>
                                            <th>الحالة</th>
                                            <th>الاجمالي</th>
                                            <th>طلب إرجاع</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($my_orders as $order)
    <tr>
        <td>
            <a href="{{ url('Orders/show/'.$order->id) }}">{{ $order->id }}</a>
        </td>
        <td>{{ $order->order_date }}</td>
        <td>
            <span class="badge bg-success">{{ $order->status }}</span>
        </td>
        <td>{{ $order->total }}</td>
        <td>
    <a href="{{ route('FrontEnd.Return.Create', ['id' => $order->id]) }}" class="btn btn-sm" >  إرجاع الطلب </a>
</td>
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
    </section>
</main>
@include('FrontEnd.footer')