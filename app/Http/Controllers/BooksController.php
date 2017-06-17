<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Book;
use App\Level;
use App\Categoury;
use App\Specialization;
use App\Subject;
use App\Rate;
use App\Download;
use File;
use Response;
use Mail;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('created_at', 'desc')->get();
        return view('backend.books.index', compact('books'));
    }

    public function indexTable()
    {
        $books = Book::orderBy('created_at', 'desc')->get();
        return view('backend.books.indextables', compact('books'));
    }

    public function deleteReGet()
    {
        $books = Book::where('status', 1)->orderBy('created_at', 'desc')->get();
        return view('backend.books.indextables', compact('books'));
    }

    public function showBooks(Request $request)
    {
      // find the book by id
      $bookInfo = Book::findOrFail($request->id);
      // return json object
      return Response::json($bookInfo);
    }

    public function create()
    {
        $cats = Categoury::all();
        $levels = Level::all();
        $specializations = Specialization::all();
        return view('backend.books.add', compact('cats', 'levels', 'specializations'));
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
            'version'               => 'required',
            'book_code'               => 'required|max:4',
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
        $book->book_code           = $request['book_code'];
        $book->description       = $request['description'];
        $book->cat_id            = $request['cat_id'];
        $book->level_id          = $request['level_id'];
        $book->specialization_id = $request['specialization_id'];
        $book->subject_id        = $request['subject_id'];
        $book->month             = date('m');
        $book->year              = date('Y');
        $bookMail = $book->save();
        if ($bookMail) {
           /*
               NOTE Next Line Is Very Important To Increase The Request Connection In The PHP.ini With Out Edit The File It Self
               NOTE This Will Help To Edit The Next Value In Any Php.ini For This Function Only
               NOTE This Will Not Make Change In Others Functions
           */
            ini_set('max_execution_time', 300);
           /* NOTE Don't Remove Or Edit Any Thing From previous Line */
           $cats = Categoury::all();

           $levels = Level::all();

           $specializations = Specialization::all();

           $users = User::where(function ($q) use($book) {
              $q->where('level_id', $book->level_id);
              $q->where('specialization_id', $book->specialization_id);
           })->get();
           foreach ($users as $user) {
              Mail::send('auth.emails.newBook',
               ['book' => $book, 'cats' => $cats, 'levels' => $levels, 'specializations' => $specializations],
               function ($msg) use($user, $book){
                 $msg->from('csislms6october@gmail.com', getSetting());
                 $msg->to($user->email, $user->name);
                 $msg->subject('New Book Added ' . $user->name);
              });
           }

        }

        return redirect()->back()->with(['message' => 'The Book Added Successfully']);

    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $cats = Categoury::all();
        $levels = Level::all();
        $specializations = Specialization::all();
        $subjects = Subject::all();
        return view('backend.books.edit', compact('book', 'cats', 'levels', 'specializations', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'                 => 'required',
            'author'                => 'required',
            'image'                 => 'image|mimes:jpg,png,jpeg|max:5000',
            'file'                  => 'mimes:pdf|max:10240',
            'version'               => 'required|numeric',
            'book_code'             => 'required|max:4',
            'description'           => 'required|min:100',
            'cat_id'                => 'required|numeric',
            'level_id'              => 'required|numeric',
            'specialization_id'     => 'required|numeric',
            'subject_id'            => 'required|numeric',
        ]);

        $book = Book::findOrFail($id);
        $book->title             = $request['title'];
        $book->author            = $request['author'];
        if (!empty($request['image'])) {
            unlink(public_path($book->image));
            $book->image         = $this->uploadImage($request['image']);
        }
        if (!empty($request['file'])) {
            unlink(public_path($book->file));
            $book->file          = $this->uploadBook($request['file']);
        }
        if (!empty($request['sample'])) {
            unlink(public_path($book->sample));
            $book->sample          = $this->uploadBook($request['sample'], true);
        }
        $book->version           = $request['version'];
        $book->book_code         = $request['book_code'];
        $book->description       = $request['description'];
        $book->cat_id            = $request['cat_id'];
        $book->level_id          = $request['level_id'];
        $book->specialization_id = $request['specialization_id'];
        $book->subject_id = $request['subject_id'];
        $book->save();

        return redirect()->back()->with(['message' => 'The Book Updated Successfully']);

    }



    public function delete($id)
    {
        $book = Book::findOrFail($id);
        unlink(public_path($book->image));
        unlink(public_path($book->file));
        $book->delete();
        return redirect()->back()->with(['message' => 'The Book Deleted Successfully']);
    }

    public function singleShowBook(Request $request, $id)
    {
      $book = Book::findOrFail($id);
      $cats = Categoury::all();
      $levels = Level::all();
      $specializations = Specialization::all();
      $likeRate = Rate::where(function ($q) use($book) {
         $q->where('book_id', $book->id);
         $q->where('like', 1);
      })->count();

      $disLikeRate = Rate::where(function ($q) use($book) {
         $q->where('book_id', $book->id);
         $q->where('like', 0);
      })->count();
      return view('backend.books.single', compact('book', 'cats', 'levels', 'specializations', 'likeRate', 'disLikeRate'));
    }


   /*
   * return the books filltred by levels
   */
   public function getBooks(Request $request, Book $book)
   {
      $user = \Auth::user();
      $books = $book->orderBy('id', 'DESC')->paginate(9, ['*'], 'books');
      return view('frontend.items', compact('books'));
   }

   /*
   * return the single book
   */
   public function getSingleBook(Request $request, Book $book, $id)
   {
      $getBook = $book->findOrFail($id);
      $cats = Categoury::all();
      $levels = Level::all();
      $specializations = Specialization::all();
      $likeRate = Rate::where(function ($q) use($getBook) {
         $q->where('book_id', $getBook->id);
         $q->where('like', 1);
      })->count();

      $disLikeRate = Rate::where(function ($q) use($getBook) {
         $q->where('book_id', $getBook->id);
         $q->where('like', 0);
      })->count();

      if (count($getBook) > 0) {
         return view('frontend.single', compact('getBook', 'cats', 'levels', 'specializations', 'likeRate', 'disLikeRate'));
      }
   }

   public function likeBook(Request $request, Book $book)
   {
      $bookId = $request->bookId;

      $isLike = $request->isLike === 'true';

      $update = false;

      $book = $book->findOrFail($bookId);

      if(!$book){
         return null;
      }

      $user = \Auth::user();
      $like = $user->rates()->where('book_id', $bookId)->first();

      if($like) {

         $alreadyLike = $like->like;
         $update = true;

         if($alreadyLike == $isLike){
            $like->delete();
            return null;
         }

      } else{
         $like = new Rate();
      }
      $like->like = $isLike;
      $like->user_id = $user->id;
      $like->book_id = $book->id;

      if($update) {
         $like->update();
      } else {
         $like->save();
      }

      $likeRate = Rate::where(function ($q) use($book) {
         $q->where('book_id', $book->id);
         $q->where('like', 1);
      })->count();

      $disLikeRate = Rate::where(function ($q) use($book) {
         $q->where('book_id', $book->id);
         $q->where('like', 0);
      })->count();

      return Response::json(['like' => $likeRate, 'dislike' => $disLikeRate]);
   }

   /*
   * return the books filltred by category
   */
   public function filterCategoury(Request $request, Book $book, Categoury $cat, $cat_id)
   {
      $user = \Auth::user();
      $category = $cat->findOrFail($cat_id);
      if (count($category) > 0) {
         $books = $book->where(function ($q) use($user, $cat_id) {
            $q->where('level_id', '<=', $user->level_id);
            $q->where('specialization_id', $user->specialization_id);
            $q->where('cat_id', $cat_id);
        })->orderBy('id', 'DESC')->paginate(9, ['*'], 'books');
         return view('frontend.items', compact('books'));
      }
   }

   public function filterLevel(Request $request, $id)
   {
       $books = Book::where('level_id', $id)->orderBy('id', 'DESC')->paginate(9, ['*'], 'books');
       return view('frontend.items', compact('books'));
   }

   /*
   * return the books filltred by category
   * NOTE This query will return the data if the 'specialization_id' == $user->specialization_id only.
   */
   // public function filterSpecialization(Request $request, Book $book, Specialization $Specializations, $Specialization_id)
   // {
   //    $user = \Auth::user();
   //    $Specialization = $Specializations->findOrFail($Specialization_id);
   //    if (count($Specialization) > 0) {
   //       $books = $book->where(function ($q) use($user, $Specialization_id) {
   //          $q->where('level_id', '<=', $user->level_id);
   //          $q->where('specialization_id', $user->specialization_id);
   //          $q->where('Specialization_id', $Specialization_id);
   //       })->orderBy('id', 'DESC')->paginate(10, ['*'], 'books');
   //       return view('frontend.items', compact('books'));
   //    }
   // }

   public function search(Request $request, Book $book)
   {
      $user = \Auth::user();
      // validate the data
      $this->validate($request, [
         'searchBy' => 'required|numeric',
         'search' => 'required',
      ]);
      $books = $book->where(function ($q) use($user, $request) {
         if ($request->searchBy == 1) {
            $q->where('title', 'LIKE', "%$request->search%");
         } elseif ($request->searchBy == 2) {
            $q->where('author', 'LIKE', "%$request->search%");
         } elseif ($request->searchBy == 3) {
            $q->where('book_code', 'LIKE', "%$request->search%");
         }
     })->orderBy('id', 'DESC')->paginate(9, ['*'], 'books');
      return view('frontend.items', compact('books'));
   }

   public function subjectAjax(Request $request)
   {
      $subjectOption = '';

      $level            = Level::findOrFail($request->idOne)->id;
      $specialization   = Specialization::findOrFail($request->idTwo)->id;
      $subjects         = Subject::where(function ($q) use($level, $specialization) {
                             $q->where('level_id', $level);
                             $q->where('specialization_id', $specialization);
                          })->get();
      $subjectOption .= "<option value='' disabled selected>Choose your option</option>";
      foreach ($subjects as $subject) {
         $subjectOption .= "<option value='". $subject->id ."'>". $subject->name ."</option>";
      }

      return Response::json(['result' => $subjectOption]);
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

    public function DBook(Request $request)
    {
        $download = new Download();
        $download->user_id = $request['userid'];
        $download->book_id = $request['bookid'];
        $download->save();
    }


}
