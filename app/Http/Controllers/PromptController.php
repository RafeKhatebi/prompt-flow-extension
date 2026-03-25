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

    public function index(Request $request)
    {
        $sort = $request->get('sort', 'latest');

        $query = $request->user()->role === 'admin'
            ? Prompt::with('user')
            : $request->user()->prompts()->with('user');

        $query = match ($sort) {
            'oldest'    => $query->oldest(),
            'most_used' => $query->orderByDesc('use_count'),
            'favorites' => $query->orderByDesc('is_favorite')->latest(),
            default     => $query->latest(),
        };

        $prompts = $query->paginate(15)->withQueryString();

        return view('prompts.index', compact('prompts', 'sort'));
    }

    public function create()
    {
        return view('prompts.create');
    }

    public function store(StorePromptRequest $request)
    {
        $prompt = Auth::user()->prompts()->create($request->validated());

        $redirect = redirect()->route('prompts.index')->with('success', 'Prompt created.');

        if ($request->has('copy_after_save')) {
            return redirect()->route('prompts.show', $prompt)->with('copy_on_load', true);
        }

        return $redirect;
    }

    public function show(Prompt $prompt)
    {
        return view('prompts.show', compact('prompt'));
    }

    public function edit(Prompt $prompt)
    {
        return view('prompts.edit', compact('prompt'));
    }

    public function update(UpdatePromptRequest $request, Prompt $prompt)
    {
        $prompt->update($request->validated());

        return redirect()->route('prompts.index')->with('success', 'Prompt updated.');
    }

    public function destroy(Prompt $prompt)
    {
        $prompt->delete();

        return redirect()->route('prompts.index')->with('success', 'Prompt deleted.');
    }

    public function export()
    {
        $prompts = Auth::user()->prompts()->get(['title', 'content', 'tags']);
        $filename = 'prompts_' . date('Y-m-d_His') . '.json';

        return response()->json($prompts)
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:json']);

        $prompts = json_decode(file_get_contents($request->file('file')->getRealPath()), true);

        foreach ($prompts as $data) {
            Auth::user()->prompts()->create([
                'title'   => $data['title'] ?? 'Imported Prompt',
                'content' => $data['content'] ?? '',
                'tags'    => $data['tags'] ?? null,
            ]);
        }

        return redirect()->route('prompts.index')->with('success', count($prompts) . ' prompts imported.');
    }

    public function toggleFavorite(Prompt $prompt)
    {
        $this->authorize('update', $prompt);
        $prompt->update(['is_favorite' => !$prompt->is_favorite]);

        return back()->with('success', $prompt->is_favorite ? 'Added to favorites.' : 'Removed from favorites.');
    }

    public function duplicate(Prompt $prompt)
    {
        $this->authorize('view', $prompt);

        $copy = Auth::user()->prompts()->create([
            'title'   => $prompt->title . ' (copy)',
            'content' => $prompt->content,
            'tags'    => $prompt->tags,
        ]);

        return redirect()->route('prompts.edit', $copy)->with('success', 'Prompt duplicated.');
    }

    public function incrementUse(Prompt $prompt)
    {
        $this->authorize('view', $prompt);
        $prompt->increment('use_count');

        return response()->json(['use_count' => $prompt->use_count]);
    }
}
