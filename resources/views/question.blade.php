@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Ask Here...!</div>
                <div class="panel-body">

                @include('layouts.form_errors')

                    {!! Form::open(['id'=>'frm1', 'url'=>'post', 'class'=>'form-group']) !!}

                    {!! Form::label('title','Title') !!}
                    {!! Form::text('title', null, ['id' => 'title', 'class'=>'form-control', 'placeholder'=>'Title', 'required']) !!}
                    <br/>
                    {!! Form::label('category','Category') !!}
                    <select name="category" class="form-control" >
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                    </select>

                    <br/>

                    {!! Form::label('body','Body') !!}
                    {!! Form::textarea('body', null, ['id' => 'body', 'class'=>'form-control', 'rows'=>'5', 'placeholder'=>'Body', 'required']) !!}
                    <br/>
                    {!! Form::label('user',' Users whom you want to notify for this question ') !!}<br/>
                    <div class="dropdown">
                    <button class=" btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Select <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                    <li>&nbsp;<input type='checkbox' name='checkall' onclick='checkedAll(frm1);'> Select All </li>
                        @foreach($users as $user)
                        <li>&nbsp;<input type="checkbox"  name="user[]" value="{{$user->id}}"> {{$user->name}}</li>
                        @endforeach
                      </ul>
                    </div>

                    
                    <br/>

                    {!! Form::button('Post',['class'=>'btn btn-primary', 'type'=>'submit']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
