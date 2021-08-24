@extends('layouts.app')

@section('content')
<section class='evidence'>


    @if(Auth::user()->hasRole('analista'))
    <section>

        <div>
            <!-- loop through evidences object -->
            @foreach($evidences as $evidence)
            <!-- if evidences object is greater than 0
            and each evidence compant id is the same as the analista company id
            display evidences for users in that company -->
            @if((count($evidences)>0) && $evidence->companyId === Auth::user()->companyId)
            <div class='yay ya'>
                <!-- loop through users object -->
                @foreach($users as $user)
                <!-- if a user id = evidence userId get the name of that user -->
                @if($user->id === $evidence->userId)
                <h1>User:{{$user->username}} User Id: {{$user->id}} User Comp:{{$user->companyId}} Evidence
                    Comp:{{$evidence->companyId}} Evidence Attribute ID: {{$evidence->attributeId}}</h1>
                @endif
                @endforeach
                <a href="/storage/upload/<?=$evidence->link?>"> <?=$evidence->link?></a>

            </div>
            <br>

            @else
            <div>
                <h1>Users have not submitted evidences</h1>
            </div>
            @endif
            @endforeach
        </div>

    </section>
    <!-- only roles allowed: anlista & comun so bottom code should display for comun user -->
    @else
    <section>
        <!--IF comu has evidence  -->
        @if( count($user->evidences)>0)
        @foreach($user->evidences as $evidence)
        <div class='yay'>
            <h1>{{$user->username}} {{$evidence->userId}} {{$user->companyId}} {{$evidence->companyId}}</h1>
            <a href="/storage/upload/<?=$evidence->link?>"> link</a>
            <a href="{{route ('upload.edit', $evidence->evidenceId)}}">
                <button>EDIT ME</button>
            </a>

            <div class="">

                @if(session("errors"))
                @foreach($errors as $error)
                <li class='message' id='message'>{{$error}}</li>
                @endforeach
                @else(session("success"))
                <h4 class='message' id='message'>{{session('success')}}</h4>

                @endif
            </div>
        </div>

        @endforeach
        <!-- If comun has no evidence -->
        @else
        <h6> <a href="/upload"> Add sum sugar</a> </h6>
        @endif
        <!--IF ACCESSING ROUTE WITHOUT BEING A REGISTERED USER -->

    </section>
    @endif

</section>

@endsection
