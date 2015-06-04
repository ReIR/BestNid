<!-- Modal -->
<div class="modal fade" id="myModal-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{$id}}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title text-danger" id="modalLabel{{$id}}">Atención</h4>
      </div>
      <div class="modal-body">
        {{$msg}}
      </div>
      <div class="modal-footer">
        {!! Form::open(array('route' => ['admin.categories.destroy', $id], 'method' => 'DELETE')) !!}
            {!! Form::submit('Borrar', array('class' => 'btn btn-danger')) !!}
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
