<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Subject;
use App\Book;
use App\Level;
use App\Specialization;


class SubjectsController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('backend.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $levels = Level::all();
        $specializations = Specialization::all();
        return view('backend.subjects.add', compact('levels', 'specializations'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'              => 'required|unique:subjects',
            'code'              => 'required|unique:subjects',
            'level_id'          => 'required|numeric',
            'specialization_id' => 'required|numeric',
        ]);

        $subject = new Subject();
        $subject->name             = $request['name'];
        $subject->code             = $request['code'];
        $subject->level_id         = $request['level_id'];
        $subject->specialization_id= $request['specialization_id'];
        $subject->save();

        return redirect()->back()->with(['message' => 'The Subject Added Successfully']);

    }


    public function edit($id)
    {
        $subject = Subject::find($id);
        $levels = Level::all();
        $specializations = Specialization::all();
        return view('backend.subjects.edit', compact('subject', 'levels', 'specializations'));
    }

    public function update(Request $request, $id)
    {
        // 'name' => 'required|unique:categouries,name,'.$id,
        $this->validate($request, [
            'name'              => 'required|unique:subjects,name,'.$id,
            'code'              => 'required|unique:subjects,code,'.$id,
            'level_id'          => 'required|numeric',
            'specialization_id' => 'required|numeric',
        ]);

        $subject = Subject::find($id);
        $subject->name             = $request['name'];
        $subject->code             = $request['code'];
        $subject->level_id         = $request['level_id'];
        $subject->specialization_id= $request['specialization_id'];
        $subject->save();

        return redirect()->back()->with(['message' => 'The Subject Updated Successfully']);

    }



    public function delete($id)
    {
        $subject = Subject::find($id);
        $subject->delete();
        return redirect()->back()->with(['message' => 'The Subject Deleted Successfully']);
    }



    public function getCources()
    {
        $subjects = Subject::all();
        return view('frontend.cources', compact('subjects'));
    }


    public function getCourceBooks($id)
    {
        $subject = Subject::find($id);
        if ($subject) {
            $books = Book::where('subject_id', $subject->id)->paginate(9);
            return view('frontend.items', compact('books'));
        }
        return redirect('/');
    }

    public function search(Request $request, Subject $subjects)
    {
       // validate the data
       $this->validate($request, [
          'searchBy' => 'required|numeric',
          'search' => 'required',
       ]);
       $subjects = $subjects->where(function ($q) use($request) {
          if ($request->searchBy == 1) {
             $q->where('name', 'LIKE', "%$request->search%");
          } elseif ($request->searchBy == 2) {
             $q->where('code', 'LIKE', "%$request->search%");
          }
      })->orderBy('id', 'DESC')->paginate(9, ['*'], 'subjects');
       return view('frontend.cources', compact('subjects'));
    }


}
