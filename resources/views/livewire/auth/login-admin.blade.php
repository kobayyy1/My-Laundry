<div>
    <div class="login-container">
        <div class="login-head">
            <div class="text-start">
                <h2>LOGIN</h2>
                <p class="mb-0">Wellcome in login form</p>
            </div>
        </div>
        <div class="login-body">
            <form>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        wire:model='email' wire:target='login' wire:loading.class="disabled placeholder">
                    @error('email')
                        <span class="invalid-feedback text-capitalize">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"  id="password"
                        wire:model='password' wire:target='login' wire:loading.class="disabled placeholder">
                    @error('password')
                        <span class="invalid-feedback text-capitalize">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-4 d-flex align-items-center justify-content-between">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                    </div>
                    <div>
                        <a href="#" class="text-decoration-none">Lupa Password?</a>
                    </div>
                </div>
                <button type="button" class="btn btn-primary form-control mb-4" wire:click='login' wire:target='login' wire:loading.class="disabled placeholder">LOGIN</button>
            </form>
        </div>
    </div>


    <script>
        window.addEventListener('errorLogin', () => {
            Swal.fire({
                title: "LOGIN",
                text: "Your email and password failed!",
                icon: "info",
                showConfirmButton: false,
                timer: 2500
            });
        })
    </script>
</div>
