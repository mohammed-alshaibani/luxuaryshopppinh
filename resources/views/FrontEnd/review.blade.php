@include('FrontEnd.header')
<div class="container">
  <div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <form action="{{url('Orders/add-reviews')}}" method="POST">
                    @csrf
                    <input type ="hidden" name="proudct_id" value="{{$proudct->id}}">
                    <textarea class="form-control" name="user_review" rows="5" placeholder="اكتب المراجعة هنا"></textarea>
                    <button class="btn btn-primary  mt-3" type="submit">ارسال</button>
                </form>
            </div>
        </div>
        
        
    </div>
  </div>
</div>
@include('FrontEnd.footer')