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