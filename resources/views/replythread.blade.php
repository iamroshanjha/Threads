@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                <ul  class="list-inline list-unstyled">
                        <li>Replies to this Comment</li>
                        <a class="btn btn-default btn pull-right" href="{{ URL::to('question/'. $slug1)}}">Back to Post</a>
                    </ul>
                </div>
<!--<a href="javascript:history.back()" class="btn btn-default">Voltar</a>-->
                <div class="panel-body">
                    <div class="well">
                        <div class="media">
                            <div class="media-body">
                                <!--<h3 class ="media-heading">|</h3>-->
                                <p class="text-right">By: {{ $reply->user->name}}</p>
                                <p>{{ $reply->body}}</p>
                                <ul class="list-inline list-unstyled">
                                <li><span><i class="glyphicon glyphicon-calendar"></i> {{ $reply->created_at->diffForHumans()}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @forelse($reply->repliesthread as $replythread)
                    <div class="well">
                        <div class="media">
                            <div class="media-body">
                                <p class="text-right">{{$replythread->user->name}}</p>
                                <p>{{$replythread->body}}</p>
                                <ul class="list-inline list-unstyled">
                                <li><span><i class="glyphicon glyphicon-calendar"></i> {{ $replythread->created_at->diffForHumans()}}</span></li>
                                <li>|</li>
                                
                            </div>
                        </div>

                                @if (!Auth::guest() && (Auth::user()->id == $replythread->user->id) )
                                    {!! Form::open(['id'=>'delete-reply-form4', 'url'=>'delete_reply_thread', 'method'=>'DELETE', 'class'=>'form-group text-right']) !!}
                                    {!! Form::hidden('replythread_id',$replythread->id) !!}
                                    {!! Form::button('Delete',['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                                    {!! Form::close() !!}
                                @endif

                    </div>
                     @empty
                    @endforelse
                    
                    @if (!Auth::guest())
                        {!! Form::open(['id'=>'reply-question-form1', 'url'=>'reply1', 'class'=>'form-group']) !!}
                        {!! Form::hidden('slug',$reply->slug) !!}
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
