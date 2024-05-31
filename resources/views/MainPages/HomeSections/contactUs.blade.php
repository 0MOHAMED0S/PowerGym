    <!--Contact Us Section-->
    <section id="con_section">
        <center>
            <h1 style="color:#13ff00;" class="bebas-neue-regular"><i class="bi bi-envelope-check"></i>Contact With Us
            </h1>
        </center>
        <div class="marg">
            <iframe src="{{ $contact->location }}" frameborder="0" allowfullscreen loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="half">
                <div class="con_card">
                    @if ($contact->daysopen != null)
                        <div class="inf">
                            <div><i class="bi bi-geo-alt"></i></div>
                            <div class="start_s">
                                <h4>OPEN DAYS:</h4>
                                <p>{{ $contact->daysopen }}</p>
                            </div>
                        </div>
                    @endif
                    @if ($contact->timeopen != null)
                        <div class="inf">
                            <div><i class="bi bi-geo-alt"></i></div>
                            <div class="start_s">
                                <h4>OPEN TIME:</h4>
                                <p>{{ $contact->timeopen }}</p>
                            </div>
                        </div>
                    @endif
                    @if ($contact->email != null)
                        <div class="inf">
                            <div><i class="bi bi-envelope"></i></div>
                            <div class="start_s">
                                <h4>EMAIL:</h4>
                                <p>{{ $contact->email }}</p>
                            </div>
                        </div>
                    @endif
                    @if ($contact->phone != null)
                        <div class="inf">
                            <div><i class="bi bi-telephone"></i></div>
                            <div class="start_s">
                                <h4>Call:</h4>
                                <p>0{{ $contact->phone }}</p>
                            </div>
                        </div>
                    @endif
                </div>
                <form class="card2" action="https://api.web3forms.com/submit" method="POST">
                    <input type="hidden" name="access_key" value="b3ad8481-ec5d-4180-b5c8-d34084032a70">
                    <div class="row1">
                        <div class="start_s">
                            <label for="username">Your Name</label>
                            <input type="text" name="name" required>
                        </div>
                        <div class="start_s">
                            <label for="email">Your Email</label>
                            <input type="email" name="email" required>
                        </div>
                    </div>
                    <div class="row2">
                        <label for="message">Message</label>
                        <textarea class="form-control" name="message" rows="5" required></textarea>
                    </div>
                    <br>
                    <center><button type="submit">Send Message</button></center>
                </form>
            </div>
        </div>
        @php
            $allNull =
                $contact->facebooklink == null &&
                $contact->whatsapp == null &&
                $contact->xlink == null &&
                $contact->instgramlink == null;
        @endphp

        @if (!$allNull)
            <center class="social">
                @if ($contact->facebooklink != null)
                    <a href="{{ $contact->facebooklink }}"><i class="bi bi-facebook"></i></a>
                @endif
                @if ($contact->whatsapp != null)
                    <a href="https://wa.me/+20{{ $contact->whatsapp }}" target="_blank"><i
                            class="bi bi-whatsapp"></i></a>
                @endif
                @if ($contact->xlink != null)
                    <a href="{{ $contact->xlink }}"><i class="bi bi-twitter-x"></i></a>
                @endif
                @if ($contact->instgramlink != null)
                    <a href="{{ $contact->instgramlink }}"><i class="bi bi-instagram"></i></a>
                @endif
            </center>
        @endif

    </section>
