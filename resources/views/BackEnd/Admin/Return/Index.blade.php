@extends('layouts.dashboard.header')

@section('content')

<div class="row"><!-- row 2 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <div class="panel panel-default"><!-- panel panel-default begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
                <h3 class="panel-title"><!-- panel-title begin -->
                    <i class="fa fa-tags"></i> جميع الطلبات
                </h3><!-- panel-title finish --> 
            </div><!-- panel-heading finish -->
            
            <div class="panel-body"><!-- panel-body begin -->
                <div class="table-responsive"><!-- table-responsive begin -->
                <form>
                  <label>فلتر الحالة</label>
                     <select name="status" id="searchInput">
                     <option value="">الكل</option>
                       <option value="قيد التحقق">قيد التحقق</option>
                       <option value="تم الإرجاع">تم الإرجاع</option>
                       <option value="ملغي">ملغي</option>
                     </select>
                </form>

                <div id="orderTable">
                        <table class="table table-striped table-bordered table-hover"><!-- table table-striped table-bordered table-hover begin -->
        <thead>
            <tr>
                <th>رقم الطلب المرجوع</th>
                <th>السبب</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
                <!-- Add more columns if needed -->
            </tr>
        </thead>
        <tbody>
            @foreach ($returns as $return)
                <tr>
                    <td>{{ $return->id }}</td>
                    <td>{{ $return->reason }}</td>
                    <td>{{ $return->status }}</td>

                    <td>
                    <a href="{{ route('BackEnd.Return.Edit', ['id' => $return->id]) }}" class="btn btn-primary">
                         <i class="fa fa-edit"></i> تعديل
                        </a></td>
                    <!-- Display more details if needed -->
                </tr>
                @endforeach
                        </tbody><!-- tbody finish -->
                        
                    </table><!-- table table-striped table-bordered table-hover finish -->
                </div>
                </div><!-- table-responsive finish -->
            </div><!-- panel-body finish -->
            <div class="text-center">
                    {{ $returns->links() }}
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
                url: "{{route('search.return')}}",
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
</script>
@endsection