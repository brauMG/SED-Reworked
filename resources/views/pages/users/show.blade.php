@extends('layouts.app')

@section('content')
<section class='mainContainer'>
    <main>
      
        <p><?=$user->username?></p>
                    <p>{{$user->firstName}}</p>
                    <p>{{$user->lastName}}</p>
                    <p>{{$user->email}}</p>
    
 
    </main>


@endsection