@extends('layouts.app')
@include('layouts.form_errors')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Select your Interests</div>
                                <div class="panel-body">
                    <a class="btn btn-block btn-primary text-muted active" href="{{ url('question') }}">Ask a Question!</a><br />
                    
                        @forelse($posts as $post)
                        
                        <div class="well">
                            <div class="media">
                                <div class="media-body">
                                    <h3 class ="media-heading">{{ $post->title}}</h3>
                                    <p class="text-right">Category: {{ $post->category->name}}</p>
                                    <p class="text-right">By: {{ $post->user->name}}</p>
                                    <p>{{ str_limit($post->body, $limit = 100, $end = '...')}}</p>
                                    <p><a class = "btn" href="question/{{$post->slug}}">More</a></p>
                                    <ul class="list-inline list-unstyled">
                                        <li><span><i class="glyphicon glyphicon-calendar"></i> {{ $post->created_at->diffForHumans()}}</span></li>
                                        <li>|</li>
                                        @if($post->replies->count() > 0)
                                        <li>{{ $post->replies->count() }} Comment (s)</li>
                                        @else
                                        <li>Be the first to Comment</li>
                                        @endif
                                        @if (!Auth::guest() && (Auth::user()->id == $post->user->id) )
                                        <li>|</li>
                                        <li><a class="btn btn-md text-muted" href="{{$post->id}}/get_edit_post"><span><i class="glyphicon glyphicon-pencil "></i> Edit</span></a></li>
                                        @endif


                                    </ul>
                                </div>

                            @if (!Auth::guest() && (Auth::user()->id == $post->user->id) )
                                {!! Form::open(['id'=>'delete-question-form2', 'url'=>'delete_post', 'method'=>'DELETE', 'class'=>'form-group text-right']) !!}
                                {!! Form::hidden('post_id',$post->id) !!}
                                {!! Form::button('Delete',['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                                {!! Form::close() !!}
                            @endif

                            </div>
                        </div>

                        @empty
                        <div class="well">
                            <div class="media">
                                <div class="media-body">
                                    <h4 center class ="media-heading">No Posts Yet</h4>
                                 </div>
                            </div>
                        </div>     
                        @endforelse

                        {!! $posts->appends(Request::all())->render()!!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
