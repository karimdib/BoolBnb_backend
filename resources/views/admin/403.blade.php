@extends('layouts.app')
@section('content')
    <div class="message">
        <div class="d-flex flex-column align-items-center">
            <p>You are not allowed</p>
            <a href="{{ route('admin.dashboard') }}">
                <button class="btn btn-primary">Home</button>
            </a>
        </div>
    </div>
@endsection
<style>
    .message {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
