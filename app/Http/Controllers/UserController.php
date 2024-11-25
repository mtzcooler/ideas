<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $ideas = $user->ideas()->paginate(5);

        return view('users.show', compact('user', 'ideas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $editing = true;
        $ideas = $user->ideas()->paginate(5);

        return view('users.edit', compact('user', 'editing', 'ideas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user)
    {
        $validated = request()->validate([
            'name' => 'required|min:3|max:40',
            'bio' => 'nullable|min:1|max:255',
            'avatar' => 'image',
        ]);

        if (request()->has('avatar')) {
            $imagePath = request()->file('avatar')->store('profile', 'public');
            $validated['avatar'] = $imagePath;
            Storage::disk('public')->delete($user->avatar);
        }

        $user->update($validated);

        return redirect()->route('profile')->with('success', 'User updated successfully!');
    }

    public function profile()
    {
        return $this->show(Auth::user());
    }
}
