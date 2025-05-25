<div>
    <div class="d-flex align-items-center">
        <small class="fw-bold me-auto">Detail Description</small>
        <button class="btn btn-sm btn-outline-success" type="button" wire:click="addInput">
            <i class="fas fa-plus fa-sm fa-fw"></i>
        </button>
    </div>
    <hr class="soft mb-3">
    
    @foreach($InputText as $index => $item)
        <div class="d-flex gap-2 mb-2">
            <input type="text" wire:model="InputText[]" name="descriptionOther[]" class="form-control" value="{{$item}}" placeholder="List Description...">
            <button class="btn btn-danger" type="button" wire:click="delInput({{$index}})">
                <i class="fas fa-trash fa-xs fa-fw"></i>
            </button>
        </div>
    @endforeach

</div>
