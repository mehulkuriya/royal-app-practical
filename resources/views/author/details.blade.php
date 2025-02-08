@extends('layouts.app')
@section('content')
<div class="container">
    <x-alert-message type="success" :message="session('success')" />
    <x-alert-message type="danger" :message="session('error')" />
    <h2>Author Details</h2>
    <a href="{{url('authors')}}" class="btn btn-primary">Back</a>
    <a href="{{url('books/create')}}" class="btn btn-primary ml-4">Add Book</a>
    <div class="card mt-4">
        <div class="card-body">
            <p><strong>Name : </strong> {{$authors["first_name"].' '.$authors["last_name"] ?? ''}} </p>
            <p><strong>gender: </strong>{{$authors["gender"] ?? ''}}</p>
            <p><strong>Birthday : </strong>{{$authors["birthday"] ?? ''}} </p>
            <p><strong>BirthPlace : </strong>{{$authors["place_of_birth"] ?? ''}} </p>
        </div>
        
    </div>

    @if(count($authors["books"]) > 0)
    <div class="mt-4">    
        <h2>Book Details</h2>
        
        <div class="card">
            @foreach($authors["books"] as $value)
            <div class="card-body">
                <p><strong>ID :</strong> {{$value["id"]}}</p>
                <p><strong>title :</strong>  {{$value["title"]}}</p>
                <p><strong>format :</strong> {{$value["format"]}}</p>
                <p><strong>Number Of Pages:</strong> {{$value["number_of_pages"]}}</p>
                <p>  <a href="javascript:void(0);" data-url="{{ url('books/delete/'.$value["id"]) }}" class="btn btn-danger delete-book">
                    Delete Book
                </a><p>
            </div>
            @endforeach
           
        </div>
    </div>
    @endif
</div>
<x-sweet-alert-confirm />
@endsection
