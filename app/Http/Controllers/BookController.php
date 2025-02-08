<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Services\RoyalAppApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class BookController extends Controller
{
    protected $royalAppApiService;

    public function __construct(RoyalAppApi $royalAppApiService)
    {
        $this->royalAppApiService = $royalAppApiService;
    }

    public function deleteBook($bookId)
    {
        try {
            $this->royalAppApiService->deleteBook($bookId);
            return redirect()->back()->with('success', 'Book deleted successfully.');
        } catch (Exception $e) {
            Log::error("Error deleting book (ID: $bookId): " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete the book. Please try again.');
        }
    }

    public function create()
    {
        $authors = $this->royalAppApiService->getAuthors();
        $authorsArr = $this->getAuthorsArray($authors);
        return view('author.books.create', compact('authorsArr'));
    }

    public function store(StoreBookRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['author']['id'] = $validatedData['book_author'];
            $validatedData['number_of_pages'] = (int) $validatedData['number_of_pages'];
            $authors = $this->royalAppApiService->addBook($validatedData);
            return redirect(url('authors/' . $validatedData['book_author']))
                ->with('success', 'Book added successfully!');
        } catch (Exception $e) {
            Log::error('Error adding book: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    private function getAuthorsArray($authors)
    {
        $authorArr = [];
        if (isset($authors['items']) && count($authors['items']) > 0) {
            foreach ($authors['items'] as $value) {
                $authorArr[$value['id']] = $value['first_name'] . ' ' . $value['last_name'];
            }
        }

        return $authorArr;
    }
}
