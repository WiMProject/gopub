<x-modern-layout>
    <x-slot name="header">
        Publications
    </x-slot>
    
    <div class="card mb-4" style="animation: slideInDown 0.6s ease-out;">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 style="margin: 0; font-weight: 600; color: #1f2937;">Filter Publications</h5>
                </div>
                <div>
                    <a href="{{ route('publications.create') }}" class="btn btn-primary" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); border: none; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(59, 130, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(59, 130, 246, 0.3)'">
                        <i class="fas fa-plus mr-1"></i> Create Publication
                    </a>
                </div>
            </div>
            
            <form action="{{ route('publications.index') }}" method="GET">
                <div class="row">
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <div style="position: relative;">
                            <span style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); z-index: 10; color: #3b82f6;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="search" id="search" value="{{ $search ?? '' }}" 
                                class="form-control mb-3" style="padding-left: 2.5rem;"
                                placeholder="Search publications..." autocomplete="off">
                            <div id="search-suggestions" class="search-suggestions"></div>
                        </div>
                        
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
                    
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <div class="d-flex">
                            <select name="sort" id="sort" class="form-control mr-2">
                                <option value="created_at" {{ ($sort ?? 'created_at') == 'created_at' ? 'selected' : '' }}>Date</option>
                                <option value="title" {{ ($sort ?? '') == 'title' ? 'selected' : '' }}>Title</option>
                                <option value="views" {{ ($sort ?? '') == 'views' ? 'selected' : '' }}>Views</option>
                                <option value="downloads" {{ ($sort ?? '') == 'downloads' ? 'selected' : '' }}>Downloads</option>
                            </select>
                            
                            <select name="order" id="order" class="form-control">
                                <option value="desc" {{ ($order ?? 'desc') == 'desc' ? 'selected' : '' }}>Desc</option>
                                <option value="asc" {{ ($order ?? '') == 'asc' ? 'selected' : '' }}>Asc</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-4">
                        <button type="submit" class="btn btn-outline-primary btn-block">
                            <i class="fas fa-filter mr-1"></i> Apply Filters
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card" style="animation: fadeInUp 0.6s ease-out 0.2s both;">
        <div class="card-header" style="background: linear-gradient(135deg, #f8fafc, #e2e8f0); border-bottom: 2px solid #e5e7eb;">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0" style="color: #1f2937; font-weight: 700;">All Publications</h5>
                <span class="badge badge-primary" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); padding: 8px 16px; font-size: 0.875rem; margin-left: 20px;">{{ $publications->total() }} {{ Str::plural('Publication', $publications->total()) }}</span>
            </div>
        </div>
        <div class="card-body p-0">
            @if($publications->count() > 0)
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead style="background-color: #f8fafc;">
                            <tr>
                                <th style="width: 30%; text-align: left; font-weight: 600; color: #374151; padding: 12px 16px;">Title</th>
                                <th style="width: 12%; text-align: center; font-weight: 600; color: #374151; padding: 12px 16px;">Type</th>
                                <th style="width: 12%; text-align: center; font-weight: 600; color: #374151; padding: 12px 16px;">Status</th>
                                <th style="width: 8%; text-align: center; font-weight: 600; color: #374151; padding: 12px 16px;">Views</th>
                                <th style="width: 8%; text-align: center; font-weight: 600; color: #374151; padding: 12px 16px;">Downloads</th>
                                <th style="width: 12%; text-align: center; font-weight: 600; color: #374151; padding: 12px 16px;">Date</th>
                                <th style="width: 18%; text-align: center; font-weight: 600; color: #374151; padding: 12px 16px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($publications as $publication)
                                <tr style="border-bottom: 1px solid #f3f4f6; transition: all 0.2s ease;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='transparent'">
                                    <td style="text-align: left; vertical-align: middle; padding: 12px 16px;">
                                        <a href="{{ route('publications.show', $publication->id) }}" style="color: #1f2937; text-decoration: none; font-weight: 500;">
                                            {{ \Illuminate\Support\Str::limit($publication->title, 50) }}
                                        </a>
                                    </td>
                                    <td style="text-align: center; vertical-align: middle; padding: 12px 16px;">
                                        <span style="font-size: 0.875rem; color: #6b7280;">{{ ucfirst($publication->publication_type) }}</span>
                                    </td>
                                    <td style="text-align: center; vertical-align: middle; padding: 12px 16px;">
                                        @if($publication->status == 'published')
                                            <span class="badge badge-success">Published</span>
                                        @elseif($publication->status == 'draft')
                                            <span class="badge badge-secondary">Draft</span>
                                        @else
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center; vertical-align: middle; padding: 12px 16px; font-weight: 600; color: #374151;">{{ $publication->views }}</td>
                                    <td style="text-align: center; vertical-align: middle; padding: 12px 16px; font-weight: 600; color: #374151;">{{ $publication->downloads }}</td>
                                    <td style="text-align: center; vertical-align: middle; padding: 12px 16px; color: #6b7280; font-size: 0.875rem;">{{ $publication->created_at->format('M d, Y') }}</td>
                                    <td style="text-align: center; vertical-align: middle; padding: 12px 16px;">
                                        <div class="action-buttons" style="display: flex !important; justify-content: center !important; align-items: center !important; width: 100%; gap: 4px;">
                                            <a href="{{ route('publications.show', $publication->id) }}" class="btn btn-sm btn-outline-primary" title="View" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-eye" style="font-size: 0.75rem;"></i>
                                            </a>
                                            <a href="{{ route('publications.edit', $publication->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-edit" style="font-size: 0.75rem;"></i>
                                            </a>
                                            <form method="POST" action="{{ route('publications.destroy', $publication->id) }}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;" onclick="return confirm('Are you sure you want to delete this publication?')">
                                                    <i class="fas fa-trash-alt" style="font-size: 0.75rem;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <div style="font-size: 3rem; color: #d1d5db; margin-bottom: 1rem;">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; color: #1f2937;">No publications found</h3>
                    <p style="color: #6b7280; max-width: 500px; margin-left: auto; margin-right: auto; margin-bottom: 1.5rem;">
                        You haven't created any publications yet. Start sharing your research with the world.
                    </p>
                    <a href="{{ route('publications.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus mr-1"></i> Create Publication
                    </a>
                </div>
            @endif
        </div>
        @if($publications->count() > 0)
            <div class="card-footer">
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
            </div>
        @endif
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const suggestionsContainer = document.getElementById('search-suggestions');
            let typingTimer;
            const doneTypingInterval = 300; // ms
            
            if (searchInput && suggestionsContainer) {
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
                    fetch(`/publications/suggestions?query=${encodeURIComponent(query)}`)
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
                        
                        // Create content with title and authors
                        const title = document.createElement('div');
                        title.className = 'suggestion-title';
                        
                        // Highlight matching text in title
                        const query = searchInput.value.toLowerCase();
                        const titleText = suggestion.text.toLowerCase();
                        const index = titleText.indexOf(query);
                        
                        if (index >= 0) {
                            const before = suggestion.text.substring(0, index);
                            const match = suggestion.text.substring(index, index + query.length);
                            const after = suggestion.text.substring(index + query.length);
                            title.innerHTML = before + '<span class="suggestion-highlight">' + match + '</span>' + after;
                        } else {
                            title.textContent = suggestion.text;
                        }
                        
                        const authors = document.createElement('div');
                        authors.className = 'suggestion-subtitle';
                        authors.textContent = 'By: ' + suggestion.authors;
                        
                        item.appendChild(title);
                        item.appendChild(authors);
                        
                        // Click event to select suggestion
                        item.addEventListener('click', function() {
                            searchInput.value = suggestion.text;
                            suggestionsContainer.style.display = 'none';
                        });
                        
                        suggestionsContainer.appendChild(item);
                    });
                    
                    // Adjust container height based on number of items (with subtitle)
                    const itemHeight = 60; // approximate height per item with subtitle
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
            }
        });
    </script>
</x-modern-layout>