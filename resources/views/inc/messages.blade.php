<style>
.card-alert .-card{
    max-width: 20rem;
}
.-close{
    position: absolute;
    top: 10px;
    right: 15px;
    color: #fff;
}
</style>

<div class="card-alert">

    @if($errors->any())
        <div class="-card card text-white bg-danger mb-3">
            <span class="-close close">x</span>
            <div class="card-body">
                <h5 class="card-title">Greška</h5>
                @foreach($errors->all() as $error)
                    <p class="card-text">{{$error}}</p>
                @endforeach
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="-card card text-white bg-success mb-3">
            <span class="-close close">x</span>
            <div class="card-body">
                <h5 class="card-title">Uspešno</h5>
                <p class="card-text">{{session('success')}}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="-card card text-white bg-danger mb-3">
            <span class="-close close">x</span>
            <div class="card-body">
                <h5 class="card-title">Greška</h5>
                <p class="card-text">{{session('error')}}</p>
            </div>
        </div>
    @endif

    @if (session('status'))
        <div class="-card card text-white bg-dark mb-3">
            <span class="-close close">x</span>
            <div class="card-body">
                <h5 class="card-title">Status</h5>
                <p class="card-text">{{session('status')}}</p>
            </div>
        </div>
    @endif


    @if (session('info'))
        <div class="-card card text-white bg-info mb-3">
            <span class="-close close">x</span>
            <div class="card-body">
                <h5 class="card-title">Informacija</h5>
                <p class="card-text">{{session('info')}}</p>
            </div>
        </div>
    @endif

</div>