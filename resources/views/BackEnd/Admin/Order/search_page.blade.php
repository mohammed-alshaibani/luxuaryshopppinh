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
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->fullname }}</td>   
                                <td>{{ $item->total }}</td>   
                                <td>{{ $item->order_date }}</td>
                                <td>{{ $item->payment_method }}</td>
                                <td>
                                    <span class="badge bg-success">{{ $item->status }}</span>
                                </td>   
                                <td>
                                    <a href="{{ url('dashboard/Order/edit/'.$item->id) }}" class="btn btn-primary">
                                        تعديل
                                    </a>
                                </td> 
                            </tr><!-- tr finish -->
                        @endforeach
                    </tbody><!-- tbody finish -->
                </table><!-- table table-striped table-bordered table-hover finish -->
        