@extends('layouts.app')
@section('extra-js')
    <script>
        function toggleREplyComment(id)
        {
                let element = document.getElementById('commentreply-'+id);
                element.classList.toggle('d-none');
        }
    </script>
@endsection
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{$sujet->title}}</h5>
            <p>{{$sujet->Contenu}}</p>
            <div class="d-flex justify-content-between">
                <small>Publieé le {{$sujet->created_at->format('d/m/Y à H:m')}}</small>
                <span class="badge badge-primary align-items-center">{{$sujet->user->name}}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                @can('update', $sujet)
                <a href="{{route('sujets.edit',$sujet)}}" class="btn btn-warning">Editer</a>
                @endcan
                @can('delete', $sujet)
                <form action="{{route('sujets.destroy',$sujet)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
                @endcan

            </div>
        </div>
    </div>
        <hr>
        <h5>Commentaires</h5>
        @forelse ($sujet->comments as $comment)
            <div class="card mb-2">
                <div class="card-body">
                    <div>
                    {{$comment->content}}
                    <div class="d-flex justify-content-between">
                        <small>Publieé le {{$comment->created_at->format('d/m/Y')}}</small>
                        <span class="badge badge-primary align-items-center">{{$comment->user->name}}</span>
                    </div>
                </div>
            </div>
            <div class="text-center mb-2">
                @if (!$sujet->solution && auth()->user()->id === $sujet->user_id)
                <solution-button sujet-id="{{$sujet->id}}" comment-id="{{$comment->id}}"></solution-button>
                @else
                    @if ($sujet->solution === $comment->id)
                    <h4><span class="badge badge-success">La Solution</span></h4>
                    @endif
                @endif
            </div>
            </div>
            @foreach ($comment->comments as $replycomment)
            <div class="card mb-2 ml-5">
                <div class="card-body ">
                    {{$replycomment->content}}
                    <div class="d-flex justify-content-between">
                        <small>Publieé le {{$replycomment->created_at->format('d/m/Y')}}</small>
                        <span class="badge badge-primary align-items-center">{{$replycomment->user->name}}</span>
                    </div>
                </div>
            </div>
            @endforeach
            @auth 
            <button type="submit" class="btn btn-info mb-3" onclick="toggleREplyComment({{$comment->id}})">Repondre</button>
            <form action="{{route('comments.store.reply',$comment)}}" method="POST" class="mb-3 ml-5 d-none" id="commentreply-{{$comment->id}}">
                @csrf
                <div class="form-group">
                    <label for="reply">Ma reponse</label>
                    <textarea name="replycomment" class="form-control @error('replycomment') is-invalid
                        
                    @enderror" id="replycomment" rows="5"></textarea>
                    @error('replycomment')
                        <div class="invalid-feedback">{{$errors->first('replycomment')}}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Repondre a ce commentaire</button>
            </form>
            @endauth

            @empty
            <div class="alert alert-info">Aucun comentaire pour ce post</div>
        @endforelse
        <form action="{{route('comments.store',$sujet)}}" method="POST" class="mt-3">
            @csrf
            <div class="form-group">
                <label for="content">Votre Commentaire</label>
                <textarea class="form-control @error('content') is-invalid     
                @enderror" name="content" id="content"  rows="5"></textarea>
                @error('content')
                    <div class="invalid-feedback">
                        {{$errors->first('content')}}
                    </div>
                @enderror
            </div>
            <button class="btn btn-primary" type="submit">Add Commentaire</button>
        </form>
</div>

@endsection