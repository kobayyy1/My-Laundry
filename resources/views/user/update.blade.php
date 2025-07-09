{{-- @extends('pages.layouts.panel') --}}
@include('pages.layouts.style')
@section('head')
    <title>Profile</title>
@endsection

{{-- @section('body') --}}
<div class="pt-5 pb-5">
    <div class="container pt-5 pb-5">
        <h2 class="fw-bold text-primary mb-4">Profil Saya</h2>
        <div class="row">
            <!-- Kolom Avatar -->
            <div class="col-12 col-md-4 text-center mb-4">
                <img id="avatarPreview"
                    src="/images/avatar/{{ $user->avatar}}"
                    class="img-fluid rounded-circle shadow mb-3" style="width: 180px; height: 180px; object-fit: cover;">

                <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data" class="w-100">
                    @csrf
                    @method('PUT')
                    <input type="file" name="avatar" id="avatarInput" class="form-control mb-2" accept="image/*">
                    <button class="btn btn-outline-primary btn-sm w-100">Ubah Foto</button>
                </form>
            </div>

            <!-- Kolom Form Update Profil -->
            <div class="col-12 col-md-8">
                <form action="{{ route('profile.update.post') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Username</label>
                        <input type="text" name="username" value="{{ $user->username }}" class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis Kelamin</label>
                        <select name="gender" class="form-select" required>
                            <option value="M" @selected($user->gender == 'M')>Laki-laki</option>
                            <option value="F" @selected($user->gender == 'F')>Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal Lahir</label>
                        <input type="date" name="born" value="{{ $user->born }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nomor Telepon</label>
                        <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat</label>
                        <input type="text" name="country" value="{{ $user->country }}" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3 px-4">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- @endsection --}}

@section('script')
    <script>
        document.getElementById('avatarInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarPreview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
