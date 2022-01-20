@extends('layouts.main')

@section('content') 
@include('layouts.topmenu')
@include('layouts.leftmenu')
@include('layouts.rightmenu')

<div class="row">
    <div class="col-lg-6 margin-tb">
        <div class="pull-left">
            <h2></h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="/show"> All Registered Employess</a>
        </div>
    </div>
</div>
<form action="/search" method="POST" role="search">
    {{ csrf_field() }}
    <div class="input-group">
        <input type="text" class="form-control" name="q"
            placeholder="Search users"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div>
</form>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordere d pull-right">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Company Name</th>
        <th>Location</th>
        <th>email</th>
        <th>Contact number</th>
        <th>Registration id</th>

    </tr>
    @foreach ($employees as $employee)
    <tr>
        <td>{{ $employee->id }}</td>
        <td>{{ $employee->name }}</td>
        <td>{{ $employee->company_name }}</td>
        <td>{{ $employee->location }}</td>
        <td>{{ $employee->email }}</td>
        <td>{{ $employee->contact_number }}</td>
        <td>{{ $employee->registration_id }}</td>
    </tr>
    @endforeach
</table>

{!! $employees->links() !!}

@endsection