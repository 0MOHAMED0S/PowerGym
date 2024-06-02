<!-- Modal -->
<div class="modal fade" id="products-{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> Orders </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                @foreach ($order->products as $orderItem)
                    id:{{ $orderItem->product->id }}
                    <br>
                    <img width="100" height="100" src="{{asset('storage/'.$orderItem->product->path)}}" alt="">
                    <br>
                   Name: {{ $orderItem->product->name }}
                    <br>
                   Quantity: {{ $orderItem->product->quantity }}
                   <br>
                  Total: {{ $orderItem->total_price }}
                    <hr style="width: auto">
                @endforeach

            </div>
        </div>
    </div>
</div>
