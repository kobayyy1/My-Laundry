<div>
    <div class="container mt-4 mb-4">
        <div class="card-container">
            <div class="header-section">
                <div class="header-title">Order Product</div>
                <div class="header-subtitle">Selamat datang kembali di aplikasi laundryku</div>
            </div>

            <div class="table-container">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                    <div class="d-flex gap-2">
                        @if (count($selected) > 0)
                            <button class="btn btn-danger rounded-pill px-4" data-bs-toggle="modal"
                                data-bs-target="#ModalDeleteAllData">
                                <i class="fas fa-trash me-2"></i> Hapus Terpilih ({{ count($selected) }})
                            </button>
                        @endif
                    </div>

                    <div class="d-flex gap-2 align-items-center">
                        <div class="input-group search-box" style="width: 250px;">
                            <input type="text" class="form-control border-0 bg-transparent"
                                wire:model.live.debounce.500ms="search" placeholder="Cari invoice atau customer...">
                            <span class="input-group-text bg-transparent border-0">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>

                        <div class="dropdown">
                            <button class="btn btn-primary-outline rounded-pill px-3" data-bs-toggle="dropdown">
                                <i class="fas fa-sliders-h me-2"></i> Filter
                            </button>
                            <div class="dropdown-menu dropdown-menu-end p-3 border-0 shadow">
                                <div class="mb-3">
                                    <label class="form-label small text-muted mb-1">Status</label>
                                    <select class="form-select form-select-sm" wire:model.live="status">
                                        <option value="">Semua Status</option>
                                        <option value="pending">Pending</option>
                                        <option value="progress">Progress</option>
                                        <option value="cancelled">Cancelled</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label small text-muted mb-1">Jumlah Tampilan</label>
                                    <select class="form-select form-select-sm" wire:model.live="pages">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th style="width: 40px;">
                                    <input type="checkbox" wire:model="selectedAll" wire:change="clickSelected"
                                        class="form-check-input">
                                </th>
                                <th>NO</th>
                                <th>Invoice</th>
                                <th>Pelanggan</th>
                                <th>Tanggal</th>
                                <th>Berat (KG)</th>
                                <th>Harga/KG</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th style="width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $index => $item)
                                <tr>
                                    <td>
                                        <input type="checkbox" wire:model="selected" wire:change="clickSelectedOne"
                                            class="form-check-input" value="{{ $item->orders_id }}">
                                    </td>
                                    <td>{{ $orders->firstItem() + $index }}</td>
                                    <td>{{ $item->invoice }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                    <td>{{ $item->weight }}</td>
                                    <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $statusMap = [
                                                'waiting' => 'Menunggu',
                                                'process' => 'Diproses',
                                                'onpayment_waiting' => 'Menunggu Pembayaran',
                                                'ready' => 'Siap Dikirim',
                                                'finish' => 'Selesai',
                                                'cancel' => 'Dibatalkan',
                                            ];

                                            $statusClass = match ($item->status) {
                                                'waiting' => 'status-pending',
                                                'process' => 'status-progress',
                                                'onpayment_waiting' => 'status-cancelled',
                                                'ready', 'finish' => 'status-completed',
                                                'cancel' => 'status-cancelled',
                                                default => 'status-secondary',
                                            };

                                            $statusText = $statusMap[$item->status] ?? ucfirst($item->status);
                                        @endphp

                                        <span class="status-label {{ $statusClass }}">
                                            {{ $statusText }}
                                        </span>

                                    </td>
                                    <td>Rp{{ number_format($item->grand_total, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-primary rounded-circle p-2" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end border-0 shadow"
                                                style="min-width: 220px;">
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="{{ route('admin.orders.detail', $item->orders_id) }}">
                                                    <i class="fas fa-eye text-primary me-3"></i> <span>Detail</span>
                                                </a>
                                                <a class="dropdown-item d-flex align-items-center"
                                                    href="{{ route('admin.orders.update', $item->orders_id) }}">
                                                    <i class="fas fa-pencil-alt text-warning me-3"></i> <span>Edit
                                                        Data</span>
                                                </a>
                                                <button class="dropdown-item d-flex align-items-center"
                                                    onclick="downloadInvoice({{ $item->orders_id }})">
                                                    <i class="fas fa-download text-success me-3"></i> <span>Download
                                                        Invoice</span>
                                                </button>
                                                <div class="dropdown-divider"></div>
                                                <button class="dropdown-item text-danger d-flex align-items-center"
                                                    wire:click="DeleteAction({{ $item->orders_id }})">
                                                    <i class="fas fa-trash me-3"></i> <span>Delete Data</span>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-search fa-2x mb-2"></i>
                                            <p>Tidak ada data yang ditemukan</p>
                                            @if ($search)
                                                <small>Hasil pencarian untuk: "{{ $search }}"</small>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($orders->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted small">
                            Menampilkan {{ $orders->firstItem() }} - {{ $orders->lastItem() }} dari
                            {{ $orders->total() }} item
                        </div>
                        <div>
                            @if ($orders->hasPages())
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination mb-0">
                                        @if ($orders->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#">
                                                    <i class="fas fa-angle-double-left fa-xs fa-fw"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="#" wire:click="previousPage"
                                                    wire:loading.attr="disabled" rel="prev">
                                                    <i class="fas fa-angle-double-left fa-xs fa-fw"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                                            @if ($page == $orders->currentPage())
                                                <li class="page-item active">
                                                    <a class="page-link" href="#">
                                                        <span aria-hidden="true">{{ $page }}</span>
                                                    </a>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link" href="#"
                                                        wire:click="gotoPage({{ $page }})">
                                                        <span aria-hidden="true">{{ $page }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach

                                        @if ($orders->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="#" wire:click="nextPage"
                                                    wire:loading.attr="disabled">
                                                    <i class="fas fa-angle-double-right fa-xs fa-fw"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#">
                                                    <i class="fas fa-angle-double-right fa-xs fa-fw"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="ModalDeleteAllData" wire:ignore.self tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-center w-100">
                        <i class="fas fa-exclamation-circle text-warning me-2"></i>Konfirmasi Penghapusan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0">
                    <p>Anda akan menghapus {{ count($selected) }} data yang dipilih. Pastikan Anda memperhatikan hal
                        berikut:</p>
                    <div class="alert alert-warning">
                        <ol class="mb-0 ps-3">
                            <li>Data yang terhapus tidak dapat dikembalikan</li>
                            <li>Sebaiknya backup data sebelum menghapus</li>
                            <li>Tim developer tidak bertanggung jawab atas kehilangan data</li>
                        </ol>
                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" id="checkTrued" wire:model.live="syarat">
                        <label class="form-check-label" for="checkTrued">
                            Saya memahami konsekuensinya dan setuju untuk melanjutkan
                        </label>
                    </div>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger rounded-pill px-4" wire:click="DeleteActionAll"
                        @if ($syarat == false) disabled @endif>
                        <i class="fas fa-trash me-2"></i>Hapus Permanen
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function downloadInvoice(orderId) {
        // Show loading indicator
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Generating PDF...';
        button.disabled = true;

        // Create download link
        const link = document.createElement('a');
        link.href = `/admin/orders/${orderId}/download`;
        link.style.display = 'none';
        document.body.appendChild(link);

        // Set timeout to reset button if download takes too long
        const timeout = setTimeout(() => {
            button.innerHTML = originalText;
            button.disabled = false;
            alert('Download timeout. Please try again.');
            if (document.body.contains(link)) {
                document.body.removeChild(link);
            }
        }, 30000); // 30 seconds timeout

        // Handle download
        link.addEventListener('click', () => {
            // Reset button after a short delay
            setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = false;
                clearTimeout(timeout);
            }, 2000);
        });

        // Trigger download
        link.click();

        // Clean up
        setTimeout(() => {
            if (document.body.contains(link)) {
                document.body.removeChild(link);
            }
        }, 3000);
    }
</script>

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
            title: "Error!",
            text: "Your data failed to be deleted.",
            icon: "error",
            showConfirmButton: false,
            timer: 1500
        });
    })
</script>
