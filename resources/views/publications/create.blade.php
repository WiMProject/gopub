<x-modern-layout>
    <x-slot name="header">
        Create Publication
    </x-slot>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('publications.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row mb-4">
                    <div class="col-12 col-lg-8">
                        <div class="form-group">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                class="form-control" placeholder="Enter publication title">
                            @error('title')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-12 col-lg-4">
                        <div class="form-group">
                            <label for="publication_type" class="form-label">Publication Type <span class="text-danger">*</span></label>
                            <select name="publication_type" id="publication_type" required class="form-control">
                                <option value="jurnal" {{ old('publication_type') == 'jurnal' ? 'selected' : '' }}>Journal</option>
                                <option value="karya ilmiah" {{ old('publication_type') == 'karya ilmiah' ? 'selected' : '' }}>Scientific Work</option>
                                <option value="artikel" {{ old('publication_type') == 'artikel' ? 'selected' : '' }}>Article</option>
                                <option value="makalah" {{ old('publication_type') == 'makalah' ? 'selected' : '' }}>Paper</option>
                                <option value="skripsi" {{ old('publication_type') == 'skripsi' ? 'selected' : '' }}>Thesis</option>
                                <option value="tesis" {{ old('publication_type') == 'tesis' ? 'selected' : '' }}>Master's Thesis</option>
                                <option value="disertasi" {{ old('publication_type') == 'disertasi' ? 'selected' : '' }}>Dissertation</option>
                            </select>
                            @error('publication_type')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group mb-4">
                    <label for="authors" class="form-label">Authors <span class="text-danger">*</span></label>
                    <input type="text" name="authors" id="authors" value="{{ old('authors') }}" required
                        class="form-control" placeholder="Enter authors (comma separated)">
                    <div class="form-text">Enter author names separated by commas (e.g., John Doe, Jane Smith)</div>
                    @error('authors')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mb-4">
                    <label for="keywords" class="form-label">Keywords</label>
                    <input type="text" name="keywords" id="keywords" value="{{ old('keywords') }}"
                        class="form-control" placeholder="Enter keywords (comma separated)">
                    <div class="form-text">Enter keywords separated by commas (e.g., science, research, technology)</div>
                    @error('keywords')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mb-4">
                    <label for="abstract" class="form-label">Abstract <span class="text-danger">*</span></label>
                    <textarea name="abstract" id="abstract" rows="4" required
                        class="form-control" placeholder="Enter publication abstract">{{ old('abstract') }}</textarea>
                    @error('abstract')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mb-4">
                    <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                    <textarea name="content" id="content" rows="10" required
                        class="form-control" placeholder="Enter publication content">{{ old('content') }}</textarea>
                    @error('content')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mb-4">
                    <label for="file" class="form-label">File (PDF, DOC, DOCX)</label>
                    <div class="card p-3" style="background-color: #f9fafb;">
                        <div class="text-center">
                            <i class="fas fa-file-upload" style="font-size: 2rem; color: #6b7280; margin-bottom: 1rem;"></i>
                            <p style="margin-bottom: 1rem;">File upload is temporarily disabled.</p>
                            <!-- <input type="file" name="file" id="file" class="form-control"> -->
                        </div>
                    </div>
                    @error('file')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('publications.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Create Publication
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-modern-layout>