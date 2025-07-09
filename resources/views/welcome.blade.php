<x-modern-layout>
    <!-- Hero Section -->
    <section class="mb-5" style="animation: fadeInUp 0.8s ease-out;">
        <div class="row">
            <div class="col-12 col-md-6 d-flex flex-column justify-content-center">
                <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1.5rem; color: #1f2937; animation: slideInLeft 0.8s ease-out;">
                    Discover and Share Academic Publications
                </h1>
                <p style="font-size: 1.125rem; color: #4b5563; margin-bottom: 2rem;">
                    GoPub is a platform for publishing, discovering, and managing academic content. Share your research with the world and find relevant publications in your field.
                </p>
                <div class="d-flex" style="animation: slideInLeft 1s ease-out 0.3s both;">
                    <a href="{{ route('search') }}" class="btn btn-primary mr-3" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); border: none; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3); transform: translateY(0); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(59, 130, 246, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(59, 130, 246, 0.3)'">
                        <i class="fas fa-search mr-1"></i> Browse Publications
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-outline-primary" style="border: 2px solid #3b82f6; color: #3b82f6; font-weight: 600; transform: translateY(0); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.backgroundColor='#3b82f6'; this.style.color='white'" onmouseout="this.style.transform='translateY(0)'; this.style.backgroundColor='transparent'; this.style.color='#3b82f6'">
                            <i class="fas fa-user-plus mr-1"></i> Join Now
                        </a>
                    @else
                        <a href="{{ route('publications.create') }}" class="btn btn-outline-primary" style="border: 2px solid #3b82f6; color: #3b82f6; font-weight: 600; transform: translateY(0); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.backgroundColor='#3b82f6'; this.style.color='white'" onmouseout="this.style.transform='translateY(0)'; this.style.backgroundColor='transparent'; this.style.color='#3b82f6'">
                            <i class="fas fa-plus mr-1"></i> Create Publication
                        </a>
                    @endguest
                </div>
            </div>
            <div class="col-12 col-md-6 mt-4 mt-md-0">
                <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80" 
                     alt="Library with books" 
                     style="width: 100%; height: 400px; object-fit: cover; border-radius: 12px; box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1); animation: slideInRight 0.8s ease-out; transition: transform 0.3s ease;" 
                     onmouseover="this.style.transform='scale(1.02)'" 
                     onmouseout="this.style.transform='scale(1)'">
            </div>
        </div>
    </section>
    
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
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .card:hover {
            transform: translateY(-5px) !important;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
        }
    </style>

    <!-- Features Section -->
    <section class="mb-5">
        <div class="text-center mb-4">
            <h2 style="font-size: 1.875rem; font-weight: 700; color: #1f2937;">Features</h2>
            <p style="color: #6b7280; max-width: 600px; margin: 0 auto;">
                Everything you need for academic publishing and research discovery in one place.
            </p>
        </div>
        
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div style="font-size: 2rem; color: #3b82f6; margin-bottom: 1rem;">
                            <i class="fas fa-upload"></i>
                        </div>
                        <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.75rem;">Publish Your Work</h3>
                        <p style="color: #6b7280;">
                            Share your research papers, journals, articles, and academic work with the world.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div style="font-size: 2rem; color: #3b82f6; margin-bottom: 1rem;">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.75rem;">Advanced Search</h3>
                        <p style="color: #6b7280;">
                            Find relevant publications with our powerful search engine and filtering options.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div style="font-size: 2rem; color: #3b82f6; margin-bottom: 1rem;">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.75rem;">User Management</h3>
                        <p style="color: #6b7280;">
                            Different roles for administrators, publishers, and regular users with appropriate permissions.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div style="font-size: 2rem; color: #3b82f6; margin-bottom: 1rem;">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.75rem;">Analytics</h3>
                        <p style="color: #6b7280;">
                            Track views and downloads of your publications to measure their impact.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Publications Section -->
    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin: 0;">Recent Publications</h2>
            <a href="{{ route('search') }}" class="btn btn-sm btn-outline-primary">View All</a>
        </div>
        
        <div class="row">
            @foreach(\App\Models\Publication::where('status', 'published')->latest()->take(4)->get() as $publication)
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge badge-primary">{{ ucfirst($publication->publication_type) }}</span>
                                <small style="color: #6b7280;">{{ $publication->created_at->format('M d, Y') }}</small>
                            </div>
                            <h3 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 0.5rem;">
                                <a href="{{ route('publications.show', $publication->id) }}" style="color: #1f2937; text-decoration: none; hover: { color: #3b82f6; }">
                                    {{ \Illuminate\Support\Str::limit($publication->title, 50) }}
                                </a>
                            </h3>
                            <p style="color: #6b7280; font-size: 0.875rem; margin-bottom: 0.5rem;">
                                By: {{ \Illuminate\Support\Str::limit($publication->authors, 30) }}
                            </p>
                            <p style="color: #4b5563; font-size: 0.875rem; margin-bottom: 1rem; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ \Illuminate\Support\Str::limit($publication->abstract, 100) }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div style="font-size: 0.75rem; color: #6b7280;">
                                    <i class="fas fa-eye mr-1"></i> {{ $publication->views }}
                                    <i class="fas fa-download ml-2 mr-1"></i> {{ $publication->downloads }}
                                </div>
                                <a href="{{ route('publications.show', $publication->id) }}" class="btn btn-sm btn-outline-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- CTA Section -->
    <section>
        <div class="card bg-primary text-white">
            <div class="card-body p-4 text-center">
                <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem;">Ready to Get Started?</h2>
                <p style="margin-bottom: 1.5rem; max-width: 600px; margin-left: auto; margin-right: auto;">
                    Join our community of researchers, academics, and knowledge seekers. Publish your work and discover new insights.
                </p>
                <div>
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-light text-primary mr-2">
                            <i class="fas fa-user-plus mr-1"></i> Register Now
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light">
                            <i class="fas fa-sign-in-alt mr-1"></i> Login
                        </a>
                    @else
                        <a href="{{ route('publications.create') }}" class="btn btn-light text-primary">
                            <i class="fas fa-plus mr-1"></i> Create Publication
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </section>
</x-modern-layout>