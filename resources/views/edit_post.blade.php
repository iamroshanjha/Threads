@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Here</div>
                <div class="panel-body">

                @include('layouts.form_errors')

                    {!! Form::model($post,['id'=>'edit-question-form', 'url'=>'edit_post', 'class'=>'form-group']) !!}

                    {!! Form::hidden('post_id',$post->id) !!}

                    {!! Form::label('title','Title') !!}
                    {!! Form::text('title', null, ['id' => 'title', 'class'=>'form-control', 'placeholder'=>'Title', 'required']) !!}
                    <br/>
                    {!! Form::label('category','Category') !!}
                    <select name="category" class="form-control" >
                    @foreach($categories as $category)
                        @if($category->id == $post->category_id)
                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                        @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                    @endforeach
                    </select>

                    <br/>

                    {!! Form::label('body','Body') !!}
                    {!! Form::textarea('body', null, ['id' => 'body', 'class'=>'form-control', 'rows'=>'5', 'placeholder'=>'Body', 'required']) !!}
                    <br/>
                    {!! Form::button('Submit',['class'=>'btn', 'type'=>'submit']) !!}
                    {!! Form::close() !!}
                    <a class="btn btn-default active" href="{{ url('cancel') }}">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
