<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceRequestController extends Controller
{
    public function index()
    {
        $requests = Auth::user()->serviceRequests()->latest()->paginate(15);
        return view('requests.index', ['requests' => $requests]);
    }

    public function create()
    {
        return view('requests.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'attachment' => ['nullable', 'file', 'max:8192'],
        ]);

        $req = new ServiceRequest();
        $req->user_id = Auth::id();
        $req->subject = $data['subject'];
        $req->message = $data['message'];

        if ($request->hasFile('attachment')) {
            $req->attachment_path = $request->file('attachment')->store('request_attachments', 'public');
        }

        $req->save();

        return redirect()->route('requests.index')->with('status', 'Request submitted!');
    }
}
