<div class="modal" id="questionModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pažnja!</h5>
                <button type="button" class="close -no" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="question">Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger -yes">Obriši</button>
                <button type="button" class="btn btn-secondary -no" data-dismiss="modal">Zatvori</button>
            </div>
        </div>
    </div>
</div>

<style>
#questionModal{
    background: rgba(0,0,0,0.375);
}
#questionModal .modal-dialog{
    margin-top: 10%;
}
</style>