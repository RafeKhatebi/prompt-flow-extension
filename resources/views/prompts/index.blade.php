{{-- Here is the index view for prompts
@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Prompts</h1>
        <a href="{{ route('prompts.create') }}" class="btn btn-primary mb-3">Create New Prompt</a>
        @if ($prompts->isEmpty())
            <p>No prompts found.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prompts as $prompt)
                        <tr>
                            <td>{{ $prompt->name }}</td>
                            <td>{{ $prompt->description }}</td>
                            <td>
                                <a href="{{ route('prompts.show', $prompt) }}" class="btn btn-info">View</a>
                                <a href="{{ route('prompts.edit', $prompt) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('prompts.destroy', $prompt) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div> --}}
