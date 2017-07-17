@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul  class="list-inline list-unstyled">
                        <li>Replies to this Comment</li>
                <a class="btn btn-default btn pull-right" href="{{ url('home') }}">Home</a>
            </ul>
                </div>

                <div class="panel-body">
                    <div class="well">
                        <div class="media">
                            <div class="media-body">
                                <h3 class ="media-heading">{{ $post->title}}</h3>
                                <p class="text-right">By: {{ $post->user->name}}</p>
                                <p>{{ $post->body}}</p>
                                <ul class="list-inline list-unstyled">
                                <li><span><i class="glyphicon glyphicon-calendar"></i> {{ $post->created_at->diffForHumans()}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @forelse($post->replies as $reply)
                    <div class="well">
                        <div class="media">
                            <div class="media-body">
                                <p class="text-right">{{$reply->user->name}}</p>
                                <p>{{$reply->body}}</p>
                                <ul class="list-inline list-unstyled">
                                <li><span><i class="glyphicon glyphicon-calendar"></i> {{ $reply->created_at->diffForHumans()}}</span></li>
                                <li>|</li>
                                
                                <li><a  href="reply/like/{{$reply->id}}"><span><i class="glyphicon glyphicon-thumbs-up"></i></span></a></li>
                               
                            <!--    <li><a  href="reply/like/{{$reply->id}}"><span><i class="glyphicon glyphicon-thumbs-down"></i></span></a></li> -->
                            
                                <li>
                                        @if($reply->likes->count() > 0)
                                        <li>{{ $reply->likes->count() }} Like (s)</li>
                                        @else
                                        <li>Be the first to Like</li>
                                        @endif
                                </li>
                                <li>|</li>

                                <li><a class="btn  btn-md" href="{{$post->slug}}/reply1/{{$reply->slug}}">Reply</a></li>

                            </div>
                        </div>

                                @if (!Auth::guest() && (Auth::user()->id == $reply->user->id) )
                                    {!! Form::open(['id'=>'delete-reply-form2', 'url'=>'delete_reply', 'method'=>'DELETE', 'class'=>'form-group text-right']) !!}
                                    {!! Form::hidden('reply_id',$reply->id) !!}
                                    {!! Form::button('Delete',['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                                    {!! Form::close() !!}
                                @endif

                    </div>
                     @empty
                     <!--   <div class="well">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class ="media-heading">Be the first to Comment</h5>
                                 </div>
                            </div>
                        </div> -->
                    @endforelse
                    
                    @if (!Auth::guest())
                        {!! Form::open(['id'=>'post-question-form1', 'url'=>'reply', 'class'=>'form-group']) !!}
                        {!! Form::hidden('slug',$post->slug) !!}
                        {!! Form::textarea('body', null, ['id' => 'body', 'class'=>'form-control', 'rows'=>'3', 'placeholder'=>'Your Comment Here', 'required']) !!}
                        <br/>
                        {!! Form::button('Comment',['class'=>'btn', 'type'=>'submit']) !!}
                        {!! Form::close() !!}
                    @endif
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
