<!-- Modal -->
<div class="modal fade" id="mail-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Pošalji poruku.</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div class="mail-modal">    
                {!! Form::open(['route' => 'send.mail', 'method' => 'POST']) !!}

                    <div class="form-group">
                        {{Form::label('tema', 'Tema')}}
                        {{Form::text('tema', '', ['class' => 'form-control', 'placeholder' => 'Tema poruke', 'required' => 'required'])}}
                    </div>

                    <div class="form-group">
                        {{Form::label('poruka', 'Poruka')}}
                        {{Form::textarea('poruka', '', ['class' => 'form-control', 'placeholder' => 'Vaša poruka', 'required' => 'required'])}}
                        <small class="form-text text-muted">Molimo Vas poštujte Alumni pravila.</small>
                    </div>

                    {{Form::hidden('pid', $pid ?? 0 )}}
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {{Form::submit('Pošalji', ['class' => 'btn btn-primary float-right'])}}

          {!! Form::close() !!}
        </div>
      </div>
    </div>
</div>