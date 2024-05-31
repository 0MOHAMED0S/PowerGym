@if (count($packages) > 0)
<hr>
<br>
    <!--  Subscribe Section -->
    <section>
        <center>
            <h4 class="bebas-neue-regular" style="color: #13ff00;"> Our Pricing</h4>
            <h2 class="bebas-neue-regular"> Our Sprcial Monthly <i class="fa-solid fa-calendar-days"
                    style="color: #13ff00;"></i></h2>
            <h2 class="bebas-neue-regular">Traning Package <i class="fa-solid fa-bicycle" style="color: #13ff00;"></i>
            </h2>
        </center>
        <div class="container2">
            <div class="card_section">
            @foreach ($packages as $package )
            <div class="card">
                <div class="card_head">
                    <h2 class="bebas-neue-regular">{{$package->name}}</h2>
                    <h2 id="gray" class="bebas-neue-regular">$ {{$package->price}}</h2>
                </div>
                <div class="card_body">
                    @if (isset($package->features))
                    @foreach ($package->features as $features )
                    <div class="features">
                        <i class="fa-solid fa-star fa-lg" style="color: #13ff00;"></i>
                        <h2 class="nanum-gothic-regular">{{$features->feature}}</h2>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div>
                    <form action="{{ route('paypal',['id'=>$package->id]) }}" method="post">
                        @csrf
                        <center>
                            <button type="submit" class="Subscripe">Subscribe</button>
                        </center>
                        </form>
                </div>
            </div>

            @endforeach
            </div>
        </div>
        <br><br><br><br>
        @if (isset($allpackages) && count($allpackages)>3)
        <center>
            <a href="{{route('Packages')}}" class="see_more">See More <i class="fa-solid fa-arrow-right"></i></a>
        </center>
        @endif
    </section>

@endif
