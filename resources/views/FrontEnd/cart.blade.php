@include('FrontEnd.header')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="{{url('/')}}">الرئيسية</a></li>
                <li class="breadcrumb-item"><a class="white-text" href="{{url('shop')}}">الاقسام</a></li>
                <li class="breadcrumb-item">السلة</li>
            </ol>
        </div>
    </div>
</section>
<section>
    <main>
    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:45%">اسم المنتج</th>
            <th style="width:15%">سعر المنتج</th>
            <th style="width:8%"class="text-center">الكمية</th>
            <th style="width:22%" class="text-center">الاجمالي</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>

        <?php $total = 0 ?>
<!-- by this code session get all product that user chose -->
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)

                <?php $total += $details['price'] * $details['quantity'] ?>
                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="images/products_image/{{$details['image'] }}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">{{ $details['price'] }} ريال يمني</td>
                    <td data-th="Quantity">

                        <div class="input-group quantity mx-auto" style="width: 100px;">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-dark btn-minus p-2 pt-1 pb-1 sub" data-id="{{ $id }}">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control form-control-sm  border-0 text-center " name = "quantity" value="{{ $details['quantity'] }}">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-dark btn-plus p-2 pt-1 pb-1 add" data-id="{{ $id }}">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td data-th="Subtotal" class="text-center">{{ $details['price'] * $details['quantity'] }} ريال يمني</td>
                    <td class="actions" data-th="">
                    <!-- this button is to update card -->
                       <!-- this button is for update card -->
                        <button class="btn btn-danger btn-sm remove-from-cart delete" data-id="{{ $id }}"><i class="fa fa-trash-o"></i>حذف</button>
                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
        <tfoot>
       
        <tr>
            <td><a href="{{ url('/check') }}" class="btn btn-success shadow-0 mb-2"><i class="fa fa-angle-left"></i> اتمام عملية الشراء</a></td>
            <td colspan="2" class="hidden-xs"></td>
            <td class="hidden-xs text-center"><strong>الاجمالي {{ $total }} </strong></td>
        </tr>
    
        <tr>
            <td><a href="{{ url('/') }}" class="btn btn-dark">  العودة الى التسوق</a></td>
        </tr>
        </tfoot>
    </table>


    </main>
</section>
@include('FrontEnd.footer')