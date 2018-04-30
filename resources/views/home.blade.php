@extends('layouts.app')

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Posts</div>

                <div class="card-body">
                </div>
            </div>
        </div>

        @foreach($posts as $post)
        <div class="col-md-8">
                <div class="card">
                <div class="card-header">{{$post->title}}</div>
    
                    <div class="card-body"> 
                        {{$post->body}}  
                    @if($post->id == Auth::user()->id)
                        <div> 
                            <a href="{{route('post.update',$post->id)}}"> <button type="button" class="btn btn-primary">Edit Post </button> </a>
                        </div>
                        {!! Form::model($post, ['method' => 'delete', 'route' => ['post.destroy', $post->id], 'class' =>'form-inline form-delete']) !!}
                            {!! Form::hidden('id', $post->id) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal']) !!}
                        {!! Form::close() !!}
                    @endif

                </div>

                <div class="card-body"> 
                    @foreach($post->comment as $postComment )
                    <h1>{{$postComment->body}}</h1>
                    @if($postComment->user_id == Auth::user()->id)
                    <div> 
                        <a href="{{route('comment.edit',$postComment->id)}}"> <button type="button" class="btn btn-primary">Edit comment </button> </a>
                    </div>
                    {!! Form::model($post, ['method' => 'delete', 'route' => ['comment.destroy', $postComment->id], 'class' =>'form-inline form-delete']) !!}
                        {!! Form::hidden('id', $postComment->id) !!}
                        {!! Form::submit('Delete Comment', ['class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal']) !!}
                    {!! Form::close() !!}
                            @endif
                 @endforeach 
                </div>
                </div>
            </div>
        @endforeach

        <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add New Post</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
    
                        <a href="{{route('post.create')}}"> <button type="button" class="btn btn-primary">Add Post </button> </a>
    
                    </div>
                </div>
            </div>
    
    </div>
</div>
@endsection
