<!-- Modal -->
<div class="modal fade" id="reset-{{$subscriber->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">RE SET User SUB </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  method="POST" action="{{route('reset', ['id' => $subscriber->id])}}">
                @csrf
                @method('POST')
                    <div class="start">
                    <center><h5>ARE YOU SURE RE SET SUP FOR  <span style="color: #00ff22;">{{$subscriber->name}}</span> ?</h5></center>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
