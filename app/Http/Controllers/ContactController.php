<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\Contact\PublishContact;
use App\Http\Requests\ContactCreateRequest;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store(ContactCreateRequest $request)
    {
        try {
            PublishContact::dispatch($request->all());

            return redirect()->route('contact.create');

        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    private function handleException(\Exception $e): RedirectResponse
    {
        \Log::error('Error occurred while processing contact form data: ' . $e->getMessage());

        return redirect()->back()->with('error', 'An error occurred while processing your request. Please try again later.');
    }
}
