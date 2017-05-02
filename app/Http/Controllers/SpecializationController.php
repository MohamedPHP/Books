<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Specialization;

class SpecializationController extends Controller
{
    public function index()
    {
        $specializations = Specialization::all();
        return view('backend.specializations.index', compact('specializations'));
    }

    public function create()
    {
        return view('backend.specializations.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:specializations',
        ]);
        $specialization = new Specialization();
        $specialization->name = $request['name'];
        $specialization->save();

        return redirect()->back()->with(['message' => 'The specialization Added Successfully']);

    }

    public function edit($id)
    {
        $specialization = Specialization::find($id);
        return view('backend.specializations.edit', compact('specialization'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:specializations,name,'.$id,
        ]);
        $specialization = Specialization::find($id);
        $specialization->name = $request->name;
        $specialization->save();
        return redirect()->back()->with(['message' => 'The Specialization '."'$specialization->name'".' Updated Successfully']);
    }

    public function delete($id)
    {
        $specialization = Specialization::find($id);
        $specialization->delete();
        return redirect()->back()->with(['message' => 'The Specialization Deleted Successfully']);
    }
}
