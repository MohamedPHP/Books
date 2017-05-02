<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Level;

class LevelsController extends Controller
{
    public function index()
    {
        $levels = Level::all();
        return view('backend.levels.index', compact('levels'));
    }

    public function create()
    {
        return view('backend.levels.add');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'number' => 'required|numeric|unique:levels',
        ]);
        $level = new Level();
        $level->number = $request['number'];
        $level->save();

        return redirect()->back()->with(['message' => 'The Level Added Successfully']);

    }
    public function delete($id)
    {
        $level = Level::find($id);
        $level->delete();
        return redirect()->back()->with(['message' => 'The Level Deleted Successfully']);
    }
}
