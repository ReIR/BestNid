@extends('admin.layouts.default')

@section('title', 'Ventas')

@section('content')
	<div class="col-md-9">
    <div class="row">

      <div class="col-md-12">
      <form class="form-inline" role="search">
					<span>Filtrar entre</span>
          <div class="input-group">
            <input type="date" name="initialDate" class="form-control" value="{{Request::get('initialDate')}}" />
          </div>
					y
          <div class="input-group">
            <input type="date" name="finalDate" class="form-control" value="{{Request::get('finalDate')}}" />
          </div>
          <button type="submit" class="btn btn-default">Filtrar</button>
        </form>
      </div>

    </div>
    <div class="row">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Articulo</th>
            <th>Fecha de Publicación</th>
            <th>Fecha de Finalización</th>
            <th>Fecha de Venta</th>
						<th>Monto</th>
						<th>Ganancia</th>
          </tr>
        </thead>
        <tbody>
					<?php
						$ganancias = 0;
						$montos = 0;
					?>
          @foreach ($mySales as $sale)
            <tr>
              <td>{{$sale->article->getTitle(30)}}</td>
              <td>
                 {{date('d/m/Y',strtotime($sale->article->created_at))}}
              </td>
							<td>
                 {{date('d/m/Y',strtotime($sale->article->endDate))}}
              </td>
							<td>
                 {{date('d/m/Y',strtotime($sale->created_at))}}
              </td>
							<td>
								<?php
									$amount = $sale->offer->amount;
									$montos += $amount;
								?>
                 {{'$'.$amount}}
              </td>
							<td>
								<?php
									$income = $sale->getIncome();
									$ganancias += $income;
								?>
                {{'$'.$income}}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@overwrite

@if (\App\User::currentUserIsAdmin())
	@section('sidebar')
		@parent
		<div class="panel panel-default text-center col-md-8" id="sales">
		  <div class="panel-body" id="sales-badge">
				<span class="label label-default">Total de ventas: {{'$'.$montos}}</span>
				<span class="label label-success">Ganancias: {{'$'.$ganancias}}</span>
		  </div>
		</div>
	@stop
@endif
