@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <a class="btn btn-sm btn-success float-right" href="{{route('users.create')}}" role="button">Create</a>
    </div>
  <div class="col-5">
    <h1 class="float-left">Users</h1>
<div class="card">
    <table class="table align-middle">
        <thead>
          <tr>
            <th scope="col">#Id</th>
            <th scope="col">Name</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td style="width: 20px">{{$user->name}}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger"
                    onclick="event.preventDefault();
                    document.getElementById('delete-user-form-{{$user->id}}').submit()"
                    >Delete</button>
                    <form id="delete-user-form-{{$user->id}}" action="{{route('users.destroy',$user->id)}}" method="POST" style="display: none">
                      @csrf
                      @method("DELETE")
                    </form>
                  </td>
              </tr>
            @endforeach
        </tbody>
      </table>
        <center>{{$users->links()}}
          </center>

</div>
</div>
<div class="col">
  <h1 class="float-left">Posts</h1>
  <div class="card">
    <table class="table align-middle">
        <thead>
          <tr>
            <th scope="col">#Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($sujets as $sujet)
            <tr>
                <th scope="row">{{$sujet->id}}</th>
                <td>{{$sujet->title}}</td>
                <td style="width: 60%">{{$sujet->Contenu}}</td>
                <td>
                
                    <button type="button" class="btn btn-sm btn-danger"
                    onclick="event.preventDefault();
                    document.getElementById('delete-user-form-{{$sujet->id}}').submit()"
                    >Delete</button>
                    <form id="delete-user-form-{{$sujet->id}}" action="{{route('users.update',$sujet->id)}}" method="POST" style="display: none">
                      @csrf
                      @method("PATCH")
                    </form>
                  </td>
              </tr>
            @endforeach
        </tbody>
      </table>
      {{$sujets->links()}}
</div>
</div>

</div>
</div>
@endsection