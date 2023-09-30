<nav class="navbar navbar-inverse navbar-fixed-top">
  

<div class="navbar-header">
        <a class="navbar-brand"  href="{{ route('Dashboard') }}" >
            <img src="{{ asset('/images/OnlineShoppingLogo.svg') }}" alt="رفاهية التسوق">
        </a>
    </div>

    <ul class="nav navbar-left top-nav">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-user"></i> {{ Auth::user()->name }} <b class="caret"></b>
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
        <a href="{{ route('Dashboard') }}">
          <i class="fa fa-fw fa-dashboard"></i> لوحة التحكم
        </a>
      </li>
      <li>
        <a href="#" data-toggle="collapse" data-target="#products">
          <i class="fa fa-fw fa-tag"></i> المنتجات
          <i class="fa fa-fw fa-caret-down"></i>
        </a>
        <ul id="products" class="collapse">
          <li>
            <a href="{{ route('Product.Create') }}">إضافة منتج</a>
          </li>
          <li>
            <a href="{{ route('Product.Index') }}">جميع المنتجات</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#" data-toggle="collapse" data-target="#cat">
          <i class="fa fa-fw fa-book"></i> الأقسام الرئيسية
          <i class="fa fa-fw fa-caret-down"></i>
        </a>
        <ul id="cat" class="collapse">
          <li>
            <a href="{{ route('Category.Create') }}">إضافة قسم</a>
          </li>
          <li>
            <a href="{{ route('Category.Index') }}">جميع الأقسام</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#" data-toggle="collapse" data-target="#sub">
          <i class="fa fa-fw fa-book"></i> الأقسام ألفرعية
          <i class="fa fa-fw fa-caret-down"></i>
        </a>
        <ul id="sub" class="collapse">
          <li>
            <a href="{{ route('Subcategory.Create') }}">إضافة قسم</a>
          </li>
          <li>
            <a href="{{ route('Subcategory.Index') }}">جميع الأقسام</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="{{ route('User.Index') }}">
          <i class="fa fa-fw fa-users"></i> الزبائن
        </a>
      </li>
      <li>
        <a href="{{ route('order_details.index') }}">
          <i class="fa fa-fw fa-book"></i> الطلبات المحلية
        </a>
      </li>
      <li>
        <a href="{{ route('order_out_details') }}">
          <i class="fa fa-fw fa-book"></i> الطلبات العالمية
        </a>
      </li>
      <li>
        <a href="{{ route('BackEnd.Return.Index') }}"">
          <i class="fa fa-fw fa-book"></i> طلبات إستراجاع
        </a>
      </li>
      <li>
        <a href="#" data-toggle="collapse" data-target="#banner">
          <i class="fa fa-fw fa-book"></i> العروضات
          <i class="fa fa-fw fa-caret-down"></i>
        </a>
        <ul id="banner" class="collapse">
          <li>
            <a href="{{ route('Banner.Create') }}">إضافة عرض</a>
          </li>
          <li>
            <a href="{{ route('Banner.Index') }}">جميع العروضات</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="{{ route('Paying.Index') }}">
          <i class="fa fa-fw fa-money"></i> طرق الدفع
        </a>
      </li>
      <li>
    <a href="{{ route('Coupon.Index') }}">
        <i class="fa fa-fw fa-ticket"></i> كوبونات
    </a>
</li>
<li>
        <a href="{{ route('static_pages.index') }}">
          <i class="fa fa-fw fa-book"></i> الصفحات الثابتة 
        </a>
      </li>
<li>
    <a href="{{ route('Seller.Index') }}">
        <i class="fa fa-fw fa-seller"></i> التجار
    </a>
</li>
      <li>
        <a href="{{ route('coin.index') }}">
          <i class="fa fa-fw fa-book"></i> أسعار العملات
        </a>
      </li>
      
    </ul>
  </div>
</nav>

