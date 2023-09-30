<table class="table table-striped table-bordered table-hover"><!-- table table-striped table-bordered table-hover begin -->    
                        <thead><!-- thead begin -->
                        <tr><!-- tr begin -->
                        <th>رقم الصنف</th>
                        <th>اسم المنتج</th>
                        <th>سعر البيع </th>
                        <th>السعر بعد التخفيض</th>
                        <th>القسم الرئيسي</th>
                        <th>إسم التاجر </th>
                        <th> عنوان التاجر </th>
                        <th>منتج معروض </th>
                        <th> منتج مميز </th>
                        <th> منتج ترند </th>
                            </tr><!-- tr finish -->
                        </thead><!-- thead finish -->
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->tag }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->original_price }}</td>
                                <td>{{ $product->discounted_price }}</td>
                                <td>{{ $product->category->name?? 'لايوجد' }}</td>
                                <td>{{ $product->seller->name ?? 'لايوجد' }}</td> 
                                <td>{{ $product->seller->	address ?? 'لايوجد'}}</td>
                                <td>{{ $product->status ? 'نعم' : 'لا' }}</td>
                                <td>{{ $product->featured ? 'نعم' : 'لا' }}</td>
                                <td>{{ $product->trend ? 'نعم' : 'لا' }}</td>
                                    
                            </tr> 
                            @endforeach
                        </tbody>
                </table>