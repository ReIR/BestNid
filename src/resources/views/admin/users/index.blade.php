@extends('admin.layouts.default')

@section('title', 'Administración')

@section('content')
<div class="col-md-9">
  <div class="row">

    <div class="col-md-12">
    <form class="form-inline" role="search">
        <span>Filtrar entre</span>
        <div class="input-group">
          <input type="date" name="initialDate" min="2000-12-31" max="2020-12-31" class="form-control" value="{{Request::get('initialDate')}}" />
        </div>
        y
        <div class="input-group">
          <input type="date" name="finalDate" min="2000-12-31" max="2020-12-31" class="form-control" value="{{Request::get('finalDate')}}" />
        </div>
        <button type="submit" class="btn btn-default">Filtrar</button>
      </form>
    </div>

  </div>
  <div class="row">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Nombre usuario</th>
          <th>Registrado</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $u)
          <tr>
            <td>{{$u->firstName}}</td>
            <td>{{$u->lastName}}</td>
            <td>{{$u->username}}</td>
            <td>
              {{date('d-m-Y', strtotime($u->created_at))}}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@overwrite
