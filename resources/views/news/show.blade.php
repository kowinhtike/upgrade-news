@extends('layouts.app')

@section('content')
    <div class=" container-fluid p-3 ">
        <div class="row">
            <div class="col-sm-4 bg-light p-3 card ">
                <h2>{{ $new->title }}</h2>
                <p>
                    {{ $new->body }}
                </p>
                <a href="{{ route('show-new', ['id' => $new->id]) }}"> <img width="100%"
                        src="{{ asset('storage' . '/' . $new->image_url) }}"> </a>
                <br>

                @if ($new->user->id == auth()->user()->id)
                    <div class=" d-flex justify-content-evenly  mb-3    p-2 bg-white">
                        <div class=" m-2 ">
                            <a href="{{ route('edit-new', ['id' => $new->id]) }}" class="btn btn-dark">Edit</a>
                        </div>
                        <div class=" m-2 ">
                            <a href="{{ route('delete-new', ['id' => $new->id]) }}" class="btn btn-danger">Delete</a>
                        </div>

                    </div>
                @endif

            </div>
            <div class="col-sm-8 bg-white p-3 ">



                {{-- comment input --}}

                <form class=" p-3  d-flex " action="{{ route('newComment', ['id' => $new->id]) }}" method="POST">
                    @csrf
                    <input autocomplete="off" class=" form-control " type="text" name="text">
                    <button class="btn btn-primary " type="submit">Send</button>
                </form>

                <div class=" p-3 ">

                    @foreach ($comments as $comment)
                        <div class="card m-2 ">
                            <div class="card-header">
                                {{-- {{ App\Models\User::find($comment->user_id)->name }} --}}
                                {{ $comment->user->name }}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $comment->text }}</h5>

                            </div>
                        </div>
                    @endforeach

                </div>



            </div>
        </div>




    </div>
@endsection
