<x-modern-layout>
    <x-slot name="header">
        Create User
    </x-slot>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                
                <div class="row mb-4">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="form-control" placeholder="Enter user name">
                            @error('name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="form-control" placeholder="Enter user email">
                            @error('email')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password" required
                                class="form-control" placeholder="Enter password">
                            @error('password')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="form-control" placeholder="Confirm password">
                        </div>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="role_id" class="form-label">Role <span class="text-danger">*</span></label>
                            <select name="role_id" id="role_id" required class="form-control">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="institution" class="form-label">Institution</label>
                            <input type="text" name="institution" id="institution" value="{{ old('institution') }}"
                                class="form-control" placeholder="Enter institution name">
                            @error('institution')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group mb-4">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea name="bio" id="bio" rows="4"
                        class="form-control" placeholder="Enter user bio">{{ old('bio') }}</textarea>
                    @error('bio')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-modern-layout>