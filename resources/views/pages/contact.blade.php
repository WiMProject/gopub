<x-modern-layout>
    <x-slot name="header">
        Contact Us
    </x-slot>
    
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <!-- Header Section -->
            <div class="card mb-5" style="background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; animation: fadeInUp 0.6s ease-out;">
                <div class="card-body p-5 text-center">
                    <div style="font-size: 4rem; margin-bottom: 1rem;">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem; color: white;">Get in Touch</h1>
                    <p style="font-size: 1.125rem; color: rgba(255,255,255,0.9); max-width: 600px; margin: 0 auto;">
                        Have questions, suggestions, or need support? We'd love to hear from you!
                    </p>
                </div>
            </div>
            
            <div class="row">
                <!-- Contact Form -->
                <div class="col-12 col-lg-8 mb-5">
                    <div class="card" style="animation: slideInLeft 0.8s ease-out;">
                        <div class="card-header">
                            <h2 style="font-size: 1.5rem; font-weight: 700; margin: 0; color: #1f2937;">Send us a Message</h2>
                        </div>
                        <div class="card-body p-4">
                            <form>
                                <div class="row mb-4">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                            <div style="position: relative;">
                                                <span style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); z-index: 10; color: #10b981;">
                                                    <i class="fas fa-user"></i>
                                                </span>
                                                <input type="text" id="name" name="name" required
                                                    class="form-control" style="padding-left: 2.5rem; border: 2px solid #e5e7eb; transition: all 0.3s ease;"
                                                    onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16, 185, 129, 0.1)'"
                                                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                                                    placeholder="Enter your full name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                            <div style="position: relative;">
                                                <span style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); z-index: 10; color: #10b981;">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                                <input type="email" id="email" name="email" required
                                                    class="form-control" style="padding-left: 2.5rem; border: 2px solid #e5e7eb; transition: all 0.3s ease;"
                                                    onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16, 185, 129, 0.1)'"
                                                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                                                    placeholder="Enter your email address">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                    <div style="position: relative;">
                                        <span style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); z-index: 10; color: #10b981;">
                                            <i class="fas fa-tag"></i>
                                        </span>
                                        <select id="subject" name="subject" required
                                            class="form-control" style="padding-left: 2.5rem; border: 2px solid #e5e7eb; transition: all 0.3s ease;"
                                            onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16, 185, 129, 0.1)'"
                                            onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'">
                                            <option value="">Select a subject</option>
                                            <option value="general">General Inquiry</option>
                                            <option value="support">Technical Support</option>
                                            <option value="bug">Bug Report</option>
                                            <option value="feature">Feature Request</option>
                                            <option value="partnership">Partnership</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                    <textarea id="message" name="message" rows="6" required
                                        class="form-control" style="border: 2px solid #e5e7eb; transition: all 0.3s ease;"
                                        onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16, 185, 129, 0.1)'"
                                        onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                                        placeholder="Tell us how we can help you..."></textarea>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-lg" style="background: linear-gradient(135deg, #10b981, #059669); border: none; padding: 12px 32px; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(16, 185, 129, 0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(16, 185, 129, 0.3)'">
                                        <i class="fas fa-paper-plane mr-2"></i> Send Message
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Information -->
                <div class="col-12 col-lg-4">
                    <div class="card mb-4" style="animation: slideInRight 0.8s ease-out;">
                        <div class="card-header" style="background: linear-gradient(135deg, #f8fafc, #e2e8f0);">
                            <h3 style="font-size: 1.25rem; font-weight: 700; margin: 0; color: #1f2937;">Contact Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #3b82f6, #1d4ed8); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                                        <i class="fas fa-envelope" style="color: white;"></i>
                                    </div>
                                    <div>
                                        <h4 style="font-size: 1rem; font-weight: 600; margin: 0; color: #1f2937;">Email</h4>
                                        <p style="margin: 0; color: #6b7280; font-size: 0.875rem;">support@gopub.com</p>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                                        <i class="fas fa-clock" style="color: white;"></i>
                                    </div>
                                    <div>
                                        <h4 style="font-size: 1rem; font-weight: 600; margin: 0; color: #1f2937;">Response Time</h4>
                                        <p style="margin: 0; color: #6b7280; font-size: 0.875rem;">Within 24 hours</p>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center">
                                    <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                                        <i class="fas fa-user" style="color: white;"></i>
                                    </div>
                                    <div>
                                        <h4 style="font-size: 1rem; font-weight: 600; margin: 0; color: #1f2937;">Developer</h4>
                                        <p style="margin: 0; color: #6b7280; font-size: 0.875rem;">Wildan Miladji (WIM)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- FAQ Section -->
                    <div class="card" style="animation: slideInRight 0.8s ease-out 0.2s both;">
                        <div class="card-header" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: white;">
                            <h3 style="font-size: 1.25rem; font-weight: 700; margin: 0; color: white;">Quick Help</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h4 style="font-size: 1rem; font-weight: 600; margin-bottom: 0.5rem; color: #1f2937;">
                                    <i class="fas fa-question-circle" style="color: #f59e0b; margin-right: 0.5rem;"></i>
                                    How to publish?
                                </h4>
                                <p style="color: #6b7280; font-size: 0.875rem; margin: 0;">
                                    Go to Publications → Create Publication and fill in the required information.
                                </p>
                            </div>
                            
                            <div class="mb-3">
                                <h4 style="font-size: 1rem; font-weight: 600; margin-bottom: 0.5rem; color: #1f2937;">
                                    <i class="fas fa-search" style="color: #10b981; margin-right: 0.5rem;"></i>
                                    How to search?
                                </h4>
                                <p style="color: #6b7280; font-size: 0.875rem; margin: 0;">
                                    Use the search page with filters by type, author, or keywords.
                                </p>
                            </div>
                            
                            <div class="mb-3">
                                <h4 style="font-size: 1rem; font-weight: 600; margin-bottom: 0.5rem; color: #1f2937;">
                                    <i class="fas fa-user-cog" style="color: #3b82f6; margin-right: 0.5rem;"></i>
                                    Account issues?
                                </h4>
                                <p style="color: #6b7280; font-size: 0.875rem; margin: 0;">
                                    Contact us with your account details and we'll help you resolve any issues.
                                </p>
                            </div>
                            
                            <div class="text-center mt-4">
                                <a href="{{ route('about') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-info-circle mr-1"></i> Learn More
                                </a>
                            </div>
                        </div>
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
    </style>
</x-modern-layout>