@include('FrontEnd.header')

<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('home')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('shop')}}">الاقسام</a></li>
                    <li class="breadcrumb-item">{{$proudct->id}}</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-7 pt-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-5">
                    <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner bg-light">


                            @if($proudct->images)
                            @foreach($proudct->images as $key => $proudctimage)

                            <div class="carousel-item {{($key ==0) ? 'active' : ' '}}">
                                <img class="w-100 h-100" src="{{asset('images/products_image/'.$proudctimage->image) }}" alt="Image">
                            </div>
                            @endforeach
                            @endif

                            
                        </div>
                        <a class="carousel-control-prev" href="#product-carousel" data-bs-slide="prev">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-bs-slide="next">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="product_data bg-light right">
                        <h1>{{$proudct->name}}</h1>
                        <input type="hidden" class="product_id" value = "{{$proudct->id}}">
                        <div class="d-flex mb-3">
                            @php
                             $rate_number = number_format($rating_value)   
                            @endphp
                            <div class="rating">
                                @for($i = 1; $i<= $rate_number;$i++ )
                                <small class="fas fa-star cheked"></small>
                                @endfor
                               @for($j = $rate_number;$j <= 5;$j++)
                                <small class="far fa-star"></small>
                                @endfor
                            </div>
                            <small class="pt-1">({{$rating->count()}})</small>
                        </div>
                        @if($proudct->old_price)
                        <h2 class="price text-secondary"><del>{{$proudct->old_price}}</del></h2>
                        @endif
                        <h2 class="price ">{{$proudct->price}}</h2>


                        <p>{{$proudct->description}}</p>
                        <a href="{{url('add-to-cart',$proudct->id)}}" class="add-to-cart-btn btn btn-dark"><i class="fas fa-shopping-cart"></i> &nbsp;اضافة السلة</a>

                        @auth
                            
                        <button type="button"  class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            تقييم المنتج
                          </button>
                        
                          @endauth
                    </div>
                    <!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="{{route('add_rate')}}">
            @csrf
            <input type="hidden" name ="proudct_id" value="{{$proudct->id}}">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تقييم المنتج</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="rating-css">
                      <div class="star-icon">
                          <input type="radio" value="1" name="product_rating" checked id="rating1">
                          <label for="rating1" class="fa fa-star"></label>
                          <input type="radio" value="2" name="product_rating" id="rating2">
                          <label for="rating2" class="fa fa-star"></label>
                          <input type="radio" value="3" name="product_rating" id="rating3">
                          <label for="rating3" class="fa fa-star"></label>
                          <input type="radio" value="4" name="product_rating" id="rating4">
                          <label for="rating4" class="fa fa-star"></label>
                          <input type="radio" value="5" name="product_rating" id="rating5">
                          <label for="rating5" class="fa fa-star"></label>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                <button type="submit" class="btn btn-dark" >حفظ</button>
              </div>
        </form>
      </div>
    </div>
  </div>
                </div>

                <div class="col-md-12 mt-5">
                    <div class="bg-light">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">وصف المنتج</button>
                            </li>
                                                         
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false"><a  href="{{url('Orders/add-review/'.$proudct->name.'/userreview')}}">المراجعات</a></button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                <p>
                                    {{$proudct->description}}

                                </p>
                            </div>
                            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit, incidunt blanditiis suscipit quidem magnam doloribus earum hic exercitationem. Distinctio dicta veritatis alias delectus quaerat, quam sint ab nulla aperiam commodi.</p>
                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            
                    
                                @foreach($review as $item)
                                <div class="user_review">
                                    <label for="">{{$item->user->name}}</label>
                                    <br>
                                    @if($item->rating)
                                    @php $user_rated = $item->rating->stars_rating @endphp
                                    @for($i = 1; $i <= $user_rated;$i++)
                                    <i class="fa fa-star cheked"></i>
                                    @endfor

                                    @for($j = $user_rated+1; $j <= 5;$j++)
                                    <i class="fa fa-star"></i>
                                    @endfor

                                    @endif
                                    <p>{{$item->user_review}}</p>
                                </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div> 
            </div>           
        </div>
    </section>

    <section class="section-4 pt-5">
        <div class="container">
            <div class="section-title">
                <h2>منتجات ذات صلة</h2>
            </div>    
            <div class="row pb-3">
                    @foreach($rel as $l)
                    @php
                    $proudctImage = $l->images->first();
                    @endphp
                <div class="col-md-3">
                    <div class="card product-card">
                        <div class="product-image position-relative">
                            @if(!empty($proudctImage))
                            <img class="card-img-top" src="{{asset('images/products_image/'.$proudctImage->image) }}" alt="">
                            @endif

                            <div class="product-action">
                                <a class="btn btn-dark" href="">
                                    <i class="fa fa-shopping-cart"></i> إضافة للسلة
                                </a>                            
                            </div>
                        </div>                        
                        <div class="card-body text-center mt-3">
                            <a class="h6 link" href="">{{$l->description}}</a>
                            <div class="price mt-2">
                                <span class="h5"><strong>{{$l->original_price}}</strong></span>
                                <span class="h6 text-underline"><del>{{$l->discounted_price}}</del></span>
                            </div>
                        </div>                        
                    </div>                                               
                </div> 

                              @endforeach
            </div>
        </div>
    </section>
    
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ratethis</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">حفظ التغييرات</button>
        </div>
      </div>
    </div>
  </div>
</main>


@include('FrontEnd.footer')