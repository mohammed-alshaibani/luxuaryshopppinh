@include('FrontEnd.header')
<section>
  <main>
    <div class="x-container-fluid max width offset cf">
      <div class="x-main full" role="main">
      <h4 style="margin-top: 30px; text-align: center; display: flex; justify-content: center; align-items: center;">طلب جديد</h4>        <div class="entry-wrap" style="padding-top: 10px;">
          <!-- Start Product list -->
          <form action="{{route('Order_out')}}" id="c_form" method="post">
            @csrf
            <input type="hidden" name="maxid" id="maxid" />
            <div id="order-scroll" class="table-responsive">
            <table id="table1" role="table" width="100%" border="0" bgcolor="#CCCCCC" >
  <thead role="rowgroup" style="text-align: center;">
    <tr role="row">
      <td role="columnheader" align="center" bgcolor="#F0F0F0">الرقم</td>
      <td role="columnheader" align="center" bgcolor="#F0F0F0">رابط المنتج</td>
      <td role="columnheader" align="center" bgcolor="#F0F0F0">الكمية</td>
      <td role="columnheader" align="center" bgcolor="#F0F0F0">المقاس</td>
      <td role="columnheader" align="center" bgcolor="#F0F0F0">اللون</td>
      <td align="center" bgcolor="#F0F0F0">
        <span id="tooltip2">سعر المنتج بالدولار</span>
        <a href="#" class="tooltip-bottom" data-tooltip="يفضل إضافة قيمة الشحن الداخلي ضمن سعر المنتج المدرج.">
          <i class="x-icon-question-circle" style="font-size:20px;color:#333333"></i>
        </a>
      </td>
      <td role="columnheader" align="center" bgcolor="#F0F0F0">ملاحظات</td>
      <td align="center" bgcolor="#F0F0F0"></td>
    </tr>
  </thead>
  <tbody role="rowgroup" id="plist">
  </tbody>
</table>
              <div class="addnew">
                <input style="background-color:#964B00 !important;border-radius:5px;width:100% !important;padding:12px;color:#fff !important;border:0" type="button" onclick="addnew()" value="اضغط هنا لإضافة سطر جديد لمنتج إضافي" class="btn smallbtn" />
              </div>
              <!-- end Start Product list -->
              <h5 style="color:#000" class="">املأ معلومات الطلب ثم اضغط زر الإرسال:</h5>
              <table id="FSContact1" class="t_order" width="90%" height="auto" border="0">
                <input type="hidden" name="add_order" value="Y" />
                <input type="hidden" name="action" value="add_order" />
                <tbody>
                  <tr>
                    <td>معلومات إضافية</td>
                    <td>
                      <textarea type="text" id="c_info" name="c_info" placeholder="يمكنك إضافة اي ملاحظات هنا بالنسبة للطلب مثلا:
          - الرجاء الغاء الروابط الغير متوفرة مباشرة دون التواصل معي
          (تفيد في الاسراع بتحديث الفاتورة النهائية للطلب بدون تبديل الروابط الغير متوفرة)
          - الرجاء تبديل المقاس الغير متوفر بأقرب مقاس متوفر.
          - الرجاء تجميع هذا الطلب مع الطلب رقم XXX" style="width: 100%;min-height: 150px;background:#cee2b1;border:1px solid #8bbb45"></textarea>
                    </td>
                  </tr>
                </tbody>
              </table>
              <input type="hidden" id="mobile-browser" name="mobile-browser" value="0" />
              <input type="hidden" name="new_order" value="1" />
              <div class="addnew">
                <button style="background-color:#964B00 !important;border-radius:5px;width:100%;padding:18px;color:#fff !important;border:0" type="submit" id="c_submit" value="إرسال الطلب">إرسال</button>
              </div>
            </div>
          </form>
          <div class="clear"></div>
        </div>
      </div>
    </div>
  </main>
</section>
<!-- //!!Jquery truks -->
<script type="text/javascript">
    var i = 1;sn = 1;
    function addnew() {
      if(i<=30){
        $('#plist').append(
        '<tr role="row" id="tr_' + i + '"><td role="cell" align="center" bgcolor="#FFFFFF" class="snn"></td><td role="cell" align="center" bgcolor="#FFFFFF"><input class="plink1" name="url[]' + i + '" type="text" size="22" value="" required/></td><td role="cell" align="center" bgcolor="#FFFFFF"><input class="quantity mobile-rtl" name="qty[]' + i + '" type="text" size="1" required/></td><td role="cell" align="center" bgcolor="#FFFFFF"><input class="mobile-rtl" name="size[]' + i + '" type="text" size="3" required/></td><td role="cell" align="center" bgcolor="#FFFFFF"><input class="mobile-rtl" name="color[]' + i + '" type="text" size="3" /required></td><td role="cell" align="center" bgcolor="#FFFFFF"><input class="price1 mobile-rtl" name="price[]' + i + '" type="text" size="5" /required></td><td role="cell" align="center" bgcolor="#FFFFFF"><input class="mobile-rtl" name="info[]' + i + '" type="text" size="15" /required></td><td role="cell" style="text-align:center" align="center" bgcolor="#FFFFFF"><input type="button" style="margin:0 auto;background-color:#964B00;border-radius:5px;padding:5px 15px 5px 15px;color:#fff;border:0" onclick="removepr(' + i + ')" value="حــذف" /></td></tr>');
        $('#maxid').val(i);
        i = i + 1;
        $(".snn").each(function () {
            $(this).text(sn);
            sn = sn + 1;
        });
        sn = 1;
      } else {
        alert("تستطيع فقط اضافة 30 رابط لكل طلب, يمكنك عمل طلب جديد اذا كان لديك أكثر من 30 رابط");
      }
    }
    
    function removepr(id) {
        $('#tr_' + id).remove();
        $(".snn").each(function () {
            $(this).text(sn);
            sn = sn + 1;
        });
        sn = 1;
    }
    $(document).ready(function () {
    if($( window ).width() < 1025){
    addnew(); //1
    if($( window ).width() < 980)
    $('#mobile-browser').val(1);
    }else{
    	addnew(); //1
		addnew(); //2
		addnew(); //3
		addnew(); //4
		addnew(); //5
		
		}
	});
 /*var RecaptchaOptions = { theme : 'clean', custom_translations : { instructions_visual : "أدخل الكلمتين هنا" } };*/
 
 
jQuery(document).ready(function () {
  //called when key is pressed in textbox
    jQuery(".price1").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 46 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
       $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
});


jQuery(document).delegate('.price1', 'click', function()
{
 //called when key is pressed in textbox
    jQuery(".price1").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 46 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
       $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
});


   jQuery(document).ready(function () {
  //called when key is pressed in textbox
    jQuery(".quantity").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
});


jQuery(document).delegate('.quantity', 'click', function()
{
 //called when key is pressed in textbox
    jQuery(".quantity").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
       $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
});


</script>
<!-- Jquery truks -->
<style>

@media screen and (max-width: 768px){
table#FSContact1 tr {
	display: flex;
	width: 100%;
	border-top: 1px solid #ddd;
	padding: 20px 0 0 0;
	align-items: center;
}
table#FSContact1 tr td{
padding:0 0 10px 0 !important;
margin:0 !important;
}
table#FSContact1 tr {
	flex-direction: column;
	align-items: flex-start;
}
table#FSContact1 tr td:first-of-type {
	width: 100%;
	text-align: right;
}
}
@media screen and (max-width: 1024px){
	display: block !important;
	height: 2.65em;
	margin-bottom: 9px;
	border: 1px solid #ddd;
	padding: 0 0.65em;
	/* font-size: 13px; */
	font-size: 1.3rem;
	line-height: 1;
	color: #555;
	background-color: #fff;
	border-radius: 4px;
	box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
}
}

</style>




<style>
t_order tr, td{border: 0;}
input[type="button"] {font-family: "GESSTwoMediumRegular" !important;}

/*
	Max width before this PARTICULAR table gets nasty. This query will take effect for any screen smaller than 760px and also iPads specifically.
	*/
	@media
	  only screen
    and (max-width: 760px), (min-device-width: 768px)
    and (max-device-width: 1024px)  {

		/* Force table to not be like tables anymore */
		table, thead, tbody, th, td, tr {
			display: block;
		}

		/* Hide table headers (but not display: none;, for accessibility) */
         thead tr {
			position: absolute;
			top: -9999px;
			left: -9999px;
		}

  tr {
      margin: 0 0 1rem 0;
    }

    #table1 tr:nth-child(odd) > td{
      background: #ccc !important;
    }
  td {
			/* Behave  like a "row" */
			border: none;
			border-bottom: 1px solid #eee;
			position: relative;
			padding-left: 50%;
		}

      td:before {
			/* Now like a table header */
		//	position: absolute;
			/* Top/left values mimic padding */
			top: 0;
			left: 6px;
			width: 45%;
			white-space: nowrap;
		}

		/*
		Label the data
    You could also use a data-* attribute and content for this. That way "bloats" the HTML, this way means you need to keep HTML and CSS in sync. Lea Verou has a clever way to handle with text-shadow.
		*/
	#table1	td:nth-of-type(1):before { content: "الرقم";
        padding-left:10px;
        }
	#table1	td:nth-of-type(2):before { content: "رابط المنتج";
         padding-left:10px;
         }
	#table1	td:nth-of-type(3):before { content: "الكمية";
         padding-left:10px;
         }
	#table1	td:nth-of-type(4):before { content: "المقاس";
         padding-left:10px;
         }
	#table1	td:nth-of-type(5):before { content: "اللون";
         padding-left:10px;
         }
	#table1	td:nth-of-type(6):before { content: "سعر المنتج بالدولار";
         padding-left:10px;
         }
	#table1	td:nth-of-type(7):before { content: "ملاحظات";
         padding-left:10px;
         }
	#table1	td:nth-of-type(8):before { content: "";
         }

  form#c_form td input{
  width: 100%;
  }

table th, table td {
	border-top: none !important;
}


td {
	border: none;
	border-bottom: none !important;
	position: relative;
	padding-left: 50%;
}

.remove{
margin-top: -20px !important;
}

form#c_form tr input {
 margin:0 !important;
}
	}
.plink1{
direction: ltr !important;
text-align: left !important;
}
.centered-section {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .centered-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
  }

  @media (max-width: 768px) {
    .centered-section {
      flex-direction: column;
    }
  }
</style>
  </div> <!-- END #top.site -->
  
</section>
@include('FrontEnd.footer')
