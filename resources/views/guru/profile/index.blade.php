@extends('layouts.main')
@push('css')
    <style>
        .profile-card {
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }
        .avatar-wrapper {
            position: relative;
            transition: all 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem 0;
        }
        .avatar-circle {
            width: 150px;
            height: 150px;
            background: linear-gradient(45deg, #696cff, #8789ff);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            box-shadow: 0 4px 15px rgba(105, 108, 255, 0.3);
            margin: 0 auto;
        }
        .form-control:focus {
            border-color: #696cff;
            box-shadow: 0 0 0 0.2rem rgba(105, 108, 255, 0.25);
        }
        .btn-primary {
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(105, 108, 255, 0.3);
        }
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Guru /</span> Profile
        </h4>

        <div class="row">
            <div class="col-12 col-md-4 mb-4">
                <div class="card profile-card h-100">
                    <div class="card-body">
                        <div class="avatar-wrapper">
                            <div class="avatar-circle">
                                <span style="font-size: 3.5rem;">{{ substr(auth()->user()->username, 0, 2) }}</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <h5 class="card-title mb-1">{{ auth()->user()->username }}</h5>
                            <p class="text-muted">Guru</p>
                            <div class="mt-3">
                                <span class="badge bg-label-primary">Active</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8">
                <div class="card profile-card">
                    <div class="card-header border-bottom">
                        <h5 class="card-title mb-0">
                            <i class="bx bx-cog me-2"></i>
                            Pengaturan Akun
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label for="username" class="form-label">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bx bx-user"></i></span>
                                        <input class="form-control" type="text" id="username" name="username" value="{{ auth()->user()->username }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-12 col-sm-6">
                                    <label for="password" class="form-label">Password Baru</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bx bx-lock"></i></span>
                                        <input class="form-control" type="password" id="password" name="password" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bx bx-lock-alt"></i></span>
                                        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" />
                                    </div>
                                </div>
                            </div>

                            <div class="text-end mt-4">
                                <button type="button" class="btn btn-label-secondary me-2">Batal</button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-save me-1"></i>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.closest('.input-group').style.borderColor = '#696cff';
            });
            input.addEventListener('blur', function() {
                this.closest('.input-group').style.borderColor = '';
            });
        });
    </script>
@endpush
