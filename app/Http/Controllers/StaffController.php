<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Book;
use App\Level;
use App\User;
use App\Categoury;
use App\Specialization;
use File;
use Response;

class StaffController extends Controller
{
    public function index()
    {
        $books = Book::where('status', 0)->orderBy('id', 'DESC')->get();
        return view('backend.staffdashboard.index', compact('books'));
    }
   /**
   * NOTE This Function For The Admin Uses
   */
    public function staffPreview()
    {
        $staff = User::where('type', 2)->get();
        return view('backend.users.staff', compact('staff'));
    }


    public function create()
    {
        $cats = Categoury::all();
        $levels = Level::all();
        $specializations = Specialization::all();
        return view('backend.staffdashboard.add', compact('cats', 'levels', 'specializations'));
    }

    public function store(Request $request)
    {
      // `title`, `author`, `image`, `file`, `version`, `description`, `cat_id`, `level_id`, `specialization_id`
      $this->validate($request, [
          'title'                 => 'required',
          'author'                => 'required',
          'image'                 => 'required|image|mimes:jpg,png,jpeg|max:5000',
          'file'                  => 'required|mimes:pdf|max:10240',
          'sample'                => 'required|mimes:pdf|max:10240',
          'version'               => 'required|numeric',
          'description'           => 'required|min:100',
          'cat_id'                => 'required|numeric',
          'level_id'              => 'required|numeric',
          'specialization_id'     => 'required|numeric',
          'subject_id'            => 'required|numeric',
      ]);
      $book = new Book();
      $book->title             = $request['title'];
      $book->author            = $request['author'];
      $book->image             = $this->uploadImage($request['image']);
      $book->file              = $this->uploadBook($request['file']);
      $book->sample            = $this->uploadBook($request['sample'], true);
      $book->version           = $request['version'];
      $book->description       = $request['description'];
      $book->cat_id            = $request['cat_id'];
      $book->level_id          = $request['level_id'];
      $book->specialization_id = $request['specialization_id'];
      $book->subject_id        = $request['subject_id'];
      $book->month             = date('m');
      $book->year              = date('Y');
      $book->save();

      return redirect()->back()->with(['message' => 'The Book Added Successfully']);

    }

    public function uploadImage($file){
        $extension = $file->getClientOriginalExtension();
        $sha1 = sha1($file->getClientOriginalName());
        $filename = date('Y-m-d-h-i-s')."_".$sha1.".".$extension;
        $path = public_path('backend/images');
        $file->move($path, $filename);
        return 'backend/images/'.$filename;
    }
    public function uploadBook($file, $sample = false){
        $extension = $file->getClientOriginalExtension();
        $sha1 = sha1($file->getClientOriginalName());
        if ($sample == true) {
           $filename = date('Y-m-d-h-i-s')."_".$sha1."_sample.".$extension;
        } else {
           $filename = date('Y-m-d-h-i-s')."_".$sha1.".".$extension;
        }
        $path = public_path('backend/books');
        $file->move($path, $filename);
        return 'backend/books/'.$filename;
    }


    public function confirm($id)
    {
        $staff_id = decryptData($id);
        $user = User::findOrfail($staff_id);
        $levels = Level::all();
        $specializations = Specialization::all();
        return view('backend.staffdashboard.updatedata', compact('user', 'levels', 'specializations'));
    }

    public function uploadImageStaff($file){
        $extension = $file->getClientOriginalExtension();
        $sha1 = sha1($file->getClientOriginalName());
        $filename = date('Y-m-d-h-i-s')."_".$sha1.".".$extension;
        $path = public_path('backend/staff_img');
        $file->move($path, $filename);
        return 'backend/staff_img/'.$filename;
    }

    public function confirmpost(Request $request, $id)
    {
        $sid = decryptData($id);
        $this->validate($request, [
            'name'              => 'required',
            'email'             => 'required|email|unique:users,email,'.$sid,
            'student_id'        => 'required|min:8|unique:users,student_id,'.$sid,
            'password'          => 'confirmed|min:6',
            'address'           => 'required',
            'phonenumber'       => 'required|numeric',
            'level_id'          => 'required|numeric',
            'specialization_id' => 'required|numeric',
            'staff_image'       => 'required|image|mimes:jpg,png,jpeg|max:5000',
        ]);

        $user = User::find($sid);
        $user->name             = $request['name'];
        $user->email            = $request['email'];
        $user->student_id       = $request['student_id'];

        if (!empty($request['password'])) {
            $user->password         = bcrypt($request['password']);
        }
        if (!empty($request['staff_image'])) {
            $user->staff_image         = $this->uploadImageStaff($request['staff_image']);
        }else {
            $user->staff_image         = 'backend/staff_img/avatar.jpg';
        }
        $user->address          = $request['address'];
        $user->phonenumber      = $request['phonenumber'];
        $user->level_id         = $request['level_id'];
        $user->specialization_id= $request['specialization_id'];
        $user->save();
        return redirect('/')->with(['message' => 'Your Data Has Been Updated Successfully']);
    }


    public function viewPDF($id)
    {
        $book = Book::findOrFail($id);
        $file = public_path($book->file);

        // to view the file
        if (File::isFile($file)) {
            $file = File::get($file);
            $response = Response::make($file, 200);
            // using this will allow you to do some checks on it (if pdf/docx/doc/xls/xlsx)
            $response->header('Content-Type', 'application/pdf');

            return $response;
        }
        // Some content types
        // $content_types = [
        //     'application/octet-stream', // txt etc
        //     'application/msword', // doc
        //     'application/vnd.openxmlformats-officedocument.wordprocessingml.document', //docx
        //     'application/vnd.ms-excel', // xls
        //     'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // xlsx
        //     'application/pdf', // pdf
        // ];
    }



       public function downloadPDF($id)
       {
           $book = Book::findOrFail($id);
           $file = public_path($book->sample);


           if (File::isFile($file)){
               $fileDown = Response::download($file, $book->title . '.pdf');
               return $fileDown;
           }

       }


    public function deleteRe($id)
    {
        $book = Book::findOrFail($id);
        $book->status = 1;
        $book->save();
        return redirect()->back()->with(['message' => 'Your Delete Re Updated Successfully']);
    }

    public function viewStaff()
    {
       $staffs = User::where('type', 2)->get();
       return view('frontend.doctors', compact('staffs'));
    }

    public function register()
    {
        $level = Level::all();
        $specialization = Specialization::all();
        return view('frontend.staffregister', compact('level', 'specialization'));
    }
    public function postregister(Request $request)
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
        $user->adminrequest     = 2;
        if (!empty($request['staff_image'])) {
            $user->staff_image         = $this->uploadImageStaff($request['staff_image']);
        }else {
            $user->staff_image         = 'backend/staff_img/avatar.jpg';
        }
        $user->save();

        $message = 'Your Request Has Been Sent Successfully';

        return redirect()->back()->with(['message' => $message]);
    }

}
