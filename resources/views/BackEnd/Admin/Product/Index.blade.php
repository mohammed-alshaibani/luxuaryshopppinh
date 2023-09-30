@extends('layouts.dashboard.header')

@section('content')
<style>
    .product-image {
        width: 50px;
        height: 50px;
        background-size: cover;
        background-position: center;
    }
</style>
<div class="row"><!-- row 1 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <ol class="breadcrumb"><!-- breadcrumb begin -->
            <li class="active"><!-- active begin -->    
            <i class="fa fa-dashboard"></i> لوحة التحكم / جميع المنتجات
           <div>
           <input type="text" id="searchInput" placeholder="إبحث">
           </div>
            </li><!-- active finish -->

        </ol><!-- breadcrumb finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 1 finish -->

<div class="row"><!-- row 2 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
   
        <div class="panel panel-default"><!-- panel panel-default begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
               <h3 class="panel-title"><!-- panel-title begin -->
               
                   <i class="fa fa-tags"></i>  جميع المنتجات
               </h3><!-- panel-title finish --> 
            </div><!-- panel-heading finish -->
            
            <div class="panel-body"><!-- panel-body begin -->
                <div class="table-responsive"><!-- table-responsive begin -->

            <div id="searchResults">
              <table class="table table-striped table-bordered table-hover"><!-- table table-striped table-bordered table-hover begin -->    
                        <thead><!-- thead begin -->
                        <tr><!-- tr begin -->
                        <th>رقم الصنف</th>
                        <th>اسم المنتج</th>
                        <th> سعر التكلفة </th>
                        <th>سعر البيع </th>
                        <th>فارق السعر </th>
                        <th>السعر بعد التخفيض</th>
                        <th>القسم الرئيسي</th>
                        <th>إسم التاجر </th>
                        <th> عنوان التاجر </th>
                        <th>منتج معروض </th>
                        <th> منتج مميز </th>
                        <th> منتج حديث </th>
                        <th>الإجراءات</th>
                            </tr><!-- tr finish -->
                        </thead><!-- thead finish -->
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->tag }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->seller_price }}</td>
                                <td>{{ $product->original_price }}</td>
                                <td>{{ $product->different_price=$product->original_price-$product->seller_price }}</td>
                                <td>{{ $product->discounted_price }}</td>
                                <td>{{ $product->category->name?? 'لايوجد' }}</td>
                                <td>{{ $product->seller->name ?? 'لايوجد' }}</td> 
                                <td>{{ $product->seller->	address ?? 'لايوجد'}}</td>
                                <td>{{ $product->status ? 'نعم' : 'لا' }}</td>
                                <td>{{ $product->featured ? 'نعم' : 'لا' }}</td>
                                <td>{{ $product->latest ? 'نعم' : 'لا' }}</td>
                                  <td>
                  <div class="btn-group" style="display: inline;">
                       <a href="{{ route('Product.Edit', ['id' => $product->id]) }}" class="btn btn-primary">
                         <i class="fa fa-edit"></i> تعديل
                        </a>
               <form action="{{ route('Product.Destroy',  ['id' => $product->id])}}" method="POST" class="d-inline">
                 @csrf
                 @method('DELETE')
                  <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من رغبتك في حذف هذا المنتج؟')">
                   <i class="fa fa-trash"></i> حذف
                 </button>
                </form>
                   </div>
                   </td>         
                            </tr> 
                            @endforeach
                        </tbody>
                </table>
            </div>
                </div><!-- table-responsive finish -->
                <div class="text-center">
                {{ $products->links() }}
                </div>
            </div><!-- panel-body finish -->

        </div><!-- panel panel-default finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 2 finish -->

@endsection
@section('script')
<script>
  $(document).ready(function() {
    var timer;

    $(document).on('input', '#searchInput', function() {
      clearTimeout(timer);

      var searchInput = $(this).val();

      timer = setTimeout(function() {
        if (searchInput.trim() === '') {
          // Redirect the user back to the page without making an AJAX request
          window.location.href = "{{ route('Product.Index') }}";
        } else {
          performSearch(searchInput);
        }
      }, 500);
    });

    $(document).on('input', '#searchInput', function() {
      var searchInput =$(this).val();
      jQuery.ajax({
        url: "{{ route('searchall') }}",
        type: 'POST',
        dataType: 'html',
        cache: false,
        data: {
          searchInput: searchInput,
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