<div class="py-4">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if ($message = Session::get('success'))
            <div id="msg_btn" class="bg-green-300 py-5 pl-4 rounded-lg approach">
                <strong>{{ $message }}</strong>
                <div class="float-right cursor-pointer px-8 font-bold" onclick="closeMeassage()">X</div>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div id="msg_btn" class="bg-red-300 py-5 pl-4 rounded-lg approach">
                <strong>{{ $message }}</strong>
                <div class="float-right cursor-pointer px-8 font-bold" onclick="closeMeassage()">X</div>
            </div>
        @endif

        {{-- @if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif --}}

        {{-- @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Please check the form below for errors</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif --}}
    </div>
</div>


<style>
    .disClose {
        display: none;
    }

    .approach {
        animation: gradually-show 2s;
    }

    @keyframes gradually-show {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

</style>

<script>
    function closeMeassage() {
        document.getElementById("msg_btn").classList.add("disClose");
    }
</script>
