<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        // Query all movies from the database
        $movies = Movie::all();

        // Prepare the response data
        $response = [
            'message' => 'Movies successfully retrieved.',
            'movies' => $movies,
        ];

        // Return the data as JSON
        return response()->json($response);
    }

    public function store(Request $request)
    {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'poster' => 'required|image|mimes:jpeg,png|max:2048', // Adjust allowed image types and max size
        ]);

        if ($validator->fails()) {
            // Return validation error messages
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Save the uploaded poster image to the filesystem
        $poster = $request->file('poster');
        $posterPath = 'posters/' . $poster->hashName();
        Storage::put($posterPath, file_get_contents($poster));

        // Save movie information to the movies table
        $movie = Movie::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'poster' => $posterPath,
        ]);

        $response = [
            'message' => 'Movie created successfully',
            'movie' => [
                'title' => $movie->title,
                'description' => $movie->description,
                'poster' => $movie->poster,
                'updated_at' => $movie->updated_at,
                'created_at' => $movie->created_at,
                'id' => $movie->id,
            ],
        ];

        // Return the data as JSON
        return response()->json($response);
    }
}