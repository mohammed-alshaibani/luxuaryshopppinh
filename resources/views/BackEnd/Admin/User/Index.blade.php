@extends('layouts.dashboard.header')
@section('content')

<div class="row"><!-- row 1 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <ol class="breadcrumb"><!-- breadcrumb begin -->
            <li class="active"><!-- active begin -->
                
                <i class="fa fa-dashboard"></i> لوحة التحكم /  الزبائن  
                
            </li><!-- active finish -->
        </ol><!-- breadcrumb finish -->
    </div><!-- col-lg-12 finish -->
</div><!-- row 1 finish -->

<div class="row"><!-- row 2 begin -->
    <div class="col-lg-12"><!-- col-lg-12 begin -->
        <div class="panel panel-default"><!-- panel panel-default begin -->
            <div class="panel-heading"><!-- panel-heading begin -->
               <h3 class="panel-title"><!-- panel-title begin -->
                   <i class="fa fa-tags"></i>   الزبائن/الموظفيين 
               </h3><!-- panel-title finish --> 
        </a>
            </div><!-- panel-heading finish -->
            
            <div class="panel-body"><!-- panel-body begin -->
                <div class="table-responsive"><!-- table-responsive begin -->
                    <table class="table table-striped table-bordered table-hover"><!-- table table-striped table-bordered table-hover begin -->
                        
                    <thead>
                        <tr>
                            <th scope="col">الإسم</th>
                            <th scope="col">الإيميل</th>
                            <th scope="col">نوع العميل</th>
                            <th scope="col">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->type == 0)
                                زبون
                                @elseif ($user->type == 1)
                                خدمة عملاء
                                @elseif ($user->type == 2)
                                مدير النظام
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('User.Edit', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <select name="type" class="form-control" onchange="this.form.submit()">
                                            <option value="0" {{ $user->type == 0 ? 'selected' : '' }}>زبون</option>
                                            <option value="1" {{ $user->type == 1 ? 'selected' : '' }}>خدمة عملاء</option>
                                            <option value="2" {{ $user->type == 2 ? 'selected' : '' }}>مدير النظام</option>
                                        </select>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">
                {{ $users->links() }}
                </div>
</div>

<style>
    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
        padding: 8px;
    }

    .table-bordered thead th {
        background-color: #f8f9fa;
    }

    .form-group {
        margin-bottom: 0;
    }
</style>
@endsection