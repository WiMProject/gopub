<x-modern-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>
    
    <x-slot name="subheader">
        Welcome back, {{ Auth::user()->name }}!
    </x-slot>

    <!-- Stats Cards -->
    <div class="row mb-4" style="animation: fadeInUp 0.6s ease-out;">
        <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
            <div class="card" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; border: none; cursor: pointer; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-5px) scale(1.02)'" onmouseout="this.style.transform='translateY(0) scale(1)'">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 style="font-size: 0.875rem; color: rgba(255,255,255,0.8); margin-bottom: 0.5rem;">Total Publications</h6>
                            <h3 style="font-size: 1.5rem; font-weight: 700; margin: 0; color: white;">
                                @if(Auth::user()->isAdmin())
                                    {{ \App\Models\Publication::count() }}
                                @else
                                    {{ Auth::user()->publications->count() }}
                                @endif
                            </h3>
                        </div>
                        <div style="font-size: 2rem; color: rgba(255,255,255,0.9);">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
            <div class="card" style="background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; cursor: pointer; transition: all 0.3s ease; animation: fadeInUp 0.6s ease-out 0.1s both;" onmouseover="this.style.transform='translateY(-5px) scale(1.02)'" onmouseout="this.style.transform='translateY(0) scale(1)'">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 style="font-size: 0.875rem; color: rgba(255,255,255,0.8); margin-bottom: 0.5rem;">Total Views</h6>
                            <h3 style="font-size: 1.5rem; font-weight: 700; margin: 0; color: white;">
                                @if(Auth::user()->isAdmin())
                                    {{ \App\Models\Publication::sum('views') }}
                                @else
                                    {{ Auth::user()->publications->sum('views') }}
                                @endif
                            </h3>
                        </div>
                        <div style="font-size: 2rem; color: rgba(255,255,255,0.9);">
                            <i class="fas fa-eye"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
            <div class="card" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white; border: none; cursor: pointer; transition: all 0.3s ease; animation: fadeInUp 0.6s ease-out 0.2s both;" onmouseover="this.style.transform='translateY(-5px) scale(1.02)'" onmouseout="this.style.transform='translateY(0) scale(1)'">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 style="font-size: 0.875rem; color: rgba(255,255,255,0.8); margin-bottom: 0.5rem;">Total Downloads</h6>
                            <h3 style="font-size: 1.5rem; font-weight: 700; margin: 0; color: white;">
                                @if(Auth::user()->isAdmin())
                                    {{ \App\Models\Publication::sum('downloads') }}
                                @else
                                    {{ Auth::user()->publications->sum('downloads') }}
                                @endif
                            </h3>
                        </div>
                        <div style="font-size: 2rem; color: rgba(255,255,255,0.9);">
                            <i class="fas fa-download"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @if(Auth::user()->isAdmin())
            <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
                <div class="card" style="background: linear-gradient(135deg, #6366f1, #4f46e5); color: white; border: none; cursor: pointer; transition: all 0.3s ease; animation: fadeInUp 0.6s ease-out 0.3s both;" onmouseover="this.style.transform='translateY(-5px) scale(1.02)'" onmouseout="this.style.transform='translateY(0) scale(1)'">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 style="font-size: 0.875rem; color: rgba(255,255,255,0.8); margin-bottom: 0.5rem;">Total Users</h6>
                                <h3 style="font-size: 1.5rem; font-weight: 700; margin: 0; color: white;">
                                    {{ \App\Models\User::count() }}
                                </h3>
                            </div>
                            <div style="font-size: 2rem; color: rgba(255,255,255,0.9);">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
                <div class="card" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; border: none; cursor: pointer; transition: all 0.3s ease; animation: fadeInUp 0.6s ease-out 0.3s both;" onmouseover="this.style.transform='translateY(-5px) scale(1.02)'" onmouseout="this.style.transform='translateY(0) scale(1)'">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 style="font-size: 0.875rem; color: rgba(255,255,255,0.8); margin-bottom: 0.5rem;">Role</h6>
                                <h3 style="font-size: 1.5rem; font-weight: 700; margin: 0; text-transform: capitalize; color: white;">
                                    {{ Auth::user()->role->name }}
                                </h3>
                            </div>
                            <div style="font-size: 2rem; color: rgba(255,255,255,0.9);">
                                @if(Auth::user()->isAdmin())
                                    <i class="fas fa-user-shield"></i>
                                @elseif(Auth::user()->isPublisher())
                                    <i class="fas fa-user-edit"></i>
                                @else
                                    <i class="fas fa-user"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="row">
        <!-- Recent Publications -->
        <div class="col-12 col-lg-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Publications</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 40%; text-align: left;">Title</th>
                                    <th style="width: 15%; text-align: center;">Type</th>
                                    <th style="width: 15%; text-align: center;">Status</th>
                                    <th style="width: 10%; text-align: center;">Views</th>
                                    <th style="width: 20%; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(Auth::user()->isAdmin())
                                    @foreach(\App\Models\Publication::latest()->take(5)->get() as $publication)
                                        <tr>
                                            <td style="text-align: left; vertical-align: middle;">
                                                <a href="{{ route('publications.show', $publication->id) }}" style="color: #1f2937; text-decoration: none; font-weight: 500;">
                                                    {{ \Illuminate\Support\Str::limit($publication->title, 45) }}
                                                </a>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <span style="font-size: 0.875rem;">{{ ucfirst($publication->publication_type) }}</span>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                @if($publication->status == 'published')
                                                    <span class="badge badge-success">Published</span>
                                                @elseif($publication->status == 'draft')
                                                    <span class="badge badge-secondary">Draft</span>
                                                @else
                                                    <span class="badge badge-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td style="text-align: center; vertical-align: middle; font-weight: 600;">{{ $publication->views }}</td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <div class="action-buttons" style="display: flex !important; justify-content: center !important; align-items: center !important; width: 100%;">
                                                    <a href="{{ route('publications.show', $publication->id) }}" class="btn btn-sm btn-outline-primary action-btn" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    @foreach(Auth::user()->publications()->latest()->take(5)->get() as $publication)
                                        <tr>
                                            <td style="text-align: left; vertical-align: middle;">
                                                <a href="{{ route('publications.show', $publication->id) }}" style="color: #1f2937; text-decoration: none; font-weight: 500;">
                                                    {{ \Illuminate\Support\Str::limit($publication->title, 45) }}
                                                </a>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <span style="font-size: 0.875rem;">{{ ucfirst($publication->publication_type) }}</span>
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                @if($publication->status == 'published')
                                                    <span class="badge badge-success">Published</span>
                                                @elseif($publication->status == 'draft')
                                                    <span class="badge badge-secondary">Draft</span>
                                                @else
                                                    <span class="badge badge-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td style="text-align: center; vertical-align: middle; font-weight: 600;">{{ $publication->views }}</td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <div class="action-buttons" style="display: flex !important; justify-content: center !important; align-items: center !important; width: 100%;">
                                                    <a href="{{ route('publications.show', $publication->id) }}" class="btn btn-sm btn-outline-primary action-btn" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                
                                @if((Auth::user()->isAdmin() && \App\Models\Publication::count() == 0) || 
                                    (!Auth::user()->isAdmin() && Auth::user()->publications->count() == 0))
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <p style="color: #6b7280; margin-bottom: 1rem;">No publications found.</p>
                                            <a href="{{ route('publications.create') }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-plus mr-1"></i> Create Publication
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('publications.index') }}" class="btn btn-sm btn-outline-primary">
                        View All Publications
                    </a>
                </div>
            </div>
        </div>

        <!-- User Profile & Quick Links -->
        <div class="col-12 col-lg-4">
            <!-- User Profile -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Profile</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div style="width: 80px; height: 80px; background-color: #3b82f6; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <h5 style="margin-top: 1rem; margin-bottom: 0.25rem; font-weight: 600;">{{ Auth::user()->name }}</h5>
                        <p style="color: #6b7280; margin-bottom: 0.5rem;">{{ Auth::user()->email }}</p>
                        <span class="badge badge-primary" style="text-transform: capitalize;">{{ Auth::user()->role->name }}</span>
                    </div>
                    
                    <div style="border-top: 1px solid #e5e7eb; padding-top: 1rem;">
                        @if(Auth::user()->institution)
                            <div class="mb-2">
                                <strong style="color: #4b5563;">Institution:</strong>
                                <span>{{ Auth::user()->institution }}</span>
                            </div>
                        @endif
                        
                        @if(Auth::user()->bio)
                            <div class="mb-2">
                                <strong style="color: #4b5563;">Bio:</strong>
                                <p style="margin-top: 0.25rem; margin-bottom: 0;">{{ Auth::user()->bio }}</p>
                            </div>
                        @endif
                        
                        <div class="mt-3">
                            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-primary btn-block">
                                <i class="fas fa-user-edit mr-1"></i> Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quick Links</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('publications.create') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-plus-circle mr-3" style="font-size: 1.25rem; color: #3b82f6;"></i>
                            <div>
                                <h6 style="margin: 0; font-weight: 600;">Create Publication</h6>
                                <small style="color: #6b7280;">Share your research with the world</small>
                            </div>
                        </a>
                        <a href="{{ route('search') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-search mr-3" style="font-size: 1.25rem; color: #10b981;"></i>
                            <div>
                                <h6 style="margin: 0; font-weight: 600;">Search Publications</h6>
                                <small style="color: #6b7280;">Find relevant research</small>
                            </div>
                        </a>
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="fas fa-users-cog mr-3" style="font-size: 1.25rem; color: #6366f1;"></i>
                                <div>
                                    <h6 style="margin: 0; font-weight: 600;">Manage Users</h6>
                                    <small style="color: #6b7280;">View and manage user accounts</small>
                                </div>
                            </a>
                            <a href="{{ route('users.create') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="fas fa-user-plus mr-3" style="font-size: 1.25rem; color: #ef4444;"></i>
                                <div>
                                    <h6 style="margin: 0; font-weight: 600;">Create User</h6>
                                    <small style="color: #6b7280;">Add new user to system</small>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .list-group-item:hover {
            background-color: #f8fafc !important;
            transform: translateX(5px);
            transition: all 0.3s ease;
        }
        .table tbody tr:hover {
            background-color: #f8fafc !important;
            transform: scale(1.01);
            transition: all 0.2s ease;
        }
    </style>
</x-modern-layout>