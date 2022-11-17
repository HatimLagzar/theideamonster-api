@php
/** @var $notifications \App\Models\Notification[]|\Illuminate\Database\Eloquent\Collection */
@endphp
@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="row mb-3">
          <div class="col">
            <h3>List Notification</h3>
          </div>
          <div class="col">
            <a href="{{ route('notifications.create') }}" class="btn btn-primary float-end ms-auto">Create</a>
          </div>
        </div>
        <table class="table table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Content</th>
            <th># Times Sent</th>
            <th>Created At</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>
          @foreach($notifications as $key => $notification)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $notification->getContent() }}</td>
              <td>{{ $notification->getCreatedAt() }}</td>
              <td>{{ $notification->getTimesSent() }}</td>
              <td>
                <a class="btn btn-secondary btn-sm" href="{{ route('notifications.edit', ['notification' => $notification]) }}">Edit</a>
                <form method="POST" action="{{ route('notifications.push', ['notification' => $notification]) }}" class="d-inline-block">
                  @csrf
                  <button class="btn btn-warning btn-sm">Send</button>
                </form>
                <form method="POST" action="{{ route('notifications.delete', ['notification' => $notification]) }}" class="d-inline-block">
                  @method('DELETE')
                  @csrf
                  <button class="btn btn-danger btn-sm">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection