<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromptRequest;
use App\Http\Requests\UpdatePromptRequest;
use App\Models\Prompt;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromptController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Prompt::class, 'prompt');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Prompt $prompt, Request $request)
    {
        $prompts = $request->user()->prompts()->latest()->get();

        return view('prompts.index', compact('prompts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('prompts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePromptRequest $request)
    {
        $validated = $request->validated();
        Auth::user()->prompts()->create($validated);

        return redirect()->route('prompts.index')->with('success', 'Prompt created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prompt $prompt)
    {

        return view('prompts.show', compact('prompt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prompt $prompt)
    {
        return view('prompts.edit', compact('prompt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePromptRequest $request, Prompt $prompt)
    {
        $validated = $request->validated();
        $prompt->update($validated);

        return redirect()->route('prompts.index')->with('success', 'Prompt updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
        $prompt->save();
     */
    public function destroy(Prompt $prompt)
    {
        $prompt->delete();

        return redirect()->route('prompts.index')->with('success', 'Prompt deleted successfully.');
    }
}
