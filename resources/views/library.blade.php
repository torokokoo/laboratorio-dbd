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
            <h4 class="mb-5">Mi libreria</h4>
            <div class="row text-center mb-4">
                @foreach ($games as $game)
                <div class="col-4 d-flex justify-content-center my-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{$game->image}}" class="card-img-top" alt="Imagen de juego">
                        <div class="card-body">
                            <h5 class="card-title">{{$game->name}}</h5>
                            <p class="card-text">{{$game->storage}} GB</p>
                            <a href="" class="btn btn-primary">Jugar</a>
                        </div>
                    </div>
                </div>     
                @endforeach

            </div>
        </div>
    </section>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>