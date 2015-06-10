@extends('layouts/main')
@section('content')
<div class="row gap_top_20">
    <div class="jumbotron text-center">
      <h1>{{ $error['heading'] }}</h1>
      <p>{{ $error['description'] }}</p>
      <p class="gap-top-20"><a class="btn btn-primary btn-lg" href="{{ url('/') }}" role="button">Let's go back</a></p>
    </div>
</div>
@stop