@if (session('success'))
    <div class="alert alert-success alert-dismissible mb-4 d-flex align-items-center" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <div class="fw-semibold">
            {{ session('success') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning alert-dismissible mb-4 d-flex align-items-center" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <div class="fw-semibold">
            {{ session('warning') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible mb-4 d-flex align-items-center" role="alert">
        <i class="fas fa-times-circle me-2"></i>
        <div class="fw-semibold">
            {{ session('error') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
