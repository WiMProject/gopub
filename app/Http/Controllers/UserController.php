<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Check if user is admin.
     */
    private function checkAdmin()
    {
        if (!auth()->user() || !auth()->user()->isAdmin()) {
            abort(403, 'You do not have permission to access this resource.');
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->checkAdmin();
        $query = User::query();
        
        // Search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('institution', 'like', "%{$search}%");
            });
        }
        
        // Filter by role
        if ($request->has('role') && !empty($request->role)) {
            $query->whereHas('role', function($q) use ($request) {
                $q->where('name', $request->role);
            });
        }
        
        // Sort
        $sort = $request->sort ?? 'name';
        $order = $request->order ?? 'asc';
        $query->orderBy($sort, $order);
        
        $users = $query->paginate(10);
        $roles = Role::all();
        
        return view('users.index', [
            'users' => $users,
            'roles' => $roles,
            'search' => $request->search,
            'role' => $request->role,
            'sort' => $sort,
            'order' => $order
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->checkAdmin();
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->checkAdmin();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'bio' => 'nullable|string',
            'institution' => 'nullable|string|max:255',
        ]);
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
            'bio' => $validated['bio'],
            'institution' => $validated['institution'],
        ]);
        
        return redirect()->route('users.show', $user->id)
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->checkAdmin();
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->checkAdmin();
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->checkAdmin();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
            'bio' => 'nullable|string',
            'institution' => 'nullable|string|max:255',
        ]);
        
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }
        
        $user->role_id = $validated['role_id'];
        $user->bio = $validated['bio'];
        $user->institution = $validated['institution'];
        
        $user->save();
        
        return redirect()->route('users.show', $user->id)
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->checkAdmin();
        // Prevent deleting self
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }
        
        $user->delete();
        
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
    
    /**
     * Get user suggestions for autocomplete.
     */
    public function suggestions(Request $request)
    {
        $this->checkAdmin();
        $query = $request->query('query');
        
        if (!$query || strlen($query) < 2) {
            return response()->json([]);
        }
        
        $suggestions = User::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orWhere('institution', 'like', "%{$query}%")
            ->limit(10)
            ->get(['id', 'name', 'email', 'institution'])
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->name,
                    'email' => $item->email,
                    'institution' => $item->institution
                ];
            });
        
        return response()->json($suggestions);
    }
}