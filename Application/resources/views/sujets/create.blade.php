@extends('layouts.app')
{{-- @section('extra-js')
{!! NoCaptcha::renderJs() !!}
@endsection --}}
@section('content')
<div class="container">
    <h1>Creer un Post</h1>
    <hr>
    <form action="{{route('sujets.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title">
            @error('title')
            <div class="invalid-feedback">{{$errors->first('title')}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="contenu">Votre Sujet</label>
            <textarea name="contenu" class="form-control @error('contenu') is-invalid @enderror" id="contenu "
                rows="5"></textarea>
            @error('contenu')
            <div class="invalid-feedback">{{$errors->first('contenu')}}</div>
            @enderror
        </div>
        {{-- <div class="form-group">
            {!! NoCaptcha::display() !!}
            @if ($errors->has('g-recaptcha-response'))
            <span class="help-block">
                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
            </span>
            @endif

        </div> --}}
        <button type="submit" class="btn btn-primary">Créer Mon Poste</button>
    </form>
</div>

@endsection