<x-modern-layout>
    <x-slot name="header">
        User Management
    </x-slot>
    
    <div class="card mb-4" style="animation: slideInDown 0.6s ease-out; background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(79, 70, 229, 0.05)); border: 1px solid rgba(99, 102, 241, 0.2);">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 style="margin: 0; font-weight: 600; color: #1f2937;">Filter Users</h5>
                    <p style="margin: 0; font-size: 0.875rem; color: #6b7280;">Manage and filter system users</p>
                </div>
                <div>
                    <a href="{{ route('users.create') }}" class="btn btn-primary" style="background: linear-gradient(135deg, #6366f1, #4f46e5); border: none; box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(99, 102, 241, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(99, 102, 241, 0.3)'">
                        <i class="fas fa-user-plus mr-1"></i> Create User
                    </a>
                </div>
            </div>
            
            <form action="{{ route('users.index') }}" method="GET">
                <div class="row">
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <div style="position: relative;">
                            <span style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); z-index: 10;">
                                <i class="fas fa-search" style="color: #6366f1;"></i>
                            </span>
                            <input type="text" name="search" id="search" value="{{ $search ?? '' }}" 
                                class="form-control" style="padding-left: 2.5rem;"
                                placeholder="Search by name, email, institution..." autocomplete="off">
                            <div id="search-suggestions" class="search-suggestions"></div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <select name="role" id="role" class="form-control">
                            <option value="">All Roles</option>
                            @foreach($roles as $r)
                                <option value="{{ $r->name }}" {{ ($role ?? '') == $r->name ? 'selected' : '' }}>{{ ucfirst($r->name) }}</option>
                            @endforeach
                        </select>
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
    
    <div class="card">
        <div class="card-header" style="background: linear-gradient(135deg, #f8fafc, #e2e8f0); border-bottom: 2px solid #e5e7eb;">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0" style="color: #1f2937; font-weight: 700;">Users</h5>
                <span class="badge badge-primary" style="background: linear-gradient(135deg, #6366f1, #4f46e5); padding: 8px 16px; font-size: 0.875rem; margin-left: 20px;">{{ $users->total() }} {{ Str::plural('User', $users->total()) }}</span>
            </div>
        </div>
        <div class="card-body p-0">
            @if($users->count() > 0)
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead style="background-color: #f8fafc;">
                            <tr>
                                <th style="width: 25%; text-align: left; font-weight: 600; color: #374151; padding: 12px 16px;">Name</th>
                                <th style="width: 20%; text-align: center; font-weight: 600; color: #374151; padding: 12px 16px;">Email</th>
                                <th style="width: 12%; text-align: center; font-weight: 600; color: #374151; padding: 12px 16px;">Role</th>
                                <th style="width: 18%; text-align: center; font-weight: 600; color: #374151; padding: 12px 16px;">Institution</th>
                                <th style="width: 10%; text-align: center; font-weight: 600; color: #374151; padding: 12px 16px;">Publications</th>
                                <th style="width: 15%; text-align: center; font-weight: 600; color: #374151; padding: 12px 16px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td style="text-align: left; vertical-align: middle; padding: 12px 16px;">
                                        <div class="d-flex align-items-center">
                                            <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #6366f1, #4f46e5); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; margin-right: 0.75rem; font-size: 0.875rem;">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <a href="{{ route('users.show', $user->id) }}" style="color: #1f2937; text-decoration: none; font-weight: 500;">
                                                    {{ $user->name }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-align: center; vertical-align: middle; padding: 12px 16px; color: #6b7280; font-size: 0.875rem;">{{ $user->email }}</td>
                                    <td style="text-align: center; vertical-align: middle; padding: 12px 16px;">
                                        @if($user->role->name == 'admin')
                                            <span class="badge badge-danger">Admin</span>
                                        @elseif($user->role->name == 'publisher')
                                            <span class="badge badge-success">Publisher</span>
                                        @else
                                            <span class="badge badge-secondary">User</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center; vertical-align: middle; padding: 12px 16px; color: #6b7280; font-size: 0.875rem;">{{ $user->institution ?? 'Not specified' }}</td>
                                    <td style="text-align: center; vertical-align: middle; padding: 12px 16px; font-weight: 600; color: #374151;">{{ $user->publications->count() }}</td>
                                    <td style="text-align: center; vertical-align: middle; padding: 12px 16px;">
                                        <div class="action-buttons" style="display: flex !important; justify-content: center !important; align-items: center !important; width: 100%; gap: 4px;">
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-outline-primary" title="View" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-eye" style="font-size: 0.75rem;"></i>
                                            </a>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-edit" style="font-size: 0.75rem;"></i>
                                            </a>
                                            @if($user->id !== auth()->id())
                                                <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;" onclick="return confirm('Are you sure you want to delete this user?')">
                                                        <i class="fas fa-trash-alt" style="font-size: 0.75rem;"></i>
                                                    </button>
                                                </form>
                                            @endif
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
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; color: #1f2937;">No users found</h3>
                    <p style="color: #6b7280; max-width: 500px; margin-left: auto; margin-right: auto; margin-bottom: 1.5rem;">
                        No users match your search criteria. Try adjusting your filters.
                    </p>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-redo mr-1"></i> Reset Filters
                    </a>
                </div>
            @endif
        </div>
        @if($users->count() > 0)
            <div class="card-footer">
                <div class="pagination-container">
                    <div class="pagination-nav">
                        @if($users->onFirstPage())
                            <span class="pagination-btn disabled">
                                <i class="fas fa-chevron-left"></i> Previous
                            </span>
                        @else
                            <a href="{{ $users->previousPageUrl() }}" class="pagination-btn">
                                <i class="fas fa-chevron-left"></i> Previous
                            </a>
                        @endif
                    </div>
                    
                    <div class="pagination-info">
                        Page <span class="pagination-current">{{ $users->currentPage() }}</span> of {{ $users->lastPage() }}
                    </div>
                    
                    <div class="pagination-nav">
                        @if($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}" class="pagination-btn">
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
                    fetch(`/users/suggestions?query=${encodeURIComponent(query)}`)
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
                        
                        // Create content with name and email
                        const name = document.createElement('div');
                        name.className = 'suggestion-title';
                        
                        // Highlight matching text in name
                        const query = searchInput.value.toLowerCase();
                        const nameText = suggestion.text.toLowerCase();
                        const index = nameText.indexOf(query);
                        
                        if (index >= 0) {
                            const before = suggestion.text.substring(0, index);
                            const match = suggestion.text.substring(index, index + query.length);
                            const after = suggestion.text.substring(index + query.length);
                            name.innerHTML = before + '<span class="suggestion-highlight">' + match + '</span>' + after;
                        } else {
                            name.textContent = suggestion.text;
                        }
                        
                        const email = document.createElement('div');
                        email.className = 'suggestion-subtitle';
                        email.textContent = suggestion.email;
                        
                        item.appendChild(name);
                        item.appendChild(email);
                        
                        if (suggestion.institution) {
                            const institution = document.createElement('div');
                            institution.className = 'suggestion-subtitle';
                            institution.style.fontSize = '0.75rem';
                            institution.style.color = '#9ca3af';
                            institution.textContent = suggestion.institution;
                            item.appendChild(institution);
                        }
                        
                        // Click event to select suggestion
                        item.addEventListener('click', function() {
                            searchInput.value = suggestion.text;
                            suggestionsContainer.style.display = 'none';
                        });
                        
                        suggestionsContainer.appendChild(item);
                    });
                    
                    // Adjust container height based on number of items (with multiple lines)
                    const itemHeight = 70; // approximate height per item with email and institution
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