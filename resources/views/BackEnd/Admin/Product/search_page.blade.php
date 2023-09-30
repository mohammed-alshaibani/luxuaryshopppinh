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
                        <th> منتج ترند </th>
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
                                <td>{{ $product->trend ? 'نعم' : 'لا' }}</td>
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