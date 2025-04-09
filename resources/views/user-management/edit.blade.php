@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>
    <form action="{{ route('user.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Nama -->
    <input type="text" name="name" value="{{ $user->name }}">

    <!-- Email -->
    <input type="email" name="email" value="{{ $user->email }}">

    <!-- Role -->
    <select name="role">
        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
    </select>

    <button type="submit">Update</button>
</form>

</div>
@endsection