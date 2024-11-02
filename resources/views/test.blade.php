@extends('layouts.app')
@section('title', 'Bilal')
@section('content')

<div x-data="{ show: false }">
    <button @click="show = !show">Toggle</button>
    <div x-show="show">
        This content will be shown/hidden.
    </div>
</div>


@endsection