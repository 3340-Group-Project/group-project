<?php

// NOTE: Controller methods usually validate input, query models, then return a view/redirect.


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRequestController extends Controller
{
    // NOTE: index() handles this route/action.
    public function index()
    {
        $requests = ServiceRequest::query()->latest()->paginate(20);
        return view('admin.requests.index', compact('requests'));
    }

    // NOTE: show() handles this route/action.
    public function show(ServiceRequest $requestModel)
    {
        return view('admin.requests.show', ['request' => $requestModel]);
    }

    // NOTE: respond() handles this route/action.
    public function respond(Request $request, ServiceRequest $requestModel)
    {
        $data = $request->validate([
            'status' => ['required', 'in:open,in_progress,closed'],
            'admin_response' => ['nullable', 'string', 'max:5000'],
        ]);

        $requestModel->status = $data['status'];
        $requestModel->admin_response = $data['admin_response'] ?? null;
        $requestModel->responded_by = Auth::id();
        $requestModel->responded_at = now();
        $requestModel->save();

        return redirect()->route('admin.requests.show', $requestModel)->with('status', 'Response saved.');
    }
}