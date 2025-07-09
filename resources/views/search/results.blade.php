<x-modern-layout>
    <x-slot name="header">
        Search Publications
    </x-slot>
    
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('search') }}" method="GET">
                <div class="row">
                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                        <div style="position: relative;">
                            <span style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); z-index: 10;">
                                <i class="fas fa-search" style="color: #6b7280;"></i>
                            </span>
                            <input type="text" name="query" id="query" value="{{ $query ?? '' }}" 
                                class="form-control" style="padding-left: 2.5rem;"
                                placeholder="Search by title, author, keywords..." autocomplete="off">
                            <div id="search-suggestions" class="search-suggestions"></div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-4">
                                <select name="type" id="type" class="form-control">
                                    <option value="">All Types</option>
                                    <option value="jurnal" {{ ($type ?? '') == 'jurnal' ? 'selected' : '' }}>Journal</option>
                                    <option value="karya ilmiah" {{ ($type ?? '') == 'karya ilmiah' ? 'selected' : '' }}>Scientific Work</option>
                                    <option value="artikel" {{ ($type ?? '') == 'artikel' ? 'selected' : '' }}>Article</option>
                                    <option value="makalah" {{ ($type ?? '') == 'makalah' ? 'selected' : '' }}>Paper</option>
                                    <option value="skripsi" {{ ($type ?? '') == 'skripsi' ? 'selected' : '' }}>Thesis</option>
                                    <option value="tesis" {{ ($type ?? '') == 'tesis' ? 'selected' : '' }}>Master's Thesis</option>
                                    <option value="disertasi" {{ ($type ?? '') == 'disertasi' ? 'selected' : '' }}>Dissertation</option>
                                </select>
                            </div>
                            
                            <div class="col-4">
                                <select name="sort" id="sort" class="form-control">
                                    <option value="created_at" {{ ($sort ?? 'created_at') == 'created_at' ? 'selected' : '' }}>Date</option>
                                    <option value="title" {{ ($sort ?? '') == 'title' ? 'selected' : '' }}>Title</option>
                                    <option value="views" {{ ($sort ?? '') == 'views' ? 'selected' : '' }}>Views</option>
                                    <option value="downloads" {{ ($sort ?? '') == 'downloads' ? 'selected' : '' }}>Downloads</option>
                                </select>
                            </div>
                            
                            <div class="col-4">
                                <div class="d-flex">
                                    <select name="order" id="order" class="form-control mr-2">
                                        <option value="desc" {{ ($order ?? 'desc') == 'desc' ? 'selected' : '' }}>Desc</option>
                                        <option value="asc" {{ ($order ?? '') == 'asc' ? 'selected' : '' }}>Asc</option>
                                    </select>
                                    
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="font-size: 1.25rem; font-weight: 600; margin: 0;">
            {{ isset($query) ? 'Search Results for "' . $query . '"' : 'All Publications' }}
            @if(isset($type) && !empty($type))
                <span class="badge badge-primary ml-2" style="font-size: 0.75rem; vertical-align: middle;">{{ ucfirst($type) }}</span>
            @endif
        </h2>
        
        @if(isset($publications))
            <p style="margin: 0; color: #6b7280;">
                {{ $publications->total() }} {{ Str::plural('result', $publications->total()) }} found
            </p>
        @endif
    </div>
    
    @if(isset($publications) && $publications->count() > 0)
        <div class="row">
            @foreach($publications as $publication)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge badge-primary">{{ ucfirst($publication->publication_type) }}</span>
                                <small style="color: #6b7280;">{{ $publication->created_at->format('M d, Y') }}</small>
                            </div>
                            
                            <h3 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 0.5rem;">
                                <a href="{{ route('publications.show', $publication->id) }}" style="color: #1f2937; text-decoration: none;">
                                    {{ \Illuminate\Support\Str::limit($publication->title, 60) }}
                                </a>
                            </h3>
                            
                            <p style="color: #6b7280; font-size: 0.875rem; margin-bottom: 0.5rem;">
                                By: {{ \Illuminate\Support\Str::limit($publication->authors, 40) }}
                            </p>
                            
                            <p style="color: #4b5563; font-size: 0.875rem; margin-bottom: 1rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ \Illuminate\Support\Str::limit($publication->abstract, 150) }}
                            </p>
                            
                            @if($publication->keywords)
                                <div style="margin-bottom: 1rem;">
                                    @foreach(explode(',', $publication->keywords) as $keyword)
                                        <span style="display: inline-block; background-color: #e0f2fe; color: #0369a1; font-size: 0.75rem; padding: 0.25rem 0.5rem; border-radius: 9999px; margin-right: 0.5rem; margin-bottom: 0.5rem;">
                                            {{ trim($keyword) }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div style="font-size: 0.75rem; color: #6b7280;">
                                    <i class="fas fa-eye mr-1"></i> {{ $publication->views }}
                                    <i class="fas fa-download ml-2 mr-1"></i> {{ $publication->downloads }}
                                </div>
                                <a href="{{ route('publications.show', $publication->id) }}" class="btn btn-sm btn-outline-primary">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="pagination-container">
            <div class="pagination-nav">
                @if($publications->onFirstPage())
                    <span class="pagination-btn disabled">
                        <i class="fas fa-chevron-left"></i> Previous
                    </span>
                @else
                    <a href="{{ $publications->previousPageUrl() }}" class="pagination-btn">
                        <i class="fas fa-chevron-left"></i> Previous
                    </a>
                @endif
            </div>
            
            <div class="pagination-info">
                Page <span class="pagination-current">{{ $publications->currentPage() }}</span> of {{ $publications->lastPage() }}
            </div>
            
            <div class="pagination-nav">
                @if($publications->hasMorePages())
                    <a href="{{ $publications->nextPageUrl() }}" class="pagination-btn">
                        Next <i class="fas fa-chevron-right"></i>
                    </a>
                @else
                    <span class="pagination-btn disabled">
                        Next <i class="fas fa-chevron-right"></i>
                    </span>
                @endif
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body text-center py-5">
                <div style="font-size: 3rem; color: #d1d5db; margin-bottom: 1rem;">
                    <i class="fas fa-search"></i>
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; color: #1f2937;">No publications found</h3>
                <p style="color: #6b7280; max-width: 500px; margin-left: auto; margin-right: auto;">
                    We couldn't find any publications matching your search criteria. Try adjusting your search terms or filters.
                </p>
                <a href="{{ route('search') }}" class="btn btn-outline-primary mt-3">
                    <i class="fas fa-redo mr-1"></i> Reset Search
                </a>
            </div>
        </div>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('query');
            const suggestionsContainer = document.getElementById('search-suggestions');
            let typingTimer;
            const doneTypingInterval = 300; // ms
            
            // Event listener for input changes
            searchInput.addEventListener('input', function() {
                clearTimeout(typingTimer);
                if (searchInput.value.length >= 2) {
                    typingTimer = setTimeout(fetchSuggestions, doneTypingInterval);
                } else {
                    suggestionsContainer.style.display = 'none';
                }
            });
            
            // Hide suggestions when clicking outside
            document.addEventListener('click', function(e) {
                if (e.target !== searchInput && e.target !== suggestionsContainer) {
                    suggestionsContainer.style.display = 'none';
                    // Reset card height
                    const searchCard = searchInput.closest('.card');
                    if (searchCard) {
                        searchCard.style.paddingBottom = '';
                    }
                }
            });
            
            // Fetch suggestions from API
            function fetchSuggestions() {
                const query = searchInput.value;
                fetch(`/search/suggestions?query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            displaySuggestions(data);
                        } else {
                            suggestionsContainer.style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching suggestions:', error);
                    });
            }
            
            // Display suggestions in the container
            function displaySuggestions(suggestions) {
                suggestionsContainer.innerHTML = '';
                
                // Limit to 10 items and adjust container height
                const limitedSuggestions = suggestions.slice(0, 10);
                
                limitedSuggestions.forEach(suggestion => {
                    const item = document.createElement('div');
                    item.className = 'suggestion-item';
                    
                    const title = document.createElement('div');
                    title.className = 'suggestion-title';
                    
                    // Highlight matching text
                    const query = searchInput.value.toLowerCase();
                    const suggestionText = suggestion.toLowerCase();
                    const index = suggestionText.indexOf(query);
                    
                    if (index >= 0) {
                        const before = suggestion.substring(0, index);
                        const match = suggestion.substring(index, index + query.length);
                        const after = suggestion.substring(index + query.length);
                        title.innerHTML = before + '<span class="suggestion-highlight">' + match + '</span>' + after;
                    } else {
                        title.textContent = suggestion;
                    }
                    
                    item.appendChild(title);
                    
                    // Click event to select suggestion
                    item.addEventListener('click', function() {
                        searchInput.value = suggestion;
                        suggestionsContainer.style.display = 'none';
                    });
                    
                    suggestionsContainer.appendChild(item);
                });
                
                // Adjust container height based on number of items
                const itemHeight = 44; // approximate height per item
                const maxVisibleItems = Math.min(limitedSuggestions.length, 10);
                const containerHeight = maxVisibleItems * itemHeight;
                
                suggestionsContainer.style.maxHeight = containerHeight + 'px';
                suggestionsContainer.style.display = 'block';
                
                // Extend card to accommodate suggestions
                const searchCard = searchInput.closest('.card');
                if (searchCard) {
                    searchCard.style.paddingBottom = (containerHeight + 20) + 'px';
                }
            }
        });
    </script>
</x-modern-layout>