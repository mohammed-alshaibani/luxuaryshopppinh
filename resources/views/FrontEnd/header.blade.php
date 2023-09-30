
<!DOCTYPE html>
<html class="no-js" lang="en_AU" dir="rtl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo (!empty($title)) ? 'Title-'.$title: 'رفاهية التسوق'; ?></title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />

	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />

	<meta property="og:locale" content="en_AU" />
	<meta property="og:type" content="website" />
	<meta property="fb:admins" content="" />
	<meta property="fb:app_id" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:url" content="" />
	<meta property="og:image" content="" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="" />
	<meta property="og:image:height" content="" />
	<meta property="og:image:alt" content="" />

	<meta name="twitter:title" content="" />
	<meta name="twitter:site" content="" />
	<meta name="twitter:description" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:image:alt" content="" />
	<meta name="twitter:card" content="summary_large_image" />
	<meta name="csrf_token" content="{{csrf_token()}}" />
	
	<link rel="stylesheet"  href="{{asset('css/slick.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/slick-theme.css')}}" />
	<link rel="stylesheet"  href="{{asset('css/video-js.css')}}" />
    <link rel="stylesheet" href="{{asset('css/style1111.css')}}" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Raleway:ital,wght@0,400;0,600;0,800;1,200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">

<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js?ver=1.10.2' id='jquery-js'></script>
			


	<!-- Fav Icon -->
	<div class="bg-light top-header">
        <div class="container">
        <div class="row align-items-center py-3 justify-content-between">
            <div class="col-3 col-lg-1 col-lg-1 logo">
                <a href="{{url('/')}}" class="text-decoration-none">
                    <img src="{{ asset('images/رفاهية التسوق.svg') }}" alt="اونلاين شوبنج" width="30%" height="50%">
                </a>
            </div>
            <div class="col-lg-1 col-3 mt-3 mt-lg-0">
			@if(session('cart'))
					<a href="{{ url('cart') }}" class="ml-2 d-flex pt-2 btn btn-success">
	
						<i class="fas fa-shopping-cart primary"  aria-hidden="true">السلة</i>
						 
						<!-- this code count product of choose tha user choose -->
						<span class="badge bg-danger rounded-pill align-middle">
{{ count(session('cart')) }}</span>
					</a>
					 <!-- if user dont choose any product -->
					 @else
						  
						  <a href="{{url('/')}}" class="btn text-light bg-warning mt-3 mb-3" role="button">
						  <i class="fa fa-shopping-cart" aria-hidden="true"></i>
						  </a> 
	  
			@endif
            </div>
        </div>
         </div>
    </div>

<header class="bg-dark">
	<div class="container">
		<nav class="navbar navbar-expand-xl" id="navbar">		
			<button class="navbar-toggler menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      			<!-- <span class="navbar-toggler-icon icon-menu"></span> -->
				  
				  <i class="navbar-toggler-icon fas fa-bars"></i> 
				  <span class="navbar-toggler-text" style="font-family: 'Cairo', sans-serif;">الأقسام</span>

			
    		</button>
    		
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				  <!-- <li class="nav-item">
						<a class="nav-link active" aria-current="page" href="index.php" title="Products">Home</a>
				  </li> -->
				  @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}" style="font-family: 'Cairo', sans-serif;">{{ __('نسجيل الدخول') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="{{ route('register') }}" style="font-family: 'Cairo', sans-serif;">{{ __('تسجيل حساب') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="font-family: 'Cairo', sans-serif;">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('تسجيل خروج') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
						@foreach(index() as $key => $d)
    <li class="nav-item dropdown">
        <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            {{ $d->name }}
        </button>
        <ul class="dropdown-menu dropdown-menu-dark">
            @foreach($d->subcategories as $sub)
                <li><a class="dropdown-item nav-link" href="{{ route('shop', [$d->name, $sub->name]) }}">{{ $sub->name }}</a></li>
            @endforeach
        </ul>
    </li>
@endforeach	  
		  
			<div class="col-sm-4 text-center">
					@if(session('success'))
						<p class="btn-success  mt-3 mb-3 btn-block session" style='padding: .375rem .75rem;'>
						  {{ session('success') }}
						</p>
			                </div>	
					@endif
					</div>
				</div>
			</div> 		
      	</nav>
  	</div>
</header>


