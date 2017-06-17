<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Code;

class CodesController extends Controller
{
    public function index()
    {
        $codes = Code::all();
        return view('backend.codes.index', compact('codes'));
    }

    public function create()
    {
        return view('backend.codes.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:codes',
            'student_id' => 'required|unique:codes',
        ]);
        $code = new Code();
        $code->code       = $request['code'];
        $code->student_id = $request['student_id'];
        $code->save();

        return redirect()->back()->with(['message' => 'The Code Added Successfully']);

    }

    public function edit($id)
    {
        $code = Code::find($id);
        return view('backend.codes.edit', compact('code'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required|unique:codes,code,'.$id,
            'student_id' => 'required|unique:codes,student_id,'.$id,
        ]);

        $code = Code::find($id);
        $code->code       = $request['code'];
        $code->student_id = $request['student_id'];
        $code->save();
        
        return redirect()->back()->with(['message' => 'The Code Updated Successfully']);
    }

    public function delete($id)
    {
        $code = Code::find($id);
        $code->delete();
        return redirect()->back()->with(['message' => 'The Code Deleted Successfully']);
    }
}
