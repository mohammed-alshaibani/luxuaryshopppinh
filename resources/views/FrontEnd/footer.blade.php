<footer class="bg-dark mt-5">
	<div class="container pb-5 pt-3">
		<div class="row">
    <div class="col-md-4">
  <div class="footer-card">
    <h3>تواصل معانا</h3>
    <p>
    <a href="https://wa.me/967779039294" class="fab fa-whatsapp">واتس أب</a>
    </p>
    <p>
       <a href="mailto:luxuryshopping181@gmail.com"  class="far fa-envelope">إيميل</a>
    </p>
  </div>
</div>

			<div class="col-md-4">
				<div class="footer-card">
					<h3>روابط مهمة</h3>
					<ul>
						<li><a href="{{url('about_us')}}" title="About">عنا</a></li>
						<li><a href="{{url('concat_us')}}" title="Contact Us">تواصل  معنا</a></li>						
						<li><a href="{{url('privacy')}}" title="Privacy">الخصوصية</a></li>
						<li><a href="{{url('privacy_return')}}" title="Privacy">سياسه الاسترداد</a></li>
					</ul>
				</div>
			</div>

			<div class="col-md-4">
				<div class="footer-card">
					<h3>حسابي</h3>
					<ul>
						<li><a href="{{ route('login') }}" title="Sell">تسجيل الدخول</a></li>
						<li><a href="{{ route('register') }}" title="Advertise">تسجيل حساب</a></li>
						<li><a href="{{url('Orders/my_orders')}}" title="Contact Us">طلباتي المحلية</a></li>
            <li><a href="{{url('Order/my_out_orders')}}" title="Contact Us">طلباتي الخارجية</a></li>		
            <li><a href="{{url('returns/myindex')}}" title="Contact Us">مرتجعاتي</a></li>	
					</ul>
				</div>
			</div>			
		</div>
	</div>
  <ul id="socialMediaIcons">
    <li><a href="https://facebook.com/example"><i class="fab fa-facebook"></i></a></li>
    <li><a href="https://twitter.com/example"><i class="fab fa-twitter"></i></a></li>
    <li><a href="https://instagram.com/example"><i class="fab fa-instagram"></i></a></li>
    <li><a href="https://snapchat.com/example"><i class="fab fa-snapchat"></i></a></li>
    <li><a href="https://tiktok.com/example"><i class="fab fa-tiktok"></i></a></li>
  </ul>
</footer>




<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.5.1.3.min.js')}}"></script>
<script src="{{asset('js/instantpages.5.1.0.min.js')}}"></script>
<script src="{{asset('js/lazyload.17.6.0.min.js')}}"></script>
<script src="{{asset('js/slick.min.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script>
  window.onscroll = function() {myFunction()};

  var navbar = document.getElementById("navbar");
  var sticky = navbar.offsetTop;

  function myFunction() {
    if (window.pageYOffset >= sticky) {
      navbar.classList.add("sticky");
    } else {
      navbar.classList.remove("sticky");
    }
  }

  function applyCouponCode() {
    jQuery('#coupon_code_msg').html('');
    var coupon_code = jQuery('#coupon_code').val();
    if (coupon_code != '') {
      jQuery.ajax({
        type: 'post',
        url: '{{ route('coupon') }}',
        data: 'coupon_code=' + coupon_code + '&_token=' + jQuery("[name='_token']").val(),
        success: function(result) {
          console.log(result.status);
          if (result.status == 'success') {
            jQuery('.show_coupon_box').removeClass('hide');
            jQuery('#coupon_code_str').html(coupon_code);
            jQuery('#total').html(result.total);
            jQuery('#totaldis').html(result.totaldis);
            jQuery('.apply_coupon_code_box').hide();
          } else {

          }
          jQuery('#coupon_code_msg').html(result.msg);
        }
      });
    } else {
      jQuery('#coupon_code_msg').html('Please enter coupon code');
    }
  }

  $(".sub").click(function() {
    var ele = $(this);
    var qtee = $(this).parent().next();
    var qtv = parseInt(qtee.val());
    if (qtv > 1) {
      qtee.val(qtv - 1);
    }

    $.ajax({
      url: '{{ url('update-cart') }}',
      method: "patch",
      data: {
        _token: '{{ csrf_token() }}',
        id: ele.attr("data-id"),
        quantity: qtee.val()
      },
      success: function(response) {
        window.location.reload();
      }
    });
  });

  $(".add").click(function() {
    var ele = $(this);
    var qtee = $(this).parent().prev();
    var qtv = parseInt(qtee.val());
    if (qtv < 10) {
      qtee.val(qtv + 1);
    }

    $.ajax({
      url: '{{ url('update-cart') }}',
      method: "patch",
      data: {
        _token: '{{ csrf_token() }}',
        id: ele.attr("data-id"),
        quantity: qtee.val()
      },
      success: function(response) {
        window.location.reload();
      }
    });
  });

  $(".remove-from-cart").click(function(e) {
    e.preventDefault();

    var ele = $(this);

    if (confirm("Are you sure")) {
      $.ajax({
        url: '{{ url('remove-from-cart') }}',
        method: "DELETE",
        data: {
          _token: '{{ csrf_token() }}',
          id: ele.attr("data-id")
        },
        success: function(response) {
          window.location.reload();
        }
      });
    }
  });
</script>

@if(Session::has('carts'))
<script>
  toastr.options = {
    "progressBar": true,
    "closeButton": true
  };
  toastr.success("{{ Session::get('carts') }}", 'success!', {
    timeout: 12000
  });
  toastr.info("{{ Session::get('carts') }}");
</script>
@endif

        
<script>
  var rowIdx = 1;
  $("#addBtn").on("click", function ()
  {
      // Adding a row inside the tbody.
      $("#tableEstimate tbody").append(`
      <tr id="R${++rowIdx}">
          <td class="row-index text-center"><p> ${rowIdx}</p></td>
          <td><input class="form-control" type="text" style="min-width:150px" id="item" name="item[]"></td>
          <td><input class="form-control" type="text" style="min-width:150px" id="description" name="description[]"></td>
          <td><input class="form-control unit_price" style="width:100px" type="text" id="unit_cost" name="unit_cost[]"></td>
          <td><input class="form-control qty" style="width:80px" type="text" id="qty" name="qty[]"></td>
          <td><input class="form-control total" style="width:120px" type="text" id="amount" name="amount[]" value="0" readonly></td>
          <td><a href="javascript:void(0)" class="text-danger font-18 remove" title="Remove"><i class="fa fa-trash-o"></i>يثمثف</a></td>
      </tr>`);
  });
  $("#tableEstimate tbody").on("click", ".remove", function ()
  {
      // Getting all the rows next to the row
      // containing the clicked button
      var child = $(this).closest("tr").nextAll();
      // Iterating across all the rows
      // obtained to change the index
      child.each(function () {
      // Getting <tr> id.
      var id = $(this).attr("id");

      // Getting the <p> inside the .row-index class.
      var idx = $(this).children(".row-index").children("p");

      // Gets the row number from <tr> id.
      var dig = parseInt(id.substring(1));

      // Modifying row index.
      idx.html(`${dig - 1}`);

      // Modifying row id.
      $(this).attr("id", `R${dig - 1}`);
  });

      // Removing the current row.
      $(this).closest("tr").remove();

      // Decreasing total number of rows by 1.
      rowIdx--;
  });

  $("#tableEstimate tbody").on("input", ".unit_price", function () {
      var unit_price = parseFloat($(this).val());
      var qty = parseFloat($(this).closest("tr").find(".qty").val());
      var total = $(this).closest("tr").find(".total");
      total.val(unit_price * qty);

      calc_total();
  });

  $("#tableEstimate tbody").on("input", ".qty", function () {
      var qty = parseFloat($(this).val());
      var unit_price = parseFloat($(this).closest("tr").find(".unit_price").val());
      var total = $(this).closest("tr").find(".total");
      total.val(unit_price * qty);
      calc_total();
  });
  function calc_total() {
      var sum = 0;
      $(".total").each(function () {
      sum += parseFloat($(this).val());
      });
      $(".subtotal").text(sum);
      
      var amounts = sum;
      var tax     = 100;
      $(document).on("change keyup blur", "#qty", function() 
      {
          var qty = $("#qty").val();
          var discount = $(".discount").val();
          $(".total").val(amounts * qty);
          $("#sum_total").val(amounts * qty);
          $("#tax_1").val((amounts * qty)/tax);
          $("#grand_total").val((parseInt(amounts)) - (parseInt(discount)));
      }); 
  }

</script>
</body>
</html>