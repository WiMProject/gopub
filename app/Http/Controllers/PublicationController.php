<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Publication::query();
        
        // Search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('authors', 'like', "%{$search}%")
                  ->orWhere('keywords', 'like', "%{$search}%");
            });
        }
        
        // Filter by type
        if ($request->has('type') && !empty($request->type)) {
            $query->where('publication_type', $request->type);
        }
        
        // Filter by user if not admin
        if (!Auth::user()->isAdmin()) {
            $query->where('user_id', Auth::id());
        }
        
        // Sort
        $sort = $request->sort ?? 'created_at';
        $order = $request->order ?? 'desc';
        $query->orderBy($sort, $order);
        
        $publications = $query->paginate(10);
        
        return view('publications.index', [
            'publications' => $publications,
            'search' => $request->search,
            'type' => $request->type,
            'sort' => $sort,
            'order' => $order
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('publications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input tanpa file
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'publication_type' => 'required|string|max:50',
            'authors' => 'required|string|max:255',
            'keywords' => 'nullable|string|max:255',
            'abstract' => 'required|string',
            'content' => 'required|string',
        ]);
        
        // Buat publikasi baru
        $publication = new Publication();
        $publication->title = $request->title;
        $publication->publication_type = $request->publication_type;
        $publication->authors = $request->authors;
        $publication->keywords = $request->keywords;
        $publication->abstract = $request->abstract;
        $publication->content = $request->content;
        $publication->user_id = Auth::id();
        $publication->status = Auth::user()->isAdmin() ? 'published' : 'draft';
        
        // Simpan publikasi
        $publication->save();
        
        // Redirect ke halaman detail publikasi
        return redirect()->route('publications.show', $publication->id)
            ->with('success', 'Publication created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publication $publication)
    {
        // Increment view count
        $publication->increment('views');
        
        return view('publications.show', compact('publication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publication $publication)
    {
        // Check if user is authorized to edit
        if (!Auth::user()->isAdmin() && Auth::id() !== $publication->user_id) {
            return redirect()->route('publications.index')
                ->with('error', 'You are not authorized to edit this publication.');
        }
        
        return view('publications.edit', compact('publication'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publication $publication)
    {
        // Check if user is authorized to update
        if (!Auth::user()->isAdmin() && Auth::id() !== $publication->user_id) {
            return redirect()->route('publications.index')
                ->with('error', 'You are not authorized to update this publication.');
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'publication_type' => 'required|string|max:50',
            'authors' => 'required|string|max:255',
            'keywords' => 'nullable|string|max:255',
            'abstract' => 'required|string',
            'content' => 'required|string',
            'status' => 'nullable|string|in:draft,published,rejected',
        ]);
        
        // Update status only if admin
        if (Auth::user()->isAdmin() && $request->has('status')) {
            $publication->status = $request->status;
        }
        
        $publication->title = $request->title;
        $publication->publication_type = $request->publication_type;
        $publication->authors = $request->authors;
        $publication->keywords = $request->keywords;
        $publication->abstract = $request->abstract;
        $publication->content = $request->content;
        $publication->save();
        
        return redirect()->route('publications.show', $publication->id)
            ->with('success', 'Publication updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publication $publication)
    {
        // Check if user is authorized to delete
        if (!Auth::user()->isAdmin() && Auth::id() !== $publication->user_id) {
            return redirect()->route('publications.index')
                ->with('error', 'You are not authorized to delete this publication.');
        }
        
        // Delete file if exists
        if ($publication->file_path && file_exists(public_path($publication->file_path))) {
            unlink(public_path($publication->file_path));
        }
        
        $publication->delete();
        
        return redirect()->route('publications.index')
            ->with('success', 'Publication deleted successfully.');
    }
    
    /**
     * Download the publication file.
     */
    public function download(Publication $publication)
    {
        // Increment download count
        $publication->increment('downloads');
        
        // Redirect back with message
        return redirect()->route('publications.show', $publication->id)
            ->with('info', 'File download is temporarily disabled.');
    }
    
    /**
     * Get publication title suggestions for autocomplete.
     */
    public function suggestions(Request $request)
    {
        $query = $request->query('query');
        
        if (!$query || strlen($query) < 2) {
            return response()->json([]);
        }
        
        $query = Publication::query();
        
        // Filter by user if not admin
        if (!Auth::user()->isAdmin()) {
            $query->where('user_id', Auth::id());
        }
        
        $suggestions = $query->where('title', 'like', "%{$request->query('query')}%")
            ->orWhere('authors', 'like', "%{$request->query('query')}%")
            ->limit(10)
            ->get(['id', 'title', 'authors'])
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->title,
                    'authors' => $item->authors
                ];
            });
        
        return response()->json($suggestions);
    }
}