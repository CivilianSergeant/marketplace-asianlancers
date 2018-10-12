@extends('templates.default.default')

@section('wrapper')
    <h1>Custom Login</h1>
    {{Form::Open(array('url'=>'home/login','method' => 'post'))}}
        <p>
            <label>E-mail</label>
            <input type="text" name="email"/>
        </p>
        <p>
            <label>Password</label>
            <input type="password" name="password"/>
        </p>
        <p>
            <input type="submit" name="submit" value="Login"/>
        </p>
    {{Form::Close()}}
@stop
