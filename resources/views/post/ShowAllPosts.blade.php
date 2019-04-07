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

            @if(count($posts) > 0)
                @foreach ($posts as $post)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <strong>{{ ucwords($post->user['name']) }}</strong>
                                <div class="pull-right">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                           aria-expanded="false">
                                            <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('post.edit', [$post->id]) }}">Edit Post</a></li>
                                            <li>
                                                <a href="#" onclick="document.getElementById('delete').submit()">Delete
                                                    Post</a>
                                                <form method="post" id="delete"
                                                      action="{{ route('post.delete', [$post->id]) }}">
                                                    <input name="_token" type="hidden" id="_token"
                                                           value="{{ csrf_token() }}"/>

                                                </form>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <h4>
                                {{ $post->body }}
                            </h4>
                            @if ($post->image != null)
                                <img src="{{URL::to($post->image)}}" alt="Image" width="100%"
                                     height="600">
                            @endif
                            <br/>
                        </div>

                    </div>
                @endforeach
            @else


                <h3>
                    There is No posts Added
                </h3>
            @endif
        </div>


    </div>
@endsection
