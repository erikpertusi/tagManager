@extends('layouts.app')

@section('title', isset($title) ? $title : null)

@section('content')
    @if(isset($vueComponent))
        {!! '<'.$vueComponent.'></'.$vueComponent.'>' !!}
    @elseif(isset($content))
        {!! $content !!}
    @endif
@endsection
