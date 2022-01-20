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
            <a class="btn btn-success" href="/show"> </a>
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


@if(isset($users))
<p> The Search results for your query <b> </b> are :</p>
<h2>Sample User details</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Company Name</th>
            <th>Location</th>
            <th>email</th>
            <th>Contact number</th>
            <th>Registration id</th>

        </tr>

        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->company_name }}</td>
            <td>{{ $user->location }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->contact_number }}</td>
            <td>{{ $user->registration_id }}</td>
        </tr>
        @endforeach
        </tbody>
</table>
@elseif(isset($message))
<p>{{ $message }}</p>
@endif
</div>
{!! $users->links() !!}
@endsection
