<ul id="account-panel" class="nav nav-pills flex-column" >
    <li class="nav-item">
        <a href="{{url('my-account')}}"  class="nav-link font-weight-bold" role="tab" aria-controls="tab-login" aria-expanded="false"><i class="fas fa-user-alt"></i> حسابي</a>
    </li>
    <li class="nav-item">
        <a href="{{url('my_out_orders')}}"  class="nav-link font-weight-bold" role="tab" aria-controls="tab-register" aria-expanded="false"><i class="fas fa-shopping-bag"></i> طلباتي الخارجية</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('password.request') }}"  class="nav-link font-weight-bold" role="tab" aria-controls="tab-register" aria-expanded="false"><i class="fas fa-lock"></i> تغيير كلمة المرور</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();" class="nav-link font-weight-bold" role="tab" aria-controls="tab-register" aria-expanded="false"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</a>
    </li>
</ul>