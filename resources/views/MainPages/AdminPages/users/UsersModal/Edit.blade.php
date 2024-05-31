<div class="modal fade" id="Edit-{{ $user->id }}" tabindex="-1" aria-labelledby="Edit-{{ $user->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('UpdateUser', ['id' => $user->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name"
                            value="{{ old('name', $user->name) }}" id="exampleInputName"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">email</label>
                        <input type="text" class="form-control" name="email"
                            value="{{ old('email', $user->email) }}" id="exampleInputPassword1">
                    </div>
                    <div class="login-input-container">
                        <label for="phone_number"> phone</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" placeholder="Enter your phone number"  />
                    </div>
                @foreach ($roles as $role)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" value="{{ $role->name }}"
                            id="role_{{ $role->id }}" {{ $user->role == $role->name ? 'checked' : '' }}>
                        <label class="form-check-label" for="role_{{ $role->id }}">
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach
                <div class="mb-3">
                    <label for="validationCustom01" class="form-label">Image</label>
                    <input id="imageInput-{{$user->id}}" name="path" type="file" class="form-control" aria-label="file example" accept="image/*">
                    <br>
                    @if ($user->image && $user->image->path)
                        <img id="defaultImage-{{$user->id}}" src="{{ asset('storage/'.$user->image->path) }}" alt="User Image">
                    @endif
                    <div class="invalid-feedback">Example invalid form file feedback</div>
                    <center>
                        <div id="selectedImages-{{$user->id}}"></div>
                    </center>
                </div>

                <script>
                    document.getElementById('imageInput-{{$user->id}}').addEventListener('change', function (event) {
                        const selectedImagesContainer = document.getElementById('selectedImages-{{$user->id}}');
                        selectedImagesContainer.innerHTML = '';

                        // Hide the default image when a new file is selected
                        const defaultImage = document.getElementById('defaultImage-{{$user->id}}');
                        if (defaultImage) {
                            defaultImage.style.display = 'none';
                        }

                        const files = event.target.files;

                        for (const file of files) {
                            const imgElement = document.createElement('img');
                            imgElement.src = URL.createObjectURL(file);
                            imgElement.alt = 'Selected Image';
                            selectedImagesContainer.appendChild(imgElement);
                        }
                    });
                </script>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
