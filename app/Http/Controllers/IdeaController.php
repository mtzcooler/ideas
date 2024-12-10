<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IdeaController extends Controller
{
    public function show(Idea $idea)
    {
        return view('ideas.show', compact('idea'));
    }

    public function store()
    {
        $validated = request()->validate([
            'content' => 'required|min:3|max:240',
        ]);
        $validated['user_id'] = Auth::id();

        Idea::create($validated);

        return redirect()->route('dashboard')->with('success', 'Idea was created successfully!');
    }

    public function edit(Idea $idea)
    {
        $editing = true;

        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(Idea $idea)
    {
        if (Auth::id() !== $idea->user_id) {
            abort(403, "Não tem permissão para executar a ação.");
        }

        $validated = request()->validate([
            'content' => 'required|min:3|max:240',
        ]);

        if ($idea->update($validated)) {
            return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea was updated successfully.');
        };
        return redirect()->route('ideas.show', $idea->id)->with('error', 'Idea was not updated.');
    }

    public function destroy(Idea $idea)
    {
        if (Auth::id() !== $idea->user_id) {
            abort(403, "Não tem permissão para executar a ação.");
        }

        //Manual search
        //$idea = Idea::where('id', $id)->firstOrFail();

        //Route model binding
        if ($idea->delete()) {
            return redirect()->route('dashboard')->with('success', 'Idea was deleted successfully.');
        };
        return redirect()->route('dashboard')->with('error', 'Idea was not deleted.');
    }

    public function like(Idea $idea)
    {
        $user = Auth::user();
        $user->like()->attach($idea,  ['liked_at' => now()]);

        return redirect()->back()->with('success', 'Liked!');
    }

    public function unlike(Idea $idea)
    {
        $user = Auth::user();
        $user->like()->detach($idea);

        return redirect()->back()->with('success', 'Unliked!');
    }
}
