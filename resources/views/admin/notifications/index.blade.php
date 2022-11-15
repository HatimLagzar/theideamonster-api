@php
/** @var $notifications \App\Models\Notification[]|\Illuminate\Database\Eloquent\Collection */
@endphp
@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="row">
          <div class="col">
            <h3>Add Notification</h3>
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
              <td></td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection