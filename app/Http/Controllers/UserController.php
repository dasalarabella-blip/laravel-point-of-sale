<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => [
                'required',
                'string',
                'max:50',
                'unique:users,username',
            ],
            'full_name' => [
                'required',
                'string',
                'max:100',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request
                ->image('avatar')
                ->orient()
                ->cover(300, 300)
                ->toWebp()
                ->quality(80)
                ->storePublicly('avatars', 'public');
        }

        User::create($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'Staff account created successfully.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => [
                'required',
                'string',
                'max:50',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'full_name' => [
                'required',
                'string',
                'max:100',
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if ($request->hasFile('avatar')) {
            $oldAvatar = $user->avatar;

            $validated['avatar'] = $request
                ->image('avatar')
                ->orient()
                ->cover(300, 300)
                ->toWebp()
                ->quality(80)
                ->storePublicly('avatars', 'public');

            if ($oldAvatar) {
                Storage::disk('public')->delete($oldAvatar);
            }
        }

        $user->update($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'Staff account updated successfully.');
    }

    public function destroy(Request $request, User $user)
    {
        if ($request->user()->is($user)) {
            return back()->withErrors([
                'delete' => 'You cannot delete the account currently logged in.',
            ]);
        }

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Staff account deleted successfully.');
    }
}