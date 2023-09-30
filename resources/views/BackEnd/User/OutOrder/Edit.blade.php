@extends('layouts.dashboard.User.headeruser')
@section('content')
<div class="py-3 py-md-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shadow bg-white p-3">
                    <h4 class="text-primary">
                        <i class="fa fa-shopping-cart text-dark"></i>تفاصيل الطلب
                    </h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                            <h4>تفاصيل الفاتورة</h4>
                            <hr>
                            <h5> رقم الفاتورة  : {{$s->id}}</h5>
                            <h5> تاريخ الطلب    :{{$s->date}}  </h5>
                            <form action="{{ route('User.updateOrder', $s->id) }}" method="POST">
                                      @csrf
                              @method('PUT')
                                <div class="form-group">
                                    <label for="status">حالة الطلب:</label>
                                    <select name="status" class="form-control">
                                        @foreach ($statusOptions as $option)
                                            <option value="{{$option}}" {{$s->status == $option ? 'selected' : ''}}>{{$option}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="comment">رد خدمة العملاء:</label>
                                    <textarea name="comment" class="form-control">{{$s->comment}}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h4>تفاصيل المستخدم</h3>
                            <hr>
                            <h5> اسم المستخدم : {{Auth::user()->name}}</h5>
                            <h5> الايميل       :{{Auth::user()->email}}</h5>
                            <h5> رقم التلفون  :{{Auth::user()->phone}}</h5>
                        </div>
                    </div>
                    <br>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table">
                                <thead> 
                                    <tr >  
                                        <th class="text-right"> رابط المنتج</th>
                                        <th class="text-right"> لون المنتج</th>
                                        <th class="text-right">السعر</th>
                                        <th class="text-right">الحجم</th>
                                        <th class="text-right">العدد</th>
                                        <th class="text-right">ملاحظات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($l as $item)    
                                    <tr>
                                        <td>{{$item->url}}</td>
                                        <td>{{$item->color}}</td>   
                                        <td>
                                            <span class="badge bg-success">{{$item->price}}</span> 
                                        </td>     
                                        <td>{{$item->size}}</td>
                                        <td>{{$item->qty}}</td>
                                        <td>{{$item->note}}</td>
                                    </tr>       
                                    @endforeach
                                </tbody>
                            </table>
                        </div>                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection