@extends('layouts.app')

@section('content')

<!-- <?=$user?> -->

@foreach($user as $employee)
<section class="employeeContainer">
    <a href='/users/{{$employee->id}}'>
        <h3>{{$employee->id}}</h3>
    </a>
    <p>{{$employee->username}}</p>
    <p>{{$employee->firstName}}</p>
    <p>{{$employee->lastName}}</p>
    <p>{{$employee->email}}</p>
    <p>{{$employee->roleId}}</p>

    <form class='deleteUser' method='POST' action="/users/{{$employee->id}}">
        @method('DELETE')
        @csrf
        <section class="field">
            <section class="control">
                <button type="submit" class="button is-link">eliminar usuario</button>
            </section>
        </section>
    </form>
</section>

@endforeach
@endsection
