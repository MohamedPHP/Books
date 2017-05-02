<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Contact;

class ContactController extends Controller
{
   public function index()
   {
      $contacts = Contact::orderBy('created_at', 'desc')->get();
      return view('backend.contact.index', compact('contacts'));
   }
    public function store(Request $request, Contact $contact)
    {
      // ''name', 'email', 'phone', 'message'
      $this->validate($request, [
          'name'           => 'required|max:10',
          'email'          => 'required|email',
          'phone'          => 'required|numeric',
          'message'        => 'required|max:500',
     ]);

      $data = [
         'name' => $request->name,
         'email' => $request->email,
         'phone' => $request->phone,
         'message' => $request->message,
      ];

      $contact->create($data);

      return redirect()->back()->with(['message' => 'The Message Send Successfully']);
    }

    public function destroy(Request $request, Contact $contact, $id)
    {
        $contactDelete = $contact->findOrFail($id);
        $contactDelete->delete();
        return redirect()->back()->with(['message' => 'The Message Deleted Successfully']);

    }
}
