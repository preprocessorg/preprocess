<?php

namespace App\Http\Controllers\Dataset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Dataset;

class DatasetController extends Controller
{
    //
    public function index()
    {
        $datasets = Dataset::all();
        return response()->json($datasets);
    }

    public function store(Request $request)
    {
        $datasets = new Dataset([
            'name' => $request->name,
            'file' => $request->file,
            'type' => $request->type
        ]);

        $datasets->save();
        return response()->json([
            'message' => 'Successfully created dataset!'
        ], 201);
    }
}
