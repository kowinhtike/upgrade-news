@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-8">
            <h1>This is post edit form</h1>
            <form action="{{ route('update-new',['id' => $new->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input type="text" value="{{ $new->title }}" name="title" class="form-control"  placeholder="input title">
                    @error("title")
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Your Content</label>
                    <textarea class="form-control"  name="body"  rows="3">{{ $new->body }}</textarea>
                    @error("body")
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" placeholder="Image" class="form-control">
                    @error("image")
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class=" d-flex  justify-content-center ">
                    <button type="submit" class="btn btn-dark">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
