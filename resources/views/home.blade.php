@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('All Posts') }}</div>

                    <div class="card-body">
                        {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} --}}

                        @foreach ($news as $new)
                            <div class="mt-3 p-2 pb-5 d-flex flex-column align-items-center  ">
                                <div class="container-fluid">
                                    <h2 class=" p-3 ">{{ $new->title }}</h2>
                                </div>
                                <a href="{{ route('show-new', ['id' => $new->id]) }}"> <img width="100%"
                                        src="{{ asset('storage' . '/' . $new->image_url) }}"> </a>
                                        
                            </div>
                            <hr>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
