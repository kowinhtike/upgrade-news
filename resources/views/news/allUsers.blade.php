@extends('layouts.app')


@section('content')
    <div class="container">
        @foreach ($users as $user)
            @if (!($user->id == auth()->user()->id))
                <a class=" text-dark text-decoration-none " href="{{ route('profile', ['id' => $user->id]) }}">
                <div class=" d-flex align-items-center border  border-2">
                    <img width="100px" src="https://png.pngtree.com/png-clipart/20190516/original/pngtree-users-vector-icon-png-image_3725294.jpg" alt="">
                    <h2 class=" p-3 "> {{ $user->name }} </h2>
                </div>
                </a>
                <br>
            @endif
        @endforeach
    </div>
@endsection
