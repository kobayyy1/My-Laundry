<div>
    <div class="mb-3">
        <label for="#" class="form-label">Upload Display Product</label>
        <label for="photos" class="border rounded ratio ratio-4x3 bs-secondary-bg-rgb"
            style="cursor: pointer; background-color: #e9ecef">
            @if ($photos)
                <div for="photos" class="border rounded ratio ratio-4x3 image-upload"
                    style="background-image: url('{{ $photos->temporaryUrl() }}')">
                </div>
            @elseif($post)
                <div for="photos" class="border rounded ratio ratio-4x3 image-upload"
                    style="background-image: url('/images/product/{{ $post }}')">
                </div>
            @else
                <div class="d-flex flex-column align-self-center align-items-center justify-content-center">
                    <i class="fas fa-upload fa-3x fa-fw mb-3"></i>
                    <span class="fw-light">Upload Here...</span>
                </div>
            @endif
            <div class="justify-content-center align-items-center" style="background-color: #e9ecef75;"
                wire:loading.flex wire:target="photos">
                <span class="loader"></span>
            </div>
        </label>
    </div>
    <div class="mb-3">
        <input type="file" id="photos" wire:model="photos" name="image"
            class="form-control @error('image') is-invalid @enderror" placeholder="Upload Photoss here...">
        @error('image')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
