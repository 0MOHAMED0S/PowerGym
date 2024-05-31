@if (isset($coaches) && count($coaches) > 0)
    @foreach ($coaches as $coach)
        @if (isset($coach->image->path))
            <br id="coach">
            <hr>
            <br>
            <!-- coaches Section-->
            <div class="custom-container">
                <div id="coaches_body">
                    <section class="sl-container">
                        <div class="sli-title">
                            <h1 class="bebas-neue-regular">power <span class="bebas-neue-regular">coaches</span><i
                                    style="margin-left: 10px;" class="fa-solid fa-users"></i></h1>
                        </div>
                        <div class="sli-content">
                            <div class="sli-con-ul">
                                <ul class="sli-list" style="justify-content: center;">
                                    @foreach ($coaches as $coache)
                                        @if (isset($coache->image->path))
                                            <li class="item-card">
                                                <div class="cont-card">
                                                    <div class="cont-img">
                                                        <img src="{{ asset('storage/' . $coache->image->path) }}"
                                                            alt="" />
                                                    </div>
                                                    <div class="cont-title">
                                                        <h4>{{ $coache->name }}</h4>
                                                        <p>Fitness Instructor</p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="cor-rev-next">
                                <span id="next" class="next">
                                    <i class="fa-duotone fa-chevron-right"></i>
                                </span>
                                <span id="prev" class="rever">
                                    <i class="fa-duotone fa-chevron-left"></i>
                                </span>
                            </div>
                            <div id="indicators" class="indicators"></div>
                        </div>
                    </section>
                </div>
            </div>
        @break
    @endif
@endforeach
@endif
