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
                <div class="card-header">Edit Comment</div>
                {!! Form::open(['action' => $action]) !!}
                    {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label for="exampleInputEmail1"></label>
                            <textarea class="form-control" name="body" rows="5"   placeholder="Enter The Post Body" >
                                    {{ isset ($comment) ? $comment->body : " " }}
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
