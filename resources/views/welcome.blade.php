@extends('layouts.app')

@section('content')
    @include('events.show', ['event' => $event])
@endsection
