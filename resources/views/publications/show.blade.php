<x-modern-layout>
    <div class="mb-4">
        <a href="{{ route('publications.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Back to Publications
        </a>
    </div>
    
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <span class="badge badge-primary mb-2">{{ ucfirst($publication->publication_type) }}</span>
                    <h1 style="font-size: 1.75rem; font-weight: 700; margin-bottom: 0.5rem;">{{ $publication->title }}</h1>
                    <p style="color: #6b7280; margin-bottom: 0;">
                        By: {{ $publication->authors }}
                    </p>
                </div>
                
                <div class="text-right">
                    <div style="color: #6b7280; font-size: 0.875rem; margin-bottom: 0.5rem;">
                        <i class="fas fa-calendar-alt mr-1"></i> {{ $publication->created_at->format('M d, Y') }}
                    </div>
                    <div style="color: #6b7280; font-size: 0.875rem; margin-bottom: 0.5rem;">
                        <i class="fas fa-eye mr-1"></i> {{ $publication->views }} views
                    </div>
                    <div style="color: #6b7280; font-size: 0.875rem;">
                        <i class="fas fa-download mr-1"></i> {{ $publication->downloads }} downloads
                    </div>
                </div>
            </div>
            
            <div class="mb-4">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.75rem;">Abstract</h2>
                <div style="background-color: #f9fafb; border-radius: 0.375rem; padding: 1.5rem; border-left: 4px solid #3b82f6;">
                    {{ $publication->abstract }}
                </div>
            </div>
            
            @if($publication->keywords)
                <div class="mb-4">
                    <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.75rem;">Keywords</h2>
                    <div>
                        @foreach(explode(',', $publication->keywords) as $keyword)
                            <span style="display: inline-block; background-color: #e0f2fe; color: #0369a1; font-size: 0.875rem; padding: 0.25rem 0.75rem; border-radius: 9999px; margin-right: 0.5rem; margin-bottom: 0.5rem;">
                                {{ trim($keyword) }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <div class="mb-4">
                <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.75rem;">Content</h2>
                <div style="line-height: 1.7;">
                    {{ $publication->content }}
                </div>
            </div>
            
            @if($publication->file_path)
                <div class="mb-4">
                    <h2 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.75rem;">Attachment</h2>
                    <a href="{{ route('publications.download', $publication->id) }}" class="btn btn-outline-primary">
                        <i class="fas fa-download mr-1"></i> Download File
                    </a>
                </div>
            @endif
            
            <div class="d-flex justify-content-between align-items-center mt-5 pt-4" style="border-top: 1px solid #e5e7eb;">
                <div>
                    <span class="badge {{ $publication->status == 'published' ? 'badge-success' : ($publication->status == 'draft' ? 'badge-secondary' : 'badge-danger') }}">
                        {{ ucfirst($publication->status) }}
                    </span>
                </div>
                
                <div>
                    @if(Auth::check() && (Auth::user()->isAdmin() || Auth::id() === $publication->user_id))
                        <a href="{{ route('publications.edit', $publication->id) }}" class="btn btn-sm btn-outline-primary mr-2">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        
                        <form method="POST" action="{{ route('publications.destroy', $publication->id) }}" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this publication?')">
                                <i class="fas fa-trash-alt mr-1"></i> Delete
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h2 style="font-size: 1.25rem; font-weight: 600; margin: 0;">Publication Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th style="width: 150px; padding-left: 0;">Publication Type</th>
                                <td>{{ ucfirst($publication->publication_type) }}</td>
                            </tr>
                            <tr>
                                <th style="width: 150px; padding-left: 0;">Author(s)</th>
                                <td>{{ $publication->authors }}</td>
                            </tr>
                            <tr>
                                <th style="width: 150px; padding-left: 0;">Published By</th>
                                <td>{{ $publication->user->name }}</td>
                            </tr>
                            <tr>
                                <th style="width: 150px; padding-left: 0;">Institution</th>
                                <td>{{ $publication->user->institution ?? 'Not specified' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 col-md-6">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th style="width: 150px; padding-left: 0;">Status</th>
                                <td>
                                    <span class="badge {{ $publication->status == 'published' ? 'badge-success' : ($publication->status == 'draft' ? 'badge-secondary' : 'badge-danger') }}">
                                        {{ ucfirst($publication->status) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 150px; padding-left: 0;">Published Date</th>
                                <td>{{ $publication->created_at->format('M d, Y') }}</td>
                            </tr>
                            <tr>
                                <th style="width: 150px; padding-left: 0;">Views</th>
                                <td>{{ $publication->views }}</td>
                            </tr>
                            <tr>
                                <th style="width: 150px; padding-left: 0;">Downloads</th>
                                <td>{{ $publication->downloads }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-modern-layout>