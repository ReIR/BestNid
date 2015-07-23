@extends('layouts.default')

@section('title', 'Editar oferta')

@section('notifications')@overwrite

@section('content')
<div class="col-md-12">
  <h3 class="text-center">Editar oferta del producto: {{$article->title}}.</h3>

  <div class="col-sm-4">
    <div class="image-container col-md-6 col-md-offset-3">
      {{-- <div class="col-md-4 col-lg-offset-2"> --}}
      <img src="{{$article->getImageURL()}}" class="img-responsive">
      {{-- </div> --}}
    </div>	{{-- End of Image column --}}
  </div>
  <div class="col-sm-8 form-container" style="margin-top:0px">
    <div class="col-md-10">
      <div class="panel panel-default">
      <div class="panel-heading text-center">Oferta</div>
          <div class="panel-body">
            @if(Session::has('success'))
    					<div class="row">
    						@include('partials.notifications')
    					</div>
    				@endif

         {!! Form::open(array('route' => array('admin.offer.update', $offer->id), 'method' => 'PATCH')) !!}
         {!! Form::hidden('id', $offer->id)!!}

          <?php $error = Session::has('errors') && Session::get('errors')->get('text'); ?>
          <div class="form-group {{$error ? 'has-error' : ''}}">
            <label for="reason">Razón</label>
            <textarea class="form-control" type="text" name="text" id="#reason">{{$offer->text}}</textarea>
            @if($error)
              <span class="text-danger">
                {{Session::get('errors')->get('text')[0]}}
              </span>
            @endif
          </div>

          <?php $error = Session::has('errors') && Session::get('errors')->get('amount'); ?>
          <div class="form-group {{$error ? 'has-error' : ''}}">
            <label for="amount">Monto</label>
            <input value="{{$offer->amount}}" class="form-control" type="float" name="amount" id="#amount"/>
            @if($error)
              <span class="text-danger">
                {{Session::get('errors')->get('amount')[0]}}
              </span>
            @endif
          </div>

          <?php $error = Session::has('errors') && Session::get('errors')->get('card'); ?>
          <div class="form-group {{$error ? 'has-error' : ''}}">
            <label for="card">Número de tarjeta</label>
            <input value="{{$offer->card}}" class="form-control" type="numeric" name="card" id="#card" />
            @if($error)
              <span class="text-danger">
                {{Session::get('errors')->get('card')[0]}}
              </span>
            @endif
          </div>

            <?php $error = Session::has('errors') && Session::get('errors')->get('contact'); ?>
          <div class="form-group {{$error ? 'has-error' : ''}}">
            <label for="contact">Teléfono de contacto</label>
            <input value="{{$offer->contact}}" class="form-control" type="numeric" name="contact" id="contact" />
            @if($error)
              <span class="text-danger">
                {{Session::get('errors')->get('contact')[0]}}
              </span>
            @endif
          </div>

          {!! Form::submit('Aceptar', array('class' => 'btn btn-success')) !!}
          <a class="btn btn-danger" href="{{URL::previous()}}">Cancelar</a>
        {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
</div>

@overwrite
