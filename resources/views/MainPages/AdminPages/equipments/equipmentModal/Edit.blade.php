<div class="modal fade" id="Edit-{{ $equipment->id }}" tabindex="-1" aria-labelledby="Edit-{{ $equipment->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Equipment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('UpdateEquipments', ['id' => $equipment->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label"> Name</label>
                        <input type="text" class="form-control" name="name"
                            value="{{ old('name', $equipment->name) }}" id="exampleInputName"
                            aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Quantity</label>
                        <input type="text" class="form-control" name="quantity"
                            value="{{ old('quantity', $equipment->quantity) }}" id="exampleInputName"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="validationCustom01" class="form-label">Image</label>
                        <input id="imageInput-{{$equipment->id}}" name="path" type="file" class="form-control" aria-label="file example" accept="image/*" >
                        <br>
                        <img id="defaultImage-{{$equipment->id}}" src="{{ asset('storage/'.$equipment->path) }}" alt="">
                        <div class="invalid-feedback">Example invalid form file feedback</div>
                        <center>
                            <div id="selectedImages-{{$equipment->id}}"></div>
                        </center>
                    </div>

                    <script>
                        document.getElementById('imageInput-{{$equipment->id}}').addEventListener('change', function (event) {
                            const selectedImagesContainer = document.getElementById('selectedImages-{{$equipment->id}}');
                            selectedImagesContainer.innerHTML = '';

                            // Hide the default image when a new file is selected
                            document.getElementById('defaultImage-{{$equipment->id}}').style.display = 'none';

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
