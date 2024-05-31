<div class="modal fade" id="Edit-{{ $package->id }}" tabindex="-1" aria-labelledby="Edit-{{ $package->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Packages</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('UpdatePackage', ['id' => $package->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name"
                            value="{{ old('name', $package->name) }}" id="exampleInputName"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price"
                            value="{{ old('price', $package->price) }}" id="exampleInputPassword1">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="1"
                            id="flexRadioDefault1" {{ $package->status == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="0"
                            id="flexRadioDefault2" {{ $package->status == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Not Active
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
