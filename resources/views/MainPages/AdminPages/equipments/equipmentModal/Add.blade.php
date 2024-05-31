<div class="modal fade" id="Add" tabindex="-1" aria-labelledby="Add" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Packages</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('Storeequipment') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                            id="exampleInputName" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" value="{{ old('quantity') }}"
                            id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="validationCustom01" class="form-label">Image</label>
                        <input id="imageInput" name="path" type="file" class="form-control" aria-label="file example" accept="image/*" >
                        <br>
                        <div class="invalid-feedback">Example invalid form file feedback</div>
                        <center>
                            <div id="selectedImages"></div>
                        </center>
                    </div>

                    <script>
                        document.getElementById('imageInput').addEventListener('change', function (event) {
                            const selectedImagesContainer = document.getElementById('selectedImages');
                            selectedImagesContainer.innerHTML = '';

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
