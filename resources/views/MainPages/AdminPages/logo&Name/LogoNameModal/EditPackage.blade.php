<div class="modal fade" id="Edit-{{ $ModelsLogoName->id }}" tabindex="-1" aria-labelledby="Edit-{{ $ModelsLogoName->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Packages</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('UpdateLogoName', ['id' => $ModelsLogoName->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="firstname"
                            value="{{ old('firstname', $ModelsLogoName->firstname) }}" id="exampleInputName"
                            aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Second Name</label>
                        <input type="text" class="form-control" name="secondname"
                            value="{{ old('secondname', $ModelsLogoName->secondname) }}" id="exampleInputName"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="validationCustom01" class="form-label">Image</label>
                        <input id="imageInput-{{$ModelsLogoName->id}}" name="path" type="file" class="form-control" aria-label="file example" accept="image/*" >
                        <br>
                        <img id="defaultImage-{{$ModelsLogoName->id}}" src="{{ asset('storage/'.$ModelsLogoName->logopath) }}" alt="">
                        <div class="invalid-feedback">Example invalid form file feedback</div>
                        <center>
                            <div id="selectedImages-{{$ModelsLogoName->id}}"></div>
                        </center>
                    </div>

                    <script>
                        document.getElementById('imageInput-{{$ModelsLogoName->id}}').addEventListener('change', function (event) {
                            const selectedImagesContainer = document.getElementById('selectedImages-{{$ModelsLogoName->id}}');
                            selectedImagesContainer.innerHTML = '';

                            // Hide the default image when a new file is selected
                            document.getElementById('defaultImage-{{$ModelsLogoName->id}}').style.display = 'none';

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
