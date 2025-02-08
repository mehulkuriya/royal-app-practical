@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Add a New Book</h2>

    <x-alert-message type="success" :message="session('success')" />
    <x-alert-message type="danger" :message="session('error')" />

    <div class="card">
        <div class="card-body">
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="title" class="form-label">Book Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Author <span class="text-danger">*</span></label>
                    <select name="book_author" class="form-control @error('book_author') is-invalid @enderror">
                        <option value=""> Select Author</option>
                        @foreach ($authorsArr as $key => $value )
                            <option value="{{$key}}"> {{$value}}</option>
                        @endforeach
                    </select>
                    @error('book_author') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description </label>
                    <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">ISBN <span class="text-danger">*</span></label>
                    <input type="text" name="isbn" id="isbn" class="form-control @error('price') is-invalid @enderror" value="{{ old('isbn') }}" required>
                    @error('isbn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="format" class="form-label">Format <span class="text-danger">*</span></label>
                    <input type="text"  name="format" id="format" class="form-control @error('format') is-invalid @enderror" value="{{ old('format') }}" required>
                    @error('format') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="number_of_pages" class="form-label">Number Of Pages <span class="text-danger">*</span></label>
                    <input type="number"  name="number_of_pages" id="number_of_pages" class="form-control @error('number_of_pages') is-invalid @enderror" value="{{ old('number_of_pages') }}" required>
                    @error('number_of_pages') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary">Add Book</button>
            </form>
        </div>
    </div>
</div>
@endsection
