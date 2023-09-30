@include('FrontEnd.header')

<main>
@if(!empty($result) || !empty($result1))
    <section class="section-1">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="1200">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    @foreach($result as $b)
                        <picture>
                            <source media="(max-width: 799px)" srcset="{{asset('images/banner_image/'.$b->image) }}" />
                            <source media="(min-width: 800px)" srcset="{{asset('images/banner_image/'.$b->image) }}" />
                            <img src="{{asset('images/banner_image/'.$b->image) }}" alt="" />
                        </picture>
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3">
                                <h1 class="display-4 text-white mb-3">{{$b->name}}</h1>
                                <p class="mx-md-5 px-5">{{$b->description}}</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{route('proudct',[$b->name,$b->id])}}"> تسوق الان</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                @foreach($result1 as $b)
                    <div class="carousel-item">
                        <picture>
                            <source media="(max-width: 799px)" srcset="{{asset('images/banner_image/'.$b->image) }}" />
                            <source media="(min-width: 800px)" srcset="{{asset('images/banner_image/'.$b->image) }}" />
                            <img src="{{asset('images/banner_image/'.$b->image) }}" alt="" />
                        </picture>
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3">
                                <h1 class="display-4 text-white mb-3">{{$b->name}}</h1>
                                <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{route('proudct',[$b->name,$b->id])}}"> تسوق الان</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if(count($result) > 1 || count($result1) > 1)
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">التالي</span>
                </button>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">السابق</span>
                </button>
            @endif
        </div>
    </section>
@endif
<section style="background-color: #875314;">

      <div class="col-lg-12">
        <div class="box shadow-lg">
          <div id="marqueeContainer">
            <a href="/Order/out_orders" id="btn405" style="font-family: 'Cairo', sans-serif;">
              يمكنك الطلب من المواقع العالمية من خلال الضغط على هذا الشريط
            </a>
          </div>
        </div>

  </div>
</section>

<section class="section-2">
        <div class="container">
        <div class="row">
  <div class="col-lg-3">
    <div class="box shadow-lg">
      <div class="fa icon fa-check text-primary m-0 mr-3"></div>
      <h2 class="font-weight-semi-bold m-0" style="font-family: 'Cairo', sans-serif;">منتجات بجودة عالية </h2>
    </div>                    
  </div>
  <div class="col-lg-3">
    <div class="box shadow-lg">
      <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
      <h2 class="font-weight-semi-bold m-0" style="font-family: 'Cairo', sans-serif;">توصيل مجاني لبعض الطلبات </h2>
    </div>                    
  </div>
  <div class="col-lg-3">
    <div class="box shadow-lg">
      <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
      <h2 class="font-weight-semi-bold m-0" style="font-family: 'Cairo', sans-serif;">سياسة مرنة </h2>
    </div>                    
  </div>
  <div class="col-lg-3">
    <div class="box shadow-lg">
      <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
      <h2 class="font-weight-semi-bold m-0" style="font-family: 'Cairo', sans-serif;">24/7 دعم متواصل</h2>
    </div>                    
  </div>
</div>
        </div>
    </section>
    
    @if(!empty($trend))
<section class="section-4 pt-5">
  <div class="container">
  @foreach($trend as $trends)
      @php
      $productImage = $trends->images->first();
      @endphp
    <div class="section-title">
      <h2>المنتجات الأكثر شراء</h2>
    </div>
    <div class="row pb-3">

    
      <div class="col-md-3 col-sm-6">      
          <div class="card product-card">
          <div class="product-image position-relative">
            <a href="{{route('proudct',[$trends->name,$trends->id])}}" class="product-img">
              @if(!empty($productImage))
              <img class="card-img-top product-image" src="{{asset('images/products_image/'.$productImage->image)}}" alt="">
              @endif
              <div class="product-action">
                <a class="btn btn-dark" href="{{ route('addtocart', $trends->id)}}">
                  <i class="fa fa-shopping-cart"></i> إضافة للسلة
                </a>
              </div>
            </a>
          </div>
          <div class="card-body text-center mt-3">
            <a class="h6 link" href="{{route('proudct',[$trends->name,$trends->id])}}">{{$trends->name}}</a>
            <div class="price mt-2">
              @if($trends->discounted_price > 0)
              <span class="h6 text-underline">YR<del>{{$trends->original_price}}</del></span>
              <span class="h5"> YR{{$trends->discounted_price}}</span>
              @else
              <span class="h5"> YR{{$trends->original_price}}</span>
              @endif
            </div>
          </div>
        </div>
      </div>
      @endforeach
      @endif
    </div>
  </div>
</section>
@if(!$featured->isEmpty())
<section class="section-4 pt-5">

        <div class="container">
          
            <div class="section-title">
                <h2>المنتجات المميزة</h2>
            </div>    
            <div class="row pb-3">
            @foreach($featured as $proudct)
                @php
                $proudctImage = $proudct->images->first();
                @endphp
               
                <div class="col-md-3 col-sm-6">
                    <div class="card product-card">
                        
                        <div class="product-image position-relative">
                            <a href="{{route('proudct',[$proudct->name,$proudct->id])}}" class="product-img">
                                @if(!empty($proudctImage))
                                <img class="card-img-top" src="{{asset('images/products_image/'.$proudctImage->image) }}" alt="">

                                @endif
                            </a>

                            <div class="product-action">
                                <a class="btn btn-dark" href="{{url('add-to-cart',$proudct->id)}}">
                                    <i class="fa fa-shopping-cart"></i> إضافة للسلة
                                </a>                            
                            </div>
                        </div>                        
                        <div class="card-body text-center mt-3">
                            <a class="h6 link" href="{{route('proudct',[$proudct->name,$proudct->id])}}">{{$proudct->name}}</a>
                            <div class="price mt-2">
              @if($proudct->discounted_price > 0)
              <span class="h6 text-underline">  YR<del>{{$proudct->original_price}}</del></span>
              <span class="h5">  YR{{$proudct->discounted_price}}</span>
              @else
              <span class="h5"> YR{{$proudct->original_price}}</span>
              @endif
            </div>
                        </div>                        
                    </div>                                               
                </div>
                @endforeach                  
            </div>
        </div>
    </section>
    @endif

@if(!$latest->isEmpty())
<section class="section-4 pt-5">

  <div class="container">
    <div class="section-title">
      <h2>المنتجات الحديثه</h2>
    </div>
    <div class="row pb-3">
    @foreach($latest as $l)
      @php
      $productImage = $l->images->first();
      @endphp
      <div class="col-md-3 col-sm-6">
        <div class="card product-card">
          <div class="product-image position-relative">
            <a href="{{route('proudct',[$l->name,$l->id])}}" class="product-img">
              @if(!empty($productImage))
              <img class="card-img-top product-image" src="{{asset('images/products_image/'.$productImage->image)}}" alt="$l->name">
              @endif
              <div class="product-action">
                <a class="btn btn-dark" href="{{url('add-to-cart',$l->id)}}">
                  <i class="fa fa-shopping-cart"></i> إضافة للسلة
                </a>
              </div>
            </a>
          </div>
          <div class="card-body text-center mt-3">
            <a class="h6 link" href="{{route('proudct',[$l->name,$l->id])}}">{{$l->name}}</a>
            <div class="price mt-2">
              @if($l->discounted_price > 0)
              <span class="h6 text-underline"> YR<del>{{$proudct->original_price}}</del></span>
              <span class="h5"> YR{{$l->discounted_price}}</span>
              @else
              <span class="h5"> YR{{$l->original_price}}</span>
              @endif
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif


</main>
@include('FrontEnd.footer')