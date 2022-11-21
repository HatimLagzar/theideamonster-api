@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h3>Edit Meditation Track</h3>
        <form action="{{ route('meditation.update', ['track' => $track]) }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group mb-2">
            <label for="nameInput" class="form-label">Name</label>
            <input type="text" name="name" id="nameInput" class="form-control @error('name') is-invalid @enderror" value="{{ $track->getName() }}">
            <div class="invalid-feedback">
              @error('name')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group mb-2">
            <label for="durationInput" class="form-label">Duration</label>
            <input type="text" name="duration" id="durationInput" class="form-control @error('duration') is-invalid @enderror" placeholder="eg: 30 min" value="{{ $track->getDuration() }}">
            <div class="invalid-feedback">
              @error('duration')
              {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group mb-2">
            <label for="audioFileInput" class="form-label">Audio File</label>
            <input type="file" name="track" id="audioFileInput" class="d-block @error('track') is-invalid @enderror" accept="audio/*">
            <div class="invalid-feedback">
              @error('track')
              {{ $message }}
              @enderror
            </div>
          </div>

          <button class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
@endsection