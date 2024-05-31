<div class="modal fade" id="Edit-{{ $product->id }}" tabindex="-1" aria-labelledby="Edit-{{ $product->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Equipment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('UpdateProduct', ['id' => $product->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label"> Name</label>
                        <input type="text" class="form-control" name="name"
                            value="{{ old('name', $product->name) }}" id="exampleInputName"
                            aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity"
                            value="{{ old('quantity', $product->quantity) }}" id="exampleInputName"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price"
                            value="{{ old('price', $product->price) }}" id="exampleInputName"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">New Price</label>
                        <input type="number" class="form-control" name="newprice"
                            value="{{ old('newprice', $product->newprice) }}" id="exampleInputName"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ old('description', $product->description) }}</textarea>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="1"
                            id="flexRadioDefault1" {{ $product->status == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Active
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="0"
                            id="flexRadioDefault2" {{ $product->status == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Not Active
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="validationCustom01" class="form-label">Image</label>
                        <input id="imageInput-{{$product->id}}" name="path" type="file" class="form-control" aria-label="file example" accept="image/*" >
                        <br>
                        <img id="defaultImage-{{$product->id}}" src="{{ asset('storage/'.$product->path) }}" alt="">
                        <div class="invalid-feedback">Example invalid form file feedback</div>
                        <center>
                            <div id="selectedImages-{{$product->id}}"></div>
                        </center>
                    </div>

                    <script>
                        document.getElementById('imageInput-{{$product->id}}').addEventListener('change', function (event) {
                            const selectedImagesContainer = document.getElementById('selectedImages-{{$product->id}}');
                            selectedImagesContainer.innerHTML = '';

                            // Hide the default image when a new file is selected
                            document.getElementById('defaultImage-{{$product->id}}').style.display = 'none';

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
