@extends('layouts.dashboard.User.headeruser')

@section('content')

<div class="row"><!-- row 2 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <div class="panel panel-default"><!-- panel panel-default begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
                <h3 class="panel-title"><!-- panel-title begin -->
                    <i class="fa fa-tags"></i> جميع الطلبات
                    <div>
           <input type="text" id="searchput" placeholder="إبحث">
           </div>
                </h3><!-- panel-title finish --> 
            </div><!-- panel-heading finish -->
            

          
                <div class="table-responsive"><!-- table-responsive begin -->
                <form>
                  <label>فلتر الحالة</label>
                     <select name="status" id="searchInput">
                     <option value="">الكل</option>
                       <option value="قيد الإنتظار">قيد الإنتظار</option>
                       <option value="تم الطلب">تم الطلب</option>
                       <option value="في مستودعتنا">في مستودعتنا</option>
                       <option value="تم التوصيل">تم التوصيل</option>
                       <option value="ملغي">ملغي</option>
                     </select>
                </form>
                <div id="orderTable">
                      <div id="searchResults">

                    <table class="table table-striped table-bordered table-hover"><!-- table table-striped table-bordered table-hover begin -->
                    
                        <thead><!-- thead begin -->
                            <tr><!-- tr begin -->
                                <th> رقم الطلب: </th>
                                <th> إسم العميل: </th>
                                <th> الإجمالي: </th>
                                <th> تاريخ الطلب: </th>
                                <th> طريقة الدفع: </th>
                                <th> الحالة: </th>
                                <th> الإجراءات: </th> <!-- Changed from "Delete" to "Actions" -->
                            </tr><!-- tr finish -->
                        </thead><!-- thead finish -->
                        
                        <tbody><!-- tbody begin -->
                            @foreach ($orderDetails as $item)
                        <tr><!-- tr begin -->
                                <td>                     
                            {{ $item->id }}
                                </td>
                                <td>{{ $item->fullname }}</td>   
                                <td>{{ $item->total }}</td>   
                                <td>
                                    {{ $item->order_date }}
                                </td>
                                <td>
                                    {{ $item->payment_method }}
                                </td>
                            <td>
                                <span class="badge bg-success">{{ $item->status }}</span>
                            </td>   
                            <td>
                                <a href="{{ url('dashboard/service/Order/edit/'.$item->id) }}" class="btn btn-primary">
                                    تعديل
                                </a>
                            </td> 
                                </tr><!-- tr finish -->
                            @endforeach
                        </tbody><!-- tbody finish -->
                        
                    </table><!-- table table-striped table-bordered table-hover finish -->
                </div><!-- table-responsive finish -->
                </div>

            </div><!-- panel-body finish -->
            <div class="text-center">
                    {{ $orderDetails->links() }}
                </div>
        </div><!-- panel panel-default finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 2 finish -->


@endsection
@section('script')
<script>
    $(document).ready(function() {
        var timer;

        $('#searchInput').change(function() {
            clearTimeout(timer);

            var searchInput = $(this).val();

            timer = setTimeout(function() {
                performSearch(searchInput);
            }, 500);
        });

        function performSearch(searchInput) {
            $.ajax({
                url: "{{ route('search.order.user') }}",
                type: "POST",
                dataType: "html",
                data: {
                    searchInput: searchInput,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    if (data.trim() === "") {
                        $("#orderTable").html("<p>لا يوجد نتائج</p>");
                    } else {
                        $("#orderTable").html(data);
                    }
                },
                error: function() {
                    // Handle error
                }
            });
        }
    });

    
    /**Search */
    $(document).ready(function() {
    var timer;

    $(document).on('input', '#searchput', function() {
      clearTimeout(timer);

      var searchput = $(this).val();

      timer = setTimeout(function() {
        if (searchput.trim() === '') {
          // Redirect the user back to the page without making an AJAX request
          window.location.href = "{{ route('User.order_details.index') }}";
        } else {
          performSearch(searchput);
        }
      }, 500);
    });

    $(document).on('input', '#searchput', function() {
      var searchput =$(this).val();
      jQuery.ajax({
        url: "{{ route('searchfororder') }}",
        type: 'POST',
        dataType: 'html',
        cache: false,
        data: {
            searchput: searchput,
          "_token": "{{ csrf_token() }}"
        },
        success: function(data) {
          if (data.trim() === "") {
            $("#searchResults").html("<p>لا يوجد نتائج</p>");
          } else {
            $("#searchResults").html(data);
          }
        },
        error: function() {
        }
      });
    });
  });
</script>
@endsection