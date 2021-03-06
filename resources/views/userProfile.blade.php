<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
  <title>Usuario</title>
</head>

<body>
  <style>
    section {
      padding: 10px;
    }

    * {
      color: white;
    }

    a {
      text-decoration: none;
      color: white;
    }
  </style>
  @include('subviews.navbar')
  <section>
    <div class="col-4 mx-auto"
      style="background: rgb(40,40,51);border-radius: 4px;transform-origin: center;padding: 20px; margin-top: 40px"
      just>
      <h1 style="color: var(--bs-light); ">{{$user->name}}</h1>
      <h4 style="color: var(--bs-light)">{{$size}} Seguidores</h4>
      <h4 style="color: var(--bs-light)">Correo Electronico</h4>
      <h6 style="color: var(--bs-light);">{{$user->email}}</h6>
      <h4 style="color: var(--bs-light)">Fecha de nacimiento</h4>
      <h6 style="color: var(--bs-light);">{{$user->birthday}}</h6>
      <h4 style="color: var(--bs-light)">Pais</h4>
      <h6 style="color: var(--bs-light);">{{$country}}</h6>
      <h4 style="color: var(--bs-light)">Moneda</h4>
      <h6 style="color: var(--bs-light);">{{$cur}}</h6>
      <h4 style="color: var(--bs-light)">Rol</h4>
      <h6 style="color: var(--bs-light);">{{$rol}}</h6>
      <button type="button" class="btn btn-primary">Seguir</button>
      <button type="button" class="btn btn-success">Enviar Mensaje</button>
      @if(isset($_COOKIE['id']))
      @if(isset($_COOKIE['role']))
      @if(($_COOKIE['role']=='Admin') or ($_COOKIE['id']== $user->id))
      <button type="button" class="btn btn-danger"><a href="/user/{{$_COOKIE['id']}}/edit">Editar Perfil</a></button>
      @endif
      @endif
      @endif
    </div>
    <div class="col-4 mx-auto"
      style="background: rgb(40,40,51);border-radius: 4px;transform-origin: center;padding: 20px; margin-top: 40px">
      <div class="card-body">
        <h5 class="card-title">Seguidores {{$user->name}}</h5>
        <ul class="list-group">
          @foreach($users as $userr)
          <li class="list-group-item">{{$userr->name}}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </section>
</body>

</html>