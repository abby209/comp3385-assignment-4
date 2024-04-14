<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
    
        return response()->json([
            'message' => 'Movies retrieved successfully',
            'movies' => $movies
        ]);
    }
    
    public function store(Request $request)
    {
        // Validation rules
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assuming poster is an image
        ]);

        // Store poster image
        $posterPath = $request->file('poster')->store('posters');

        // Create movie record
        $movie = Movie::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'poster' => $posterPath,
        ]);

        return response()->json([
            'message' => 'Movie created successfully',
            'movie' => $movie
        ], 201);
    }
}