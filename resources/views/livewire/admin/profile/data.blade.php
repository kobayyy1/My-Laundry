<div>
    <div class="container-fluid mb-3">
        <div class="d-flex align-items-center p-3 bg-white rounded-3 border shadow-sm">
            {{-- <img src="{{ url('/images/admins/' . auth('admins')->user()->avatar) }}" alt="" width="64px" height="64px"> --}}
            <div class="img-profile" style="background-image: url('/images/admins/{{ auth('admins')->user()->avatar}}');"></div>
            <div class="ms-3">
                <p class="fs-4 fw-bold mb-0 text-capitalize">{{ auth('admins')->user()->username }}</p>
                <p class="mb-2">{{ auth('admins')->user()->email }}</p>
            </div>
        </div>
    </div>
    <div class="container-fluid mb-3">
        <div class="d-block bg-white rounded-3 border shadow-sm">
            <div class="d-flex align-items-center py-2 px-3 border-bottom">
                <p class="mb-0 fw-bold text-color">Profile Detail</p>
                <div class="dropstart ms-auto">
                    <button class="btn btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-bars fa-sm fa-fw"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @if($edit == false)
                        <li><button type="button" wire:click='edited' class="dropdown-item">Edit</button></li>
                        @else
                        <li><button type="button" wire:click='save' class="dropdown-item">Simpan Perubahan</button></li>
                        <li><button type="button" wire:click='cancle' class="dropdown-item">Batalkan Perubahan</button></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="p-3">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input wire:model='username' type="text" class="form-control" @if($edit==false) disabled
                                @endif>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input wire:model='email' type="email" id="emial" class="form-control disabled" disabled>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <div class="input-group">
                                <span class="btn border border-right-0" id="basic-addon1">+62</span>
                                <input wire:model='phone' type="text" id="phone" class="form-control"
                                    placeholder="phone" @if($edit==false) disabled @endif>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="born" class="form-label">Born</label>
                            <input wire:model='born' type="date" id="born" class="form-control" @if($edit==false)
                                disabled @endif>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <textarea wire:model='address' name="address" id="address" class="form-control" rows="3"
                        @if($edit==false) disabled @endif></textarea>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('success', event => {
            Swal.fire({
                icon: 'success',
                title: 'Good Jobs!',
                text: event.detail,
            })
        })
        window.addEventListener('erros', event => {
            Swal.fire({
                icon: 'error',
                title: 'Opps...!',
                text: event.detail,
            })
        })
    </script>
</div>