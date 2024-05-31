<div class="modal fade" id="Edit-{{ $contacts->id }}" tabindex="-1" aria-labelledby="Edit-{{ $contacts->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Contacts</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('Updatecontacts', ['id' => $contacts->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Location</label>
                        <input type="text" class="form-control" name="location"
                            value="{{ old('location', $contacts->location) }}" id="exampleInputName"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Phone</label>
                        <input type="number" class="form-control" name="phone"
                            value="{{ old('phone', $contacts->phone) }}" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Whatsapp</label>
                        <input type="number" class="form-control" name="whatsapp"
                        value="{{ old('whatsapp', $contacts->whatsapp) }}" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Facebook</label>
                        <input type="text" class="form-control" name="facebooklink"
                        value="{{ old('facebooklink', $contacts->facebooklink) }}" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Instgram</label>
                        <input type="text" class="form-control" name="instgramlink"
                        value="{{ old('instgramlink', $contacts->instgramlink) }}" id="exampleInputPassword1">
                        </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">X</label>
                        <input type="text" class="form-control" name="xlink"
                        value="{{ old('xlink', $contacts->xlink) }}" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Open Days</label>
                            <input type="text" class="form-control" name="daysopen"
                            value="{{ old('daysopen', $contacts->daysopen) }}" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">OPen Time </label>
                                <input type="text" class="form-control" name="timeopen"
                                value="{{ old('timeopen', $contacts->timeopen) }}" id="exampleInputPassword1">
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
