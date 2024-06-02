<div class="modal fade" id="Edit-{{ $order->id }}" tabindex="-1" aria-labelledby="Edit-{{ $order->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Orders</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('UpdateOrder', ['id' => $order->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="pending"
                            id="flexRadioDefault1" {{ $order->status == 'pending' ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Pending
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="inreview"
                            id="flexRadioDefault1" {{ $order->status == 'inreview' ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexRadioDefault1">
                            In Review
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="completed"
                            id="flexRadioDefault2" {{ $order->status == 'completed' ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Completed
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="canceled"
                            id="flexRadioDefault2" {{ $order->status == 'canceled' ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Canceled
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
