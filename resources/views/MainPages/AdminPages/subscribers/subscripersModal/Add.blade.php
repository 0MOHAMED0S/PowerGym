<div class="modal fade" id="Add" tabindex="-1" aria-labelledby="add"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Subscriber</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('StoreSubscribers') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">email</label>
                        <input type="text" class="form-control" name="email"
                            value="{{ old('email')}}" id="exampleInputPassword1">
                    </div>
<center>
    or
</center>
                    <div class="login-input-container">
                        <label for="phone_number"> phone</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" placeholder="Enter your phone number"  />
                    </div>

                @foreach ($packages as $package)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="package_id" value="{{ $package->id }}"
                            id="role_{{ $package->id }}" {{ $package->name == $package->name ? 'checked' : '' }}>
                        <label class="form-check-label" for="role_{{ $package->id }}">
                            {{ $package->name }}
                        </label>
                    </div>
                @endforeach
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
