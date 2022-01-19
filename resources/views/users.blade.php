<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <title>Users</title>
</head>
<style>
  section{
    padding: 20px;
  }
  h2{
    margin-left: 700px;
  }
</style>
<body>
@include('subviews.navbar')
@if(isset($_COOKIE['id']))
<section>
<h1>Usarios Registrados</h1>
<div class="container mt-5">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                  <th scope="col">#Id</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                  <th scope="row">{{$user->id}}</th>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>
                    <a class="btn btn-outline-warning" href="/user/{{$user->id}}" role = "button">Ver más información</a>
                  </td>
                </tr>
                @endforeach

              </tbody>
        </table>
    </div>
    </section>
    @else
    <h2>401 No Autorizado</h2>
    @endif
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
