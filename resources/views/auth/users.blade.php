@extends('layouts.app')
@section('content')

<div class="container">
    <h2>Users Management</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Level</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->level }}</td>
                <td>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection