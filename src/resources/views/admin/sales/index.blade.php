@extends('admin.layouts.default')

@section('title', 'Ventas')

@section('content')
	<div class="col-md-9">
    <div class="row">

      <div class="col-md-12">
      <form class="form-inline" role="search">
					<span>Filtrar entre</span>
          <div class="input-group">
            <input type="date" name="initialDate" class="form-control" value="" />
          </div>
					y
          <div class="input-group">
            <input type="date" name="finalDate" class="form-control" value="" />
          </div>
          <button type="submit" class="btn btn-default">Filtrar</button>
        </form>
      </div>

    </div>
    <div class="row">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Ventas</th>
            <th>Fecha</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($mySales as $ms)
            <tr>
              <td>{{$ms->title}}</td>
              <td>
                 {{date('d-m-Y',strtotime($ms->date))}}
              </td>
              <td
                <div class="text-right">
                  <a class="btn btn-default" href="{{route('articles.show', ['id' => $ms->article_id])}}" role="button">Ver</a>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@overwrite
