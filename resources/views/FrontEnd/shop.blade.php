@include('FrontEnd.header')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{url('/')}}">الرئيسية</a></li>
                    <li class="breadcrumb-item active">الاقسام</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-6 pt-5">
        <div class="container">
            <div class="row">            
                <div class="col-md-3 sidebar">
                    <div class="sub-title">
                        <h2>الاقسام</h3>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionExample">
                                @foreach(index() as $key => $m)
                                <div class="accordion-item" id="section-6">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-{{$key}}" aria-expanded="false" aria-controls="collapseOne">
                                        </button>
                                    </h2>
                                    <a href="{{route('shop',$m->name)}}" class="nav-item nav-link">{{$m->name}}</a> 
                                    <div id="collapseOne-{{$key}}" class="accordion-collapse collapse {{ ($categoryselected == $m->id)? 'show' : ''}}" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <div class="navbar-nav">
                                                @foreach($m->subcategories as $sub)
                                                <a href="{{route("shop",[$m->name,$sub->name,$sub->id])}}" class="nav-item nav-link{{($categoryselectedsub == $sub->id)? 'text-primary' : ''}}">{{$sub->name}}</a> 
                                                @endforeach                                           
                                            </div>
                                        </div>
                                    </div>
                                </div>  


                             @endforeach
                            </div>
                        </div>
                    </div>


        
                </div>

                @foreach($proudct as $s)
                @php
                $proudctImage = $s->images->first();
                @endphp
                <div class="col-md-3 col-sm-6">

                    <div class="card product-card">
                        <div class="product-image position-relative">
                            <a href="{{route('proudct',[$s->name,$s->id])}}">
                        
                                @if(!empty($proudctImage))
                                <img class="card-img-top" src="{{asset('images/products_image/'.$proudctImage->image) }}" alt="">
                                @endif
                            </a>
                            <div class="product-action">
                                <a class="btn btn-dark" href="{{url('add-to-cart',$s->id)}}">
                                    <i class="fa fa-shopping-cart"></i>  إضافة للسلة
                                </a>                            
                            </div>
                        </div>                        
                        <div class="card-body text-center mt-3">
                        <a class="h6 link" href="{{route('proudct',[$s->name,$s->id])}}">{{$s->name}}</a>
            <div class="price mt-2">
              @if($s->discounted_price > 0)
              <span class="h6 text-underline">YR<del>{{$s->original_price}}</del></span>
              <span class="h5"> YR{{$s->discounted_price}}</span>
              @else
              <span class="h5"> YR{{$s->original_price}}</span>
              @endif
            </div>
                        </div>                        
                    </div>                                               
                </div>  
                @endforeach

                       

                        <div class="col-md-12 pt-5">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
@include('FrontEnd.footer')