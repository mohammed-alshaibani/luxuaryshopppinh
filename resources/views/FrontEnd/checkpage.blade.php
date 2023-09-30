@include('FrontEnd.header')
<section class="bg-light py-5">
    <div class="container">
      <div class="row">
        <div class="col-xl-8 col-lg-8 mb-4">
          <form action="{{ route('order') }}" method="POST">
            @csrf
            @guest
                
          <div class="card mb-4 border shadow-0">
            <div class="p-4 d-flex justify-content-between">
              <div class="">
                <h5>هل لديك حساب ؟</h5>
              </div>
              <div class="d-flex align-items-center justify-content-center flex-column flex-md-row">
                
                <a href="{{url('register')}}" class="btn btn-outline-dark me-0 me-md-2 mb-2 mb-md-0 w-100">حساب جديد</a>
                <a href="{{url('login')}}" class="btn btn-dark shadow-0 text-nowrap w-100">تسجيل دخول </a>
              </div>
            </div>
          </div>
          @endguest

  
          <!-- Checkout -->
          <div class="card shadow-0 border">
            <div class="p-4">
              <h5 class="card-title mb-3">إكمال عملية الدفع</h5>
              <div class="row">
                
              <div class="col-6 mb-3">
                  <p class="mb-0">الإسم الكامل </p>
                  <div class="form-outline">
               <input type="text" name="fullname" id="fullname" placeholder="إسمك الكامل" class="form-control" required />
                  </div>
                </div>
              

                <div class="col-6 mb-3">
                  <p class="mb-0">رقم التلفون</p>
                  <div class="form-outline">
                    <input type="text" name="phone" placeholder="إذا كان لديك موفع آخر قم بإدخاله" class="form-control" required />
                  </div>
                </div>
  
               
                <div class="col-6 mb-3">
                  <p class="mb-0">الدولة</p>
                  <div class="form-outline">
                    <input type="text" name="country" placeholder="أدخل الدولة" class="form-control" required/>
                  </div>
                </div>
                
                <div class="col-6 mb-3">
                  <p class="mb-0"> المدينة</p>
                  <div class="form-outline">
                    <input type="text" name="city" placeholder="أدخل مديتنك" class="form-control" required />
                  </div>
                </div>
            
                <div class="col-6 mb-3">
                  <p class="mb-0">العنوان الاول </p>
                  <div class="form-outline">
                    <input type="text" name="address1" placeholder="إكتب موقعك بشكل تفصيلي" class="form-control" />
                  </div>
                </div>
                <div class="col-6 mb-3">
                  <p class="mb-0">العنوان الثاني </p>
                  <div class="form-outline">
                    <input type="text" name="address2" placeholder="إذا كان لديك موفع آخر قم بإدخاله" class="form-control" />
                  </div>
                </div>
  
              </div>
  
  
              <hr class="my-4" />
  
              <h5 class="card-title mb-3">طرق الدفع</h5>
  
              <div class="row mb-3">

                @foreach($sho_payment as $py)
                <div class="col-lg-4 mb-3">
                  <!-- Default checked radio -->
                  <div class="form-check h-100 border rounded-3">
                    <div class="p-3">
                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="{{$py->name}}" @if($py->name == "الكريمي" ) @checked(true) @endif/>
                      <label class="form-check-label" for="flexRadioDefault1">
                        {{$py->name}} <br />
                        <small class="text-muted"> {{$py->account_number}} </small>
                      </label>
                    </div>
                  </div>
                </div>
                @endforeach
                
              </div>
  
              
  
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" />
                <label class="form-check-label" for="flexCheckDefault1">إحفظ العنوان</label>
              </div>
  
  
              <div class="float-end">
                <button class="btn btn-light border">إلغاء</button>
                <button class="btn btn-success shadow-0 border" type="submit">اتمام عمليه الشراء</button>
              </div>
            </div>
          </div>
          <!-- Checkout -->
        </div>
        <?php   $totals = 0; $totaldis= 0; ?>
        <!-- by this code session get all product that user chose -->
                @if(session('cart'))
                    @foreach(session('cart') as $id => $details)
                    <?php $totals += $details['price'] * $details['quantity'] ?>
                    @endforeach
                    @endif
        <div class="col-xl-4 col-lg-4 d-flex justify-content-center justify-content-lg-end">
          <div class="ms-lg-4 mt-4 mt-lg-0" style="max-width: 320px;">
        
            <h6 class="mb-3">الفاتورة </h6>
            <div class="d-flex justify-content-between">
              <p class="mb-2">إجمالي:</p>
              <p class="mb-2">{{ $totals }}</p>
            </div>
            <div class="d-flex justify-content-between">
              <p class="mb-2">الخصم:</p>
              <p class="mb-2 text-danger" id = "totaldis">{{$totaldis}}</p>
            </div>
            <hr />
            <div class="d-flex justify-content-between">
              <p class="mb-2">المبلغ إجمالي:</p>
              <p class="mb-2 fw-bold" id ="total">{{ $totals }}</p>
            </div>
  
            <div class="aa-payment-method coupon_code">                    
              <input type="text" placeholder="Coupon Code" class="aa-coupon-code apply_coupon_code_box" name="coupon_code" id="coupon_code">
              <input type="button" value="تطبيق الكوبون" class="aa-browse-btn apply_coupon_code_box" onclick="applyCouponCode()">   
              <div id="coupon_code_msg"></div>           
              </div>
              
            </form>
            <hr />
            <h6 class="text-dark my-4">المنتجات في السلة</h6>  
            @if(session('cart'))
            @foreach(session('cart') as $id => $details)

            <div class="d-flex align-items-center mb-4">
              <div class="me-3 position-relative">
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-secondary">
                  1
                </span>
                <img src="images/products_image/{{$details['image'] }}" style="height: 96px; width: 96x;" class="img-sm rounded border" />
              </div>
              <div class="">
                <a href="#" class="nav-link">
                  {{$details['name'] }}
                </a>
                <div class="price text-muted">اجمالي : {{ $details['price'] * $details['quantity'] }}</div>
              </div>
            </div>


            @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Footer -->
  
  @include('FrontEnd.footer')