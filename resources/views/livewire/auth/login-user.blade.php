<div>
    <div class="login-container">
        <div class="login-head">
            <div class="text-start">
                <h2>LOGIN</h2>
                <p class="mb-0">Welcome in login form</p>
            </div>
        </div>
        <div class="login-body">
            <form wire:submit.prevent="login">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                        wire:model='email' wire:target='login' wire:loading.class="disabled placeholder">
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                        wire:model='password' wire:target='login' wire:loading.class="disabled placeholder">
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    <div>
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Lupa Password?</a>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary form-control mb-3"
                    wire:target='login' wire:loading.class="disabled placeholder">LOGIN</button>
            </form>

            {{-- Tombol login dengan Gmail --}}
            <div class="mb-4 text-center">
                <a href="#" class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center" style="gap: 10px;">
                    <img src="{{ url('/images/icons/google.png') }}" alt="google" style="width: 20px; height: 20px;">
                    <span>Login with Gmail</span>
                </a>
            </div>

            <div class="text-center">
                <p class="mb-0">Don't have an account?</p>
                <a href="{{ route('signup') }}" class="text-decoration-none">SIGNUP</a>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('errorLogin', () => {
            Swal.fire({
                title: "LOGIN",
                text: "Email atau password salah!",
                icon: "info",
                showConfirmButton: false,
                timer: 2500
            });
        });
    </script>
</div>
