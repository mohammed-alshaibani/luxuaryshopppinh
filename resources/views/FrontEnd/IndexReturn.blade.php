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
                            <h2 class="h5 mb-0 pt-2 pb-2">طلب مرتجع</h2>
                            <h2 class="h5 mb-0 pt-2 pb-2"> يرجى مراعاة عدم إجارع الطلبات بعد الفترة المتاحة</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead> 
                                        <tr>
                                            <th>رقم الطلب</th>
                                            <th>سبب الإرجاع</th>
                                            <th>الحالة</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($returns as $item)
                                            
                                        <tr>
                                            <td>
                                                <a href="{{url('returns/return_orders/'.$item->id)}}">{{$item->order_id}}</a>
                                            </td>
                                            <td>{{$item->reason}}</td>
                                            <td>
                                                <span class="badge bg-success">{{$item->status}}</span>
                                                
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