<x-guest-layout>
    <section class="vh-100 d-flex align-items-center"
    style="background-image: url('{{ asset('images/background.jpeg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="container py-5 h-75">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card shadow-lg border-0" style="border-radius: 1rem; overflow: hidden;">
                        <div class="row g-0 h-100">

                            <div class="col-md-5 d-none d-md-block bg-light">
                                <img src="{{ asset('images/logo-kiri.png') }}"
                                    class="img-fluid h-100 w-100"
                                    style="object-fit: cover; object-position: center;"
                                    alt="Login illustration">
                            </div>

                            <div class="col-md-7 d-flex align-items-center bg-white">
                                <div class="card-body p-4 p-lg-5">

                                    <x-auth-session-status class="mb-3" :status="session('status')" />

                                    <div class="mb-4 text-center text-md-left">
                                        <div class="d-flex align-items-center justify-content-center justify-content-md-start mb-3">
                                            <div class="bg-light p-1 rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                                <img src="{{ asset('images/logo2.jpeg') }}" alt="Logo" class="img-fluid rounded-circle" style="max-height: 100%; object-fit: contain;">
                                            </div>
                                            <div class="ms-3 ml-3">
                                                <h2 class="fw-bold mb-0 h4 text-gray-900">Talenta Siswa</h2>
                                                <small class="text-muted text-uppercase tracking-wider font-weight-bold" style="font-size: 0.7rem;">Sistem Informasi Bakat</small>
                                            </div>
                                        </div>
                                        <p class="text-muted small">Silakan masuk untuk mengelola data dan melihat hasil perankingan.</p>
                                    </div>

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="form-group mb-3">
                                            <label class="form-label font-weight-bold" for="email">Email</label>
                                            <input type="email" id="email" name="email"
                                                value="{{ old('email') }}"
                                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                required autofocus>
                                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label font-weight-bold" for="password">Password</label>
                                            <div class="input-group">
                                                <input type="password" id="password" name="password"
                                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                    required style="border-right: none;">
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-white" style="border-left: none; cursor: pointer;" id="togglePassword">
                                                        <i class="fa fa-eye-slash text-muted" id="eyeIcon"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                                        </div>

                                        <div class="custom-control custom-checkbox mb-4 text-left">
                                            <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                                            <label class="custom-control-label" for="remember_me">Remember me</label>
                                        </div>

                                        <button type="submit" class="btn btn-dark btn-lg btn-block shadow-sm font-weight-bold">
                                            Masuk ke Akun
                                        </button>

                                        <div class="mt-4 d-flex justify-content-between">
                                            @if (Route::has('password.request'))
                                                <a class="small text-muted" href="{{ route('password.request') }}">Lupa password?</a>
                                            @endif
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', function () {
            // Ubah tipe input
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Ubah ikon (menggunakan FontAwesome class)
            if (type === 'text') {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        });
    });
</script>
</x-guest-layout>