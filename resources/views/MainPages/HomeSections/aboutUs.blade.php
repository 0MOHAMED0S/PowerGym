    <!--  About Us Section-->
    <section>
        <div class="about">
            <div class="one">
                <div class="oo">
                    <img src="{{ asset('Files/images/AboutUs/138f43c3-93f6-4653-aa78-5b7c4c549971.jpg') }}"
                        style="width: 300px;height: 200px;margin: 20px;border-radius: 5px;">
                    <img src="{{ asset('Files/images/AboutUs/7e430418-6cd8-4dcd-919c-290dcabb31ff.jpg') }}"
                        class="three">
                </div>
                <div class="ooo">
                    <img src="{{ asset('Files/images/AboutUs/7e4e0b2d-cba2-461b-aba7-2e3204ba614f.jpg') }}"
                        class="two">
                </div>
            </div>
            <div class="text">
                <h3 class="bebas-neue-regular"> <i class="fa-solid fa-dumbbell" style="color: rgb(255, 255, 255);"></i>
                    About US </h3>
                <br>
                <br>
                <h1 class="bebas-neue-regular">Welcome <span>TO</span> {{ $LogoName->firstname }} <span>{{ $LogoName->secondname }}</span></h1>
                <p>At {{ $LogoName->firstname }} {{$LogoName->secondname}} , we believe that fitness is not just physical strength;<br> it's about nurturing a community, achieving personal goals,<br> and embracing a healthier lifestyle. <br> Since our inception, we've been dedicated to providing <br> a dynamic and inclusive environment where individuals of all fitness levels can thrive.</p>

                <center class="about_icons">
                    <div class="circle">
                        <i class="fa-solid fa-medal  fa-xl"></i>
                    </div>
                    <div class="circle">
                        <i class="fa-solid fa-bicycle fa-xl"></i>
                    </div>
                    <div class="circle">
                        <i class="fa-solid fa-stopwatch-20 fa-xl"></i>
                    </div>
                    <div class="circle">
                        <i class="fa-solid fa-cart-shopping fa-xl"></i>
                    </div>
                    <div class="circle">
                        <i class="fa-solid fa-arrow-trend-up fa-xl"></i>
                    </div>
                </center>
            </div>
        </div>
    </section>
