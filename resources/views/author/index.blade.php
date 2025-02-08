@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Authors List</h2>
    <a href="{{url('books/create')}}" class="btn btn-primary mb-4">Add Book</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Birthday</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($authors["items"]) && count($authors["items"]) > 0)
            @foreach ($authors["items"] as $author)
                <tr>
                    <td>{{ $author["id"] ?? '' }}</td>
                    <td>{{ $author["first_name"].' '.$author["last_name"] }}</td>
                    <td>{{ $author["gender"] }}</td>
                    <td>{{ $author["birthday"] }}</td>
                    <td><a href="{{url('authors/'.$author["id"])}}" class="btn btn-primary">View Authors</a></td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
