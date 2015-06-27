@extends('admin.layouts.default')

@section('title', 'Ventas')

@section('content')
	<div class="col-md-9">
    <div class="row">

      <div class="col-md-12">
      <form class="form-inline" role="search">
          <div class="input-group">
            <label for="initialDate">Fecha inicial</label>
            <input type="date" name="initialDate" class="form-control" value="" />
          </div>
          <div class="input-group">
            <label for="finalDate">Fecha final</label>
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
                {{$ms->date}}
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
