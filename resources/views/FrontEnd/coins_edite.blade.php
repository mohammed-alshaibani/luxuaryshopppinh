@include('header')

<form action="{{route('edit_coin')}}" method="POST">
    @csrf
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
                @foreach($ce as $c)
                <tr>
                    <td><input type="text" name="id" value="{{$c->id}}" readonly></td>
                    <td> <input type="text" name="name_of_coin" value="{{$c->name_of_coin}}" readonly></td>
                    <td><input type="text" name="value" value="{{$c->value}}" class="value"></td>
                    <td><button class="btn btn-success shadow-0 border" type="submit">  حفظ التغييرات</button>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>


</form>

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