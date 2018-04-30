@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="card-header">Add New Post</div>
                {!! Form::open(['action' => $action]) !!}
                @if(isset($post))
                    {{ method_field('PATCH') }}
                @else
                    {{ method_field('POST') }}
                @endif
                      <div class="form-group">
                          <label for="title">Post Title</label>
                          <input type="text" class="form-control" name="title" value= "{{ isset ($post) ? $post->title : " " }}" placeholder="Enter Post Title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Post body</label>
                            <textarea class="form-control" name="body" rows="5"   placeholder="Enter The Post Body" >
                                    {{ isset ($post) ? $post->body : " " }}
                            </textarea>
                          </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        {!! form::close() !!}
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
