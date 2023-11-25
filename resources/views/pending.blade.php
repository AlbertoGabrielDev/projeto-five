@extends('layouts.app')
@section('conteudo')
<h1 class ="text-white text-center">Uploads Pendentes</h1>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<ul class="">
    @foreach($uploads as $upload)
        <li class="text-white">
            {{ $upload->user->name }} enviou um arquivo. 
        </li>
        <li>
        <a class="text-white" href="{{ route('approve',['approve'=> $upload->id]) }}">Aprovar</a>...
        <a class="text-white" href="{{ route('reject',['reject'=> $upload->id]) }}">Rejeitar</a>
        </li>
    @endforeach
</ul>
@endsection