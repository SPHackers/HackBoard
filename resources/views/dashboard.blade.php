@extends('layouts.app')

@section('content')
<div class="flex-center position-ref full-height">
    <div class="container">
        <div class="row">
            <tasks></tasks>
            <currency></currency>
        </div>
        <div class="row">
            <sports></sports>
        </div>
        <div class="row">
            <github></github>
            <news></news>
        </div>
    </div>
</div>
@endsection
