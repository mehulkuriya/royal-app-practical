<?php

namespace App\Services;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Http;

class RoyalAppApi
{
    protected $client;
    protected $baseUrl;
    protected $accessToken;

    public function __construct()
    {
        $this->baseUrl = config('services.royalapps.base_url');
    }

    /**
     * Authenticate and get access token
     */
    public function getAccessToken($request)
    {
        return $this->request('POST', 'token', $request);
    }

    public function request($method, $endpoint, $params = [])
    {
        try {
            $this->accessToken = session('token_key');
            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])
                ->{$method}($this->baseUrl . $endpoint, $params);

            return $response->json();
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Get list of authors
     */
    public function getAuthors()
    {
        return $this->request('GET', 'authors');
    }

    /**
     * Get list of books
     */
    public function getBooks()
    {
        return $this->request('GET', 'books');
    }

    /**
     * Add a new book
     */
    public function addBook($bookData)
    {
        return $this->request('POST', 'books', $bookData);
    }

    /**
     * Delete a book
     */
    public function deleteBook($bookId)
    {
        return $this->request('DELETE', "books/{$bookId}");
    }

    public function getAuthorDetails($authorId)
    {
        return $this->request('GET', "authors/{$authorId}");
    }
}
