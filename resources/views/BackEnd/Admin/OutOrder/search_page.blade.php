<table class="table table-striped table-bordered table-hover"><!-- table table-striped table-bordered table-hover begin -->
                        
                        <thead><!-- thead begin -->
                            <tr><!-- tr begin -->
                                <th> رقم الطلب: </th>
                                <th> إسم العميل: </th>
                                <th> تاريخ الطلب: </th>
                                <th> الحالة: </th>
                                <th> الإجراءات: </th> <!-- Changed from "Delete" to "Actions" -->
                            </tr><!-- tr finish -->
                        </thead><!-- thead finish -->
                        
                        <tbody><!-- tbody begin -->
    @foreach ($orderDetails as $item)
        <tr><!-- tr begin -->
            <td>{{ $item->id }}</td>
            <td>{{ $item->user->name }}</td> <!-- Display user's name -->
            <td>{{ $item->date }}</td>
            <td>
                <span class="badge bg-success">{{ $item->status }}</span>
            </td>
            <td>
                <a href="{{ url('dashboard/OutOrder/orderout-edit/'.$item->id) }}" class="btn btn-primary">
                    تعديل
                </a>
            </td>
        </tr><!-- tr finish -->
    @endforeach
</tbody><!-- tbody finish -->
                        
                    </table><!-- table table-striped table-bordered table-hover finish -->