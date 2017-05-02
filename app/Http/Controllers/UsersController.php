<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Level;
use App\Rate;
use App\Book;
use App\Specialization;
use App\Download;
use Auth;
use Mail;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', 1)->where('adminrequest', 0)->orderBy('created_at', 'desc')->get();
        return view('backend.users.index', compact('users'));
    }

    public function adminRequests()
    {
        $users = User::where('id', '!=', 1)->where('adminrequest' , 1)->orderBy('created_at', 'desc')->get();
        return view('backend.users.adminrequests', compact('users'));
    }

    public function adminRequestsApprove($id)
    {
        $user = User::findOrFail($id);
        $user->type = 3;
        $user->adminrequest = 0;
        $user->save();

        return redirect()->back()->with(['message' => 'The Request Approved Successfully']);
    }

    public function create()
    {
        $levels = Level::all();
        $specializations = Specialization::all();
        return view('backend.users.add', compact('levels', 'specializations'));
    }

    public function store(Request $request)
    {
        // {{-- `name`, `email`, `password`, `address`, `phonenumber`, `type`, `level_id`, `specialization_id` --}}
        $this->validate($request, [
            'name'              => 'required',
            'email'             => 'required|email|unique:users',
            'student_id'        => 'required|min:8|unique:users',
            'password'          => 'required|confirmed|min:6',
            'address'           => 'required',
            'phonenumber'       => 'required|numeric',
            'type'              => 'required|numeric',
            'level_id'          => 'required|numeric',
            'specialization_id' => 'required|numeric',
        ]);

        $user = new User();
        $user->name             = $request['name'];
        $user->email            = $request['email'];
        $user->student_id       = $request['student_id'];
        $user->password         = bcrypt($request['password']);
        $user->address          = $request['address'];
        $user->phonenumber      = $request['phonenumber'];
        $user->type             = $request['type'];
        $user->level_id         = $request['level_id'];
        $user->specialization_id= $request['specialization_id'];
        $user->save();
        $message = 'The User Added Successfully';
        if ($user->type == 2) {
            $message = 'The Staff Added Successfully And We Sent Email Address To His Mail To Confirm His Data';
            Mail::send('auth.emails.staff', ['id' => $user->id], function ($msg) use($user){
                $msg->from('csislms6october@gmail.com', getSetting());
                $msg->to($user->email, $user->name);
                $msg->subject('Please Go To pur Web Site And Confirm Your Data As Staff ' . $user->name);
            });
        }
        return redirect()->back()->with(['message' => $message]);

    }


    public function edit($id)
    {
        $user = User::find($id);
        $levels = Level::all();
        $specializations = Specialization::all();
        return view('backend.users.edit', compact('user', 'levels', 'specializations'));
    }

    public function update(Request $request, $id)
    {
        // 'name' => 'required|unique:categouries,name,'.$id,
        $this->validate($request, [
            'name'              => 'required',
            'email'             => 'required|email|unique:users,email,'.$id,
            'student_id'        => 'required|min:8|unique:users,student_id,'.$id,
            'password'          => 'confirmed|min:6',
            'address'           => 'required',
            'phonenumber'       => 'required|numeric',
            'type'              => 'required|numeric',
            'level_id'          => 'required|numeric',
            'specialization_id' => 'required|numeric',
        ]);

        $user = User::findOrFail($id);
        $user->name             = $request['name'];
        $user->email            = $request['email'];
        $user->student_id       = $request['student_id'];
        if (!empty($request['password'])) {
            $user->password         = bcrypt($request['password']);
        }
        $user->address          = $request['address'];
        $user->phonenumber      = $request['phonenumber'];
        $user->type             = $request['type'];
        $user->level_id         = $request['level_id'];
        $user->specialization_id= $request['specialization_id'];
        /*NOTE For Stuff Bio*/
        if (!empty($request['bio'])) {
           $user->bio        = $request['bio'];
        }
        /*NOTE For Stuff Bio*/

        $user->save();
        return redirect()->back()->with(['message' => 'The User Updated Successfully']);
    }



    public function delete($id)
    {
        if ($id == 1) {
            return redirect()->back()->with(['message' => 'Couldn\'t Delete This User']);
        }
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with(['message' => 'The User Deleted Successfully']);
    }


    public function profile()
    {
        $user = User::findOrfail(Auth::user()->id);
        $rates = Rate::where('user_id', $user->id)->where('like', 1)->get();
        $downloads = Download::where('user_id', $user->id)->get();
        $books = [];
        foreach ($rates as $rate) {
            $books[] = Book::where('id', $rate->book_id)->first();
        }
        $dbooks = [];
        foreach ($downloads as $book) {
            $dbooks[] = Book::where('id', $book->book_id)->first();
        }

        return view('frontend.profile', compact('user', 'books', 'dbooks'));
    }

    public function proUpdate(Request $request, $id)
    {
        // 'name' => 'required|unique:categouries,name,'.$id,
        $this->validate($request, [
            'name'              => 'required',
            'email'             => 'required|email|unique:users,email,'.$id,
            'password'          => 'confirmed|min:6',
            'address'           => 'required',
            'phonenumber'       => 'required|numeric',
        ]);

        $user = User::findOrfail($id);
        $user->name             = $request['name'];
        $user->email            = $request['email'];
        if (!empty($request['password'])) {
            $user->password         = bcrypt($request['password']);
        }
        $user->address          = $request['address'];
        $user->phonenumber      = $request['phonenumber'];
        /*NOTE For Stuff Bio*/
        if (!empty($request['bio'])) {
           $user->bio        = $request['bio'];
        }
        /*NOTE For Stuff Bio*/

        $user->save();

        return redirect()->back()->with(['message' => 'The Profile Data Updated Successfully']);
    }


    public function adminregistration()
    {
        return view('frontend.adminregister');
    }


    public function adminregistrationPost(Request $request)
    {
        // {{-- `name`, `email`, `password`, `address`, `phonenumber`, `type`, `level_id`, `specialization_id` --}}
        $this->validate($request, [
            'name'              => 'required',
            'email'             => 'required|email|unique:users',
            'student_id'        => 'required|min:8|unique:users',
            'password'          => 'required|confirmed|min:6',
            'address'           => 'required',
            'phonenumber'       => 'required|numeric',
        ]);
        $user = new User();
        $user->name             = $request['name'];
        $user->email            = $request['email'];
        $user->student_id       = $request['student_id'];
        $user->password         = bcrypt($request['password']);
        $user->address          = $request['address'];
        $user->phonenumber      = $request['phonenumber'];
        $user->type             = 1;
        $user->level_id         = 4;
        $user->specialization_id= 1;
        $user->adminrequest     = 1;
        $user->save();
        $message = 'Your Request Has Been Sent Successfully';

        return redirect()->back()->with(['message' => $message]);
    }


}
