@extends('layouts.app-template')

@section('content')

    <div class="container">
        <div class="col-sm-6 col-sm-offset-3">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {{ Session::get('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('post.update', [$editpost->id]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">

                        <textarea name="body" rows="6" cols="60" class="form-control"
                                  placeholder="Enter your post">{{$editpost->body}}</textarea>
                            @if ($errors->has('body'))
                                <small class="text-danger">{{ $errors->first('body') }}</small>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="file" class="form-control" name="image">
                            {{--{{$editpost->image}}--}}
                        </div>


                        <input type="submit" value="Edit" class="btn btn-primary btn-block">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
