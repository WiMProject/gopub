<x-modern-layout>
    <x-slot name="header">
        User Profile
    </x-slot>
    
    <div class="mb-4">
        <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Back to Users
        </a>
    </div>
    
    <div class="row">
        <div class="col-12 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <div style="width: 100px; height: 100px; background-color: #3b82f6; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin: 0 auto 1.5rem;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    
                    <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.25rem;">{{ $user->name }}</h3>
                    <p style="color: #6b7280; margin-bottom: 1rem;">{{ $user->email }}</p>
                    
                    @if($user->role->name == 'admin')
                        <span class="badge badge-danger" style="font-size: 0.875rem; padding: 0.35rem 0.75rem;">Admin</span>
                    @elseif($user->role->name == 'publisher')
                        <span class="badge badge-success" style="font-size: 0.875rem; padding: 0.35rem 0.75rem;">Publisher</span>
                    @else
                        <span class="badge badge-secondary" style="font-size: 0.875rem; padding: 0.35rem 0.75rem;">User</span>
                    @endif
                    
                    <div class="mt-4 pt-4" style="border-top: 1px solid #e5e7eb;">
                        <div class="d-flex justify-content-between mb-2">
                            <span style="color: #6b7280;">Institution:</span>
                            <span style="font-weight: 500;">{{ $user->institution ?? 'Not specified' }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span style="color: #6b7280;">Publications:</span>
                            <span style="font-weight: 500;">{{ $user->publications->count() }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span style="color: #6b7280;">Joined:</span>
                            <span style="font-weight: 500;">{{ $user->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <div class="d-flex">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary flex-grow-1 mr-2">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            
                            @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="flex-grow-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-block" onclick="return confirm('Are you sure you want to delete this user?')">
                                        <i class="fas fa-trash-alt mr-1"></i> Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            @if($user->bio)
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Bio</h5>
                    </div>
                    <div class="card-body">
                        <p style="margin: 0;">{{ $user->bio }}</p>
                    </div>
                </div>
            @endif
        </div>
        
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Publications</h5>
                </div>
                <div class="card-body p-0">
                    @if($user->publications->count() > 0)
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Views</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->publications as $publication)
                                        <tr>
                                            <td>
                                                <a href="{{ route('publications.show', $publication->id) }}" style="color: #1f2937; text-decoration: none; font-weight: 500;">
                                                    {{ \Illuminate\Support\Str::limit($publication->title, 40) }}
                                                </a>
                                            </td>
                                            <td>{{ ucfirst($publication->publication_type) }}</td>
                                            <td>
                                                @if($publication->status == 'published')
                                                    <span class="badge badge-success">Published</span>
                                                @elseif($publication->status == 'draft')
                                                    <span class="badge badge-secondary">Draft</span>
                                                @else
                                                    <span class="badge badge-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>{{ $publication->views }}</td>
                                            <td>{{ $publication->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('publications.show', $publication->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
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
                            <p style="color: #6b7280; max-width: 500px; margin-left: auto; margin-right: auto;">
                                This user hasn't created any publications yet.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-modern-layout>