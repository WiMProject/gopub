<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\SearchHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Search for publications.
     */
    public function search(Request $request)
    {
        $query = $request->query('query');
        $type = $request->query('type');
        $sort = $request->query('sort', 'created_at');
        $order = $request->query('order', 'desc');
        
        $publications = Publication::query()
            ->where('status', 'published');
        
        if ($query) {
            $publications->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('abstract', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%")
                  ->orWhere('authors', 'like', "%{$query}%")
                  ->orWhere('keywords', 'like', "%{$query}%");
            });
            
            // Save search history if user is logged in
            if (Auth::check() && strlen($query) > 2) {
                SearchHistory::create([
                    'user_id' => Auth::id(),
                    'query' => $query
                ]);
            }
        }
        
        if ($type) {
            $publications->where('publication_type', $type);
        }
        
        $publications->orderBy($sort, $order);
        
        $results = $publications->paginate(10)->withQueryString();
        
        return view('search.results', [
            'publications' => $results,
            'query' => $query,
            'type' => $type,
            'sort' => $sort,
            'order' => $order
        ]);
    }
    
    /**
     * Get search suggestions based on previous searches and publication titles.
     */
    public function suggestions(Request $request)
    {
        $query = $request->query('query');
        
        if (!$query || strlen($query) < 2) {
            return response()->json([]);
        }
        
        // Get suggestions from publication titles
        $titleSuggestions = Publication::where('status', 'published')
            ->where('title', 'like', "%{$query}%")
            ->limit(4)
            ->pluck('title')
            ->toArray();
        
        // Get suggestions from keywords
        $keywordSuggestions = Publication::where('status', 'published')
            ->where('keywords', 'like', "%{$query}%")
            ->limit(3)
            ->pluck('keywords')
            ->flatMap(function ($keywords) {
                return explode(',', $keywords);
            })
            ->filter(function ($keyword) use ($query) {
                return stripos(trim($keyword), $query) !== false;
            })
            ->map(function ($keyword) {
                return trim($keyword);
            })
            ->unique()
            ->values()
            ->toArray();
        
        // Get suggestions from search history if user is logged in
        $historySuggestions = [];
        if (Auth::check()) {
            $historySuggestions = SearchHistory::where('user_id', Auth::id())
                ->where('query', 'like', "%{$query}%")
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->pluck('query')
                ->toArray();
        }
        
        // Merge and unique suggestions
        $suggestions = collect(array_merge($titleSuggestions, $keywordSuggestions, $historySuggestions))
            ->unique()
            ->take(10)
            ->values()
            ->toArray();
        
        return response()->json($suggestions);
    }
}