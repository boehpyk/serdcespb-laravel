@extends('layouts.app', ['dep' => $text->slug])

@section('content')

{{--<h1>{{ $text->title }}</h1>--}}

{!! $text->text !!}

@endsection