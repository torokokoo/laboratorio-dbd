<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=        <section class = "ranking">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>
  <style>
    img{
      height: 50px;
      width: 50px;
    }
    section{
      padding-top: 10px;
      padding-left: 100px;
    }
  </style>
      @include('subviews.navbar')
  <section>
<h1>Top Ventas</h1>
        <table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Juego</th>
      <th scope="col">Unidades Vendidas</th>
      <th scope="col">Tamaño</th>

    </tr>
  </thead>
  <tbody>
    @foreach($games as $game)
    <tr>
      <td><img src="{{$game->image}}" alt=""></td>
      <td>{{$game->name}}</td>
      <td>{{$game->soldUnits}}</td>
      <td>{{$game->storage}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
        </section>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

<body>
  
</body>
</html>