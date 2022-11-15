@php
  /** @var $notification \App\Models\Notification */
@endphp
@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h3>Edit Notification</h3>
        <form action="{{ route('notifications.update', ['notification' => $notification]) }}" method="POST">
          @csrf
          <div class="form-group mb-2">
            <label for="contentInput" class="form-label">Notification Content</label>
            <input type="text" name="content" id="contentInput" class="form-control"
                   value="{{ $notification->getContent() }}">
          </div>

          <button class="btn btn-primary">Update</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </form>
      </div>
    </div>
  </div>
@endsection