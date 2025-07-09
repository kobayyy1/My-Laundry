<div>
    <div class="container-fluid">

        <div class="d-block p-3 mb-2">
            <h2 class="text-them fw-bold mb-0">Account</h2>
            <p class="text-them-sec mb-0">Selamat datang kembali di aplikasi laundryku</p>
        </div>

        <div class="d-block bg-white rounded p-3">
            <div class="form-tables mb-3">
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.account.create') }}" class="btn btn-outline-success">
                        <i class="fas fa-plus fa-sm fa-fw"></i>
                    </a>
                    @if ($selected != null)
                        <button class="btn btn-danger px-3" data-bs-toggle="modal"
                            data-bs-target="#ModalDeleteAllData">Delete</button>
                    @endif
                    <div class="ms-auto position-relative">
                        <input type="text" class="form-control me-4" placeholder="Search..." wire:model="search"
                            wire:keydown.enter="searchPush">
                        <button class="btn position-absolute border-0 top-0 end-0">
                            <i class="fas fa-search fa-sm fa-fw"></i>
                        </button>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-filter fa-xs fa-fw"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end shadow border-0 p-0" style="width: 320px">
                            <div class="dropdown-head p-3 border-bottom">
                                <p class="fw-bold mb-0">Filter Table</p>
                            </div>
                            <div class="dropdown-body p-3">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <label for="status" class="form-label">Status type</label>
                                    <select wire:model="status" name="status" class="form-select form-select-sm col-3"
                                        id="status" style="width: 120px">
                                        <option value="pending">PENDING</option>
                                        <option value="progress">PROGRESS</option>
                                        <option value="decline">DECLINE</option>
                                        <option value="done">FINISHED</option>
                                        <option value="" selected>All</option>
                                    </select>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <label for="pages" class="form-label">Page of view</label>
                                    <select wire:model="pages" name="pages" class="form-select form-select-sm col-3"
                                        id="pages" style="width: 72px">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="50">50</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive mb-2">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-wrap">
                                <input type="checkbox" wire:model="selectedAll" wire:change="clickSelected"
                                    class="form-check-input">
                            </th>
                            <th class="text-them"></th>
                            <th class="text-them">Username</th>
                            <th class="text-them">Email</th>
                            <th class="text-them">Status</th>
                            <th class="text-them">Date</th>
                            <th class="text-them"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $item)
                            <tr>
                                <th class="text-wrap">
                                    <input type="checkbox" wire:model="selected" wire:change="clickSelectedOne"
                                        class="form-check-input" value="{{ $item->admin_id }}">
                                </th>
                                <th class="text-them">
                                    <div class="tb-admin-image"
                                        style="background-image: url('/images/admins/{{ $item->avatar }}')">
                                    </div>
                                </th>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @if ($item->is_active == 1)
                                        <span class="badge text-bg-success">Active</span>
                                    @elseif($item->is_active == 0)
                                        <span class="badge text-bg-secondary">Non Active</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->created_at }}
                                </td>
                                <td class="gap-1">
                                    <div class="dropstart">
                                        <button class="btn border-0" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                                        </button>
                                        <div class="dropdown-menu position-fixed border-0 shadow" style="width: 200px">
                                            <a class="dropdown-item link-black"
                                                href="{{ route('admin.profile.detail', ['id' => $item->admin_id]) }}">
                                                <i class="fas fa-eye fa-sm me-3"></i> Detail
                                            </a>
                                            <a class="dropdown-item link-black"
                                                href="{{ route('admin.account.update', ['id' => $item->admin_id]) }}">
                                                <i class="fas fa-pencil-alt fa-sm me-3"></i> Edit Data
                                            </a>
                                            <hr class="soft my-2 mx-2">
                                            <a class="dropdown-item link-secondary" href="">
                                                <i class="fas fa-share fa-sm me-3"></i> Share Link
                                            </a>
                                            <a class="dropdown-item link-secondary" href="">
                                                <i class="fas fa-download fa-sm me-3"></i> Download
                                            </a>
                                            <hr class="soft my-2 mx-2">
                                            @if ($item->admin_id == 1)
                                                <button class="dropdown-item disabled" disabled>
                                                    <i class="fas fa-trash fa-sm me-3"></i> Delete Data
                                                </button>
                                            @else
                                                <button class="dropdown-item "
                                                    wire:click="DeleteAction({{ $item->admin_id }})">
                                                    <i class="fas fa-trash fa-sm me-3"></i> Delete Data
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex">
                <div class="ms-auto">
                    {{ $data->links('livewire.paginations.paginate') }}
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="ModalDeleteAllData" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle fa-4x fa-fw text-warning"></i>
                        <p class="fw-bold">PERHATIAN</p>
                    </div>
                    <p>Kamu akan menghapus semua isi data yang dimana diantara persyaratan data yang akan di
                        delete sebagai berikut:</p>
                    <ol>
                        <li>Semua data akan terhapus</li>
                        <li>Data yang terhapus tidak dapat dikembalikan</li>
                        <li>Anda hanya dapat menyimpan data sebagai archive</li>
                        <li>Sebaiknya ada membackup data seblum dihapus</li>
                        <li>Developer tidak bertanggung jawah atas kehilangan data yang telah terhapus</li>
                    </ol>
                    <p>Jika anda yakin untuk menghapus semua data, pastikan anda mencentang persetujuan dibawah ini</p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkTrued" wire:model.live="syarat">
                        <label class="form-check-label" for="checkTrued">
                            Saya Menyetujuinya
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" wire:click="DeleteActionAll"
                        @if ($syarat == false) disabled @endif>Delete</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        window.addEventListener('deleteModel', () => {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('DeleteActionGo');
                }
            });
        })
        window.addEventListener('deleteModelAll', () => {
            $('#ModalDeleteAllData').modal("hide");
            Swal.fire({
                title: "Deleted!",
                text: "All your data has been deleted.",
                icon: "success",
                showConfirmButton: false,
                timer: 1500
            });
        })
        window.addEventListener('deleteModelSuccess', () => {
            Swal.fire({
                title: "Deleted!",
                text: "Your data has been deleted.",
                icon: "success",
                showConfirmButton: false,
                timer: 1500
            });
        })
        window.addEventListener('deleteModelError', () => {
            Swal.fire({
                title: "Deleted!",
                text: "Your data failed to deleted.",
                icon: "error",
                showConfirmButton: false,
                timer: 1500
            });
        })
    </script>
</div>

