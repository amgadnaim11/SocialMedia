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


            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>
                        {{ $postcomment->body }}
                    </h4>
                    @if ($postcomment->image != null)
                        <img src="{{URL::to($postcomment->image)}}" alt="Image" width="100%"
                             height="600">
                    @endif
                    <br/>

                </div>

                <div class="panel-footer" data-postid="{{ $postcomment->id }}">
                    <a href="#" class="btn btn-link">View Comments {{ count($postcomment->comments) }} </a>

                </div>

                @foreach ($postcomment->comments as $comment)
                    <div class="panel panel-default" style="margin: 0; border-radius: 0;">
                        <div class="panel-body">
                            <div class="col-sm-8">
                                <strong>{{ $comment->comment }}</strong>
                            </div>
                            <div class="col-sm-4 text-right">
                                <small style="font-size: smaller">Commented by {{ $comment->user->name }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach



                @if (Auth::check())
                    <div class="panel panel-default" style="margin: 0; border-radius: 0;">
                        <div class="panel-body">
                            <form action="{{ url('/comment') }}" method="POST" style="display: flex;">
                                {{ csrf_field() }}
                                <input type="hidden" name="post_id" value="{{ $postcomment->id }}">
                                <input type="text" name="comment" placeholder="Enter your Comment" class="form-control"
                                       style="border-radius: 0;">
                                <input type="submit" value="Comment" class="btn btn-primary" style="border-radius: 0;">
                            </form>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </div>


    </div>
@endsection
