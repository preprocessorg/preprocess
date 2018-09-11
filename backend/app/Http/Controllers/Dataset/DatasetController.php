<?php

namespace App\Http\Controllers\Dataset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Auth;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


use App\Dataset;

class DatasetController extends Controller
{
    //
    public function index()
    {
        $user = Auth::guard('api')->user();
        #$datasets = Dataset::all();
        $datasets = Dataset::where('user_id', $user->id)->paginate(5);
        return response()->json($datasets);
    }

    public function store(Request $request)
    {
        /*$messages = [
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute repetido.',
            'max' => 'maximo'
        ];*/

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:datasets',
            'file' => 'required|max:20480',
            'user_id' => 'required',
            'delimiter' => 'required'
        ]/*,$messages*/);

        if ($validator->fails())
        {
            return response()->json(['field' => $validator->errors()->keys(),'message' => $validator->errors(),], 400);
        }
        $extension = $request->file('file')->getClientOriginalExtension();
        $filename = uniqid().'.'.$extension;
        $path = $request->file('file')->storeAs(
            'public', $filename
        );

        $datasets = new Dataset([
            'name' => $request->name,
            'file' => $path,
            'delimiter' => $request->delimiter,
            'user_id' => $request->user_id
        ]);

        $datasets->save();
        return response()->json([
            'message' => 'Successfully created dataset!'
        ], 201);
    }
}
