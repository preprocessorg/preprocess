<?php

namespace App\Http\Controllers\Dataset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
        $extension = $request->file('file')->getClientOriginalExtension();
        $filename = uniqid().'.'.$extension;
        $path = $request->file('file')->storeAs(
            'public', $filename
        );
        #$path = $request->file('file')->store('public');
        #$path = 'teste1';

        $datasets = new Dataset([
            'name' => $request->name,
            'file' => $path
        ]);

        $datasets->save();
        return response()->json([
            'message' => 'Successfully created dataset!'
        ], 201);
    }
}
