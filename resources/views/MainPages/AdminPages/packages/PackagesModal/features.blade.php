<!-- Modal -->
<div class="modal fade" id="features-{{$package->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> Features </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (isset($package->features))
                @foreach ($package->features as $features )
                {{$features->feature}} / <a href="{{route('DeleteFeature', ['id' => $features->id])}}" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>
            </a>
                <br>
                <br>
                @endforeach
                @endif
            </div>
            <form method="POST" action="{{ route('AddFeatures', ['id' => $package->id]) }}">
                @csrf
                @method('Post')
                <div style="margin: 10px" class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Add Features</label>
                    <input type="text" class="form-control" name="features"value="{{ old('features') }}" id="exampleInputName" aria-describedby="emailHelp">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
