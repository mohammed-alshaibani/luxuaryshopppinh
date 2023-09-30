@include('header')
<div class="card-body p-4">
    <div class="table-responsive">
        <table class="table">
            <thead> 
                <tr>
                    <th>رقم العملة</th>
                    <th>اسم العملة</th>
                    <th>سعر الصرف </th>
                </tr>
            </thead>
            <tbody>

                @foreach($c as $coin)
                <tr>
                    <td>{{$coin->id}}</td>
                    <td>{{$coin->name_of_coin}}</td>
                    <td>{{$coin->value}}</td>
                    <td><a href="{{url('coins',$coin->id)}}" type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">تعديل</a>
                      
                    </td>

                </tr>
                
                @endforeach
                <tr>
                  <td><button  class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">اضافة عملة جديدة</button></td>
                </tr>
            </tbody>

        </table>
   

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="{{route('add_coin')}}">
            @csrf
            <input type="hidden" name ="proudct_id" value="">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">اضافة عملة جديدة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>اسم العملة</label>
                  <input type="text" name="name_of_coins" class="form-control " required>
                </div>
                <div class="form-group">
                  <label> سعر الصرف</label>
                  <input type="text" name="value" class="form-control value" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                <button type="submit" class="btn btn-primary" >حفظ</button>
              </div>
        </form>
      </div>
    </div>
  </div>
  <script>
   
    jQuery(document).ready(function () {
      //called when key is pressed in textbox
        jQuery(".value").keypress(function (e) {
         //if the letter is not digit then display error and don't type anything
         if (e.which != 46 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
           $("#errmsg").html("Digits Only").show().fadeOut("slow");
                   return false;
        }
       });
    });
    </script>
  @include('footer')