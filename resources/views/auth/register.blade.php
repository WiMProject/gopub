<x-modern-layout>
    <div class="row justify-content-center" style="min-height: calc(100vh - 120px); align-items: center;">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-lg" style="animation: slideUp 0.6s ease-out; border: none; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px);">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);">
                            <i class="fas fa-user-plus" style="font-size: 2rem; color: white;"></i>
                        </div>
                        <h1 style="font-size: 1.75rem; font-weight: 700; color: #1f2937; margin-bottom: 0.5rem;">Create Account</h1>
                        <p style="color: #6b7280;">Join our community of researchers</p>
                    </div>
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <div class="form-group">
                            <label for="name" class="form-label">Full Name</label>
                            <div style="position: relative;">
                                <span style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); z-index: 10; color: #10b981;">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                    class="form-control" style="padding-left: 2.5rem; border: 2px solid #e5e7eb; transition: all 0.3s ease;"
                                    onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16, 185, 129, 0.1)'"
                                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'">
                            </div>
                            @error('name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <div style="position: relative;">
                                <span style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); z-index: 10; color: #10b981;">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                    class="form-control" style="padding-left: 2.5rem; border: 2px solid #e5e7eb; transition: all 0.3s ease;"
                                    onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16, 185, 129, 0.1)'"
                                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'">
                            </div>
                            @error('email')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <div style="position: relative;">
                                <span style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); z-index: 10; color: #10b981;">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input id="password" type="password" name="password" required
                                    class="form-control" style="padding-left: 2.5rem; border: 2px solid #e5e7eb; transition: all 0.3s ease;"
                                    onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16, 185, 129, 0.1)'"
                                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'">
                            </div>
                            @error('password')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <div style="position: relative;">
                                <span style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); z-index: 10; color: #10b981;">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input id="password_confirmation" type="password" name="password_confirmation" required
                                    class="form-control" style="padding-left: 2.5rem; border: 2px solid #e5e7eb; transition: all 0.3s ease;"
                                    onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16, 185, 129, 0.1)'"
                                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block" style="background: linear-gradient(135deg, #10b981, #059669); border: none; padding: 12px; font-weight: 600; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);">
                                <i class="fas fa-user-plus mr-1"></i> Create Account
                            </button>
                        </div>
                    </form>
                    
                    <div class="text-center mt-4">
                        <p style="color: #6b7280;">Already have an account? <a href="{{ route('login') }}" style="color: #10b981; font-weight: 600;">Sign in here</a></p>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('home') }}" style="color: #6b7280; font-size: 0.875rem; transition: color 0.2s;" onmouseover="this.style.color='#10b981'" onmouseout="this.style.color='#6b7280'">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
    
    <style>
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .btn-block {
            width: 100%;
        }
    </style>
</x-modern-layout>