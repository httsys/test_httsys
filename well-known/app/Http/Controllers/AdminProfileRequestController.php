<?php

namespace App\Http\Controllers;

use App\Models\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProfileRequestController extends Controller
{
    public function index(Request $request)
    {
        $requests = ProfileUpdateRequest::with(['user', 'photo'])
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            }, function ($q) {
                $q->where('status', 'pending');
            })
            ->orderBy('id', 'desc')
            ->paginate(25)
            ->withQueryString();

        return view('users.profile-requests', compact('requests'));
    }

    public function approve(ProfileUpdateRequest $profileUpdateRequest)
    {
        if ($profileUpdateRequest->status !== 'pending') {
            return back()->with('profile_request_error', 'This request was already reviewed.');
        }

        $profileUpdateRequest->approve(Auth::user());

        return back()->with('profile_request_success', "The customer's requested changes have been applied.");
    }

    public function reject(ProfileUpdateRequest $profileUpdateRequest)
    {
        if ($profileUpdateRequest->status !== 'pending') {
            return back()->with('profile_request_error', 'This request was already reviewed.');
        }

        $profileUpdateRequest->reject(Auth::user());

        return back()->with('profile_request_success', "The request was rejected — the customer's existing details are unchanged.");
    }
}
