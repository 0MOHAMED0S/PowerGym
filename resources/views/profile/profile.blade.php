<x-app-layout>
    @section('style')
        <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
        <style>
            #statusAlert {
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 10px 20px;
                border-radius: 5px;
                background-color: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
                z-index: 9999;
            }
        </style>
    @endsection
    @include('layouts.sidebar.sidebar')
    <div style="height: 80px">
    </div>
    <div class="profile-container">
        <div class="profile-image">
            @if (isset(auth()->user()->image->path))
                <img id="profile-img" src="{{ asset('storage/' . auth()->user()->image->path) }}" alt="Profile Image">
            @else
                <center>
                    <i class="fa-solid fa-dumbbell" style="color: rgb(19, 225, 0);font-size:50px"></i>
                </center>
            @endif
        </div>
        <div style="color: white" class="info-item">
            <center>
                {{ auth()->user()->email }}
            </center>
        </div>
        <div style="color: rgb(255, 255, 255)" class="info-item">
            <center>
                {{ auth()->user()->phone }}
            </center>
        </div>
        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6"
            enctype="multipart/form-data">
            @csrf
            @method('patch')
            @if (session('status'))
                <div id="statusAlert" class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="profile-info">
                <div class="info-item">
                    <span>Name</span>
                    <input value="{{ auth()->user()->name }}" name="name" type="text" id="name">
                    <x-input-error style="color: red" :messages="$errors->get('name')" />
                </div>
                <div class="info-item">
                    <span>Change Profile Image</span>
                    <input type="file" id="new-profile-img" name="path" accept="image/*">
                    <x-input-error style="color: red" :messages="$errors->get('path')" />
                </div>
                <button type="submit">Update</button>
            </div>
        </form>
        <br>
        <br>
        <button onclick="toggleQRCode()"> QR Code</button>
        <br>
        <div class="info-item2" id="qrCodeDiv" style="display:none;">
            <br>
            <div id="qrcode">
                <center>
                    {{ $qrCode }}
                </center>
            </div>
        </div>

        <br>
        @if (auth()->user()->subscriber)
        <div style="margin: 10px;color:rgb(0, 255, 72);" class="info-item">
            <span>Package Name</span>
                {{ auth()->user()->subscriber->package->name }}
        </div>
        <div style="margin: 10px;color:rgb(0, 255, 72);" class="info-item">
            <span>Started At</span>
                {{ auth()->user()->subscriber->created_at }}
        </div>
        <div style="margin: 10px;color:rgb(0, 255, 72);" class="info-item">
            <span>End At</span>
                {{ auth()->user()->subscriber->end_at }}
        </div>
        @endif
        {{-- <div class="info-item">
            <button >Update Password</button>
        </div> --}}
    </div>
    @section('script')
        <script>
            function toggleQRCode() {
                var qrCodeDiv = document.getElementById("qrCodeDiv");
                if (qrCodeDiv.style.display === "none") {
                    qrCodeDiv.style.display = "block";
                } else {
                    qrCodeDiv.style.display = "none";
                }
            }
        </script>
        <script>
            // Remove alert after 5 seconds
            setTimeout(function() {
                document.getElementById('statusAlert').style.display = 'none';
            }, 5000);
        </script>
    @endsection
</x-app-layout>
