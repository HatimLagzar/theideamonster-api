@php
/** @var $tracks \App\Models\MeditationTrack[]|\Illuminate\Database\Eloquent\Collection */
@endphp
@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="row mb-3">
          <div class="col">
            <h3>List Meditation Tracks</h3>
          </div>
          <div class="col">
            <a href="{{ route('meditation.create') }}" class="btn btn-primary float-end ms-auto">Create</a>
          </div>
        </div>
        <table class="table table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Duration</th>
            <th>Created At</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>
          @foreach($tracks as $key => $track)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $track->getName() }}</td>
              <td>{{ $track->getDuration() }}</td>
              <td>{{ $track->getCreatedAt() }}</td>
              <td>
                <a class="btn btn-secondary btn-sm" href="{{ route('meditation.edit', ['track' => $track]) }}">Edit</a>
{{--                <form method="POST" action="{{ route('notifications.push', ['track' => $track]) }}" class="d-inline-block">--}}
{{--                  @csrf--}}
{{--                  <button class="btn btn-warning btn-sm">Send</button>--}}
{{--                </form>--}}
{{--                <form method="POST" action="{{ route('notifications.delete', ['track' => $track]) }}" class="d-inline-block">--}}
{{--                  @method('DELETE')--}}
{{--                  @csrf--}}
{{--                  <button class="btn btn-danger btn-sm">Delete</button>--}}
{{--                </form>--}}
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection