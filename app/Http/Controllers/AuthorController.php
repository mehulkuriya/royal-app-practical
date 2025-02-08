<?php

namespace App\Http\Controllers;

use App\Services\RoyalAppApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthorController extends Controller
{
    protected $royalAppApiService;

    public function __construct(RoyalAppApi $royalAppApiService)
    {
        $this->royalAppApiService = $royalAppApiService;
    }

    public function index()
    {
        try {
            $authors = $this->royalAppApiService->getAuthors();
            return view('author.index', compact('authors'));
        } catch (Exception $e) {
            Log::error('Error fetching authors: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to fetch authors. Please try again.');
        }
    }

    public function show($id)
    {
        try {
            $authors = $this->royalAppApiService->getAuthorDetails($id);
            return view('author.details', compact('authors'));
        } catch (Exception $e) {
            Log::error("Error fetching author details (ID: $id): " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to fetch author details. Please try again.');
        }
    }
}
