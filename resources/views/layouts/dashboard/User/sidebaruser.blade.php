<nav class="navbar navbar-inverse navbar-fixed-top">
<ul class="nav navbar-left top-nav">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-user"></i> {{ Auth::user()->name }}<b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li class="divider"></li>
            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-fw fa-power-off"></i> تسجيل الخروج
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </li>
</ul>

 

  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
      <li>
        <a href="{{ route('DashboardService') }}">
          <i class="fa fa-fw fa-dashboard"></i> لوحة التحكم
        </a>
        <li>
        <a href="{{ route('Product.Show') }}">
          <i class="fa fa-fw fa-book"></i>  المنتجات 
        </a>
      </li>
      <li>
        <a href="{{ route('User.order_details.index') }}">
          <i class="fa fa-fw fa-book"></i> الطلبات المحلية
        </a>
      </li>
      <li>
        <a href="{{ route('User.order_out_details') }}">
          <i class="fa fa-fw fa-book"></i> الطلبات العالمية
        </a>
      </li>
      <li>
        <a href="{{ route('User.Return.Index') }}"">
          <i class="fa fa-fw fa-book"></i> طلبات إستراجاع
        </a>
      </li>
      <li>
        <a href="{{ route('Seller.Show') }}">
          <i class="fa fa-fw fa-book"></i>  التجار 
        </a>
      </li>
    
    </ul>
  </div>
</nav>

