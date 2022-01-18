<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<title>Mist</title>
</head>
<body>
  	<style>
      .ranking{
        margin: 50px;
      }
	</style>
	@include('subviews.navbar')
   <section class="mt-5">
        <div class="container ">
            <h4 class="mb-5">Elige un juego</h4>
            <div class="row text-center mb-4">
                @foreach ($games as $game)
                <div class="col-4 d-flex justify-content-center my-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{$game->image}}" class="card-img-top" alt="Imagen de curso">
                        <div class="card-body">
                            <h5 class="card-title">{{$game->name}}</h5>
                            <p class="card-text">${{$game->price}}</p>
                            <a href="/game/{{ $game->id }}" class="btn btn-primary">Ver juego</a>
                            @if(isset($_COOKIE['role']))
                            @if($_COOKIE['role']=='Admin')
                            <a href="/game/{{ $game->id }}/edit" class="btn btn-primary">Editar juego</a>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>     
                @endforeach
                {{-- APARTADO PARA CREAR JUEGO --}}
                @if(isset($_COOKIE['role']))
                @if($_COOKIE['role']=='Developer')
                <div class="col-4 d-flex justify-content-center my-3">
                    <div class="card" style="width: 18rem;">
                      {{-- PONER IMAGEN DE CREAR JUEGO TIPO " + " --}}
                        <img src="{{$game->image}}" class="card-img-top" alt="Imagen de curso"> 
                        <div class="card-body">
                            <h5 class="card-title">Crear Juego</h5>
 
                            <a href="/game/create" class="btn btn-primary">Crear juego</a>

                        </div>
                    </div>
                </div>   
              @endif
              @endif
            </div>
        </div>
    </section>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>