@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{$sujet->title}}</h1>
        <hr>
        <form action="{{route('sujets.update',$sujet)}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title" >Titre</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror"  name="title" id="title" value="{{$sujet->title}}">
            @error('title')
                <div class="invalid-feedback">{{$errors->first('title')}}</div>
            @enderror
            </div>
            <div class="form-group">
                <label for="contenu" >Votre Sujet</label>
                <textarea name="contenu" class="form-control @error('contenu') is-invalid @enderror" id="contenu "  rows="5" >{{$sujet->Contenu}}</textarea>
                @error('contenu')
                <div class="invalid-feedback">{{$errors->first('contenu')}}</div>
            @enderror
            </div>
            <button type="submit" class="btn btn-primary">Modifier Mon Poste</button>
        </form>
    </div>

@endsection