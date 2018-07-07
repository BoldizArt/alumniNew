<div class="share-buttons">
    <button data-toggle="tooltip" data-placement="left" title="Stari alumni sajt" onclick="window.open('http://www.tfzr.uns.ac.rs/alumni/', '_blank')" type="button" class="btn btn-success">
        <i class="fas fa-folder-open"></i>
    </button>
    <button data-toggle="tooltip" data-placement="left" title="Spisak studenata u PDF formatu" onclick="window.open('{{ asset('documents/Postdiplomci.pdf') }}', '_blank')" type="button" class="btn btn-info">
        <i class="fas fa-cloud-download-alt"></i>
    </button>
    {{-- <button data-toggle="tooltip" data-placement="left" title="Podelite Alumni sajt sa prijateljima" onclick="window.location.href='{{ route('public.contact') }}'" type="button" class="btn btn-info">
        <i class="fas fa-share-alt"></i>
    </button> --}}
    <button data-toggle="tooltip" data-placement="left" title="Kontaktirjte nas" onclick="window.location.href='{{ route('public.contact') }}'" type="button" class="btn btn-danger" href="/test">
        <i class="fas fa-envelope"></i>
    </button>
    <button data-toggle="tooltip" data-placement="left" title="Studirali ste kod nas? Kreirajte svoj profil." onclick="window.location.href='{{ route('user.show') }}'" type="button" class="btn btn-warning" href="/test">
        <i class="fas fa-pencil-alt"></i>
    </button>
    <button type="button" class="btn btn-danger active">
        <i class="fas fa-bars"></i>
    </button>
</div>