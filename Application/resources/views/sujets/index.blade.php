@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="list-group">
            @foreach ($sujets as $sujet)
            <div class="mb-2 border">
                <div class="list-group-item">
                    <h5><a href="{{route('sujets.show',$sujet)}}">{{$sujet->title}}</a></h5>
                    <p>{{$sujet->Contenu}}</p>
                <div class="d-flex justify-content-between">
                    <small>Publieé le {{$sujet->created_at->format('d/m/Y à H:m')}}</small>
                    <span class="badge badge-primary align-items-center">{{$sujet->user->name}}</span>
                </div>
                </div>
            </div>
            @endforeach
                  {{$sujets->links()}}

        </div>
    </div>

@endsection