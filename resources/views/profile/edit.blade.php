<x-modern-layout>
    <x-slot name="header">
        Profile Settings
    </x-slot>
    
    <div class="row">
        <div class="col-12 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <div style="width: 100px; height: 100px; background-color: #3b82f6; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; margin: 0 auto 1.5rem;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    
                    <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.25rem;">{{ Auth::user()->name }}</h3>
                    <p style="color: #6b7280; margin-bottom: 1rem;">{{ Auth::user()->email }}</p>
                    
                    @if(Auth::user()->role->name == 'admin')
                        <span class="badge badge-danger" style="font-size: 0.875rem; padding: 0.35rem 0.75rem;">Admin</span>
                    @elseif(Auth::user()->role->name == 'publisher')
                        <span class="badge badge-success" style="font-size: 0.875rem; padding: 0.35rem 0.75rem;">Publisher</span>
                    @else
                        <span class="badge badge-secondary" style="font-size: 0.875rem; padding: 0.35rem 0.75rem;">User</span>
                    @endif
                    
                    <div class="mt-4 pt-4" style="border-top: 1px solid #e5e7eb;">
                        <div class="d-flex justify-content-between mb-2">
                            <span style="color: #6b7280;">Institution:</span>
                            <span style="font-weight: 500;">{{ Auth::user()->institution ?? 'Not specified' }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span style="color: #6b7280;">Publications:</span>
                            <span style="font-weight: 500;">{{ Auth::user()->publications->count() }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span style="color: #6b7280;">Joined:</span>
                            <span style="font-weight: 500;">{{ Auth::user()->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Update Profile</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="form-group mb-4">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required
                                class="form-control" placeholder="Enter your name">
                            @error('name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required
                                class="form-control" placeholder="Enter your email">
                            @error('email')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="institution" class="form-label">Institution</label>
                            <input type="text" name="institution" id="institution" value="{{ old('institution', Auth::user()->institution) }}"
                                class="form-control" placeholder="Enter your institution">
                            @error('institution')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea name="bio" id="bio" rows="4"
                                class="form-control" placeholder="Tell us about yourself">{{ old('bio', Auth::user()->bio) }}</textarea>
                            @error('bio')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Delete Account</h5>
                </div>
                <div class="card-body">
                    <p style="color: #6b7280; margin-bottom: 1.5rem;">
                        Once your account is deleted, all of your publications and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
                    </p>
                    
                    <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        
                        <div class="form-group mb-4">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password" required
                                class="form-control" placeholder="Enter your current password to confirm">
                            @error('password')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt mr-1"></i> Delete Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-modern-layout>