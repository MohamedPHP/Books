<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Categoury;

class CatsController extends Controller
{
    public function index()
    {
        $cats = Categoury::all();
        return view('backend.cats.index', compact('cats'));
    }

    public function create()
    {
        return view('backend.cats.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categouries',
        ]);
        $cat = new Categoury();
        $cat->name = $request['name'];
        $cat->save();

        return redirect()->back()->with(['message' => 'The Categoury Added Successfully']);

    }

    public function edit($id)
    {
        $cat = Categoury::find($id);
        return view('backend.cats.edit', compact('cat'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:categouries,name,'.$id,
        ]);
        
        $cat = Categoury::find($id);
        $cat->name = $request->name;
        $cat->save();
        return redirect()->back()->with(['message' => 'The Categoury '."'$cat->name'".' Updated Successfully']);
    }

    public function delete($id)
    {
        $cat = Categoury::find($id);
        $cat->delete();
        return redirect()->back()->with(['message' => 'The Categoury Deleted Successfully']);
    }
}
