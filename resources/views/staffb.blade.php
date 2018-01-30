@extends('templates.default')
@section('title',$title)

@section('content')
With Blade
<h1>
{{$title}}
</h1>

 

@if($staff)
    
    <ul>
    @foreach ($staff as $person)
        <li> {{$person['name']}} {{$person['lastname']}} </li>
    @endforeach
    </ul>
    @else
     <p>No Staff</p>
@endif
@endsection