<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
	<title>Mist</title>
</head>

<body>
	@include('subviews.navbar')

	<style>
		img {
			max-width: 75%;
		}

		.rounded {
			border-radius: 1rem
		}

		.nav-pills .nav-link {
			color: #555
		}

		.nav-pills .nav-link.active {
			color: white
		}

		input[type="radio"] {
			margin-right: 5px
		}

		.bold {
			font-weight: bold
		}
	</style>
	<div class="row g-0">
		<div class="col-md-4">
			<img src="{{$game->image}}" class="img-fluid rounded-start" alt="...">
		</div>
		<div class="col-md-8">
			<div class="card-body">
				<h1 class="card-title">{{$game->name}}</h1>
				<h4 class="card-subtitle">Precio: ${{$game->price}}</h4>
				<hr>
				<p class="card-text">Por favor selecciona el metodo de pago que usaras.</p>
				@if($user->balance < $game->price)
					<div class="alert alert-danger" role="alert">
						No tienes suficientes monedas Mist!
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
							disabled>
						<label class="form-check-label" for="flexRadioDefault1">
							Monedero de Mist (tienes {{$user->balance}} monedas Mist)
						</label>
					</div>
					@else
					<div class="form-check">
						<input class="form-check-input" type="radio" name="mistcoins" id="flexRadioDefault1">
						<label class="form-check-label" for="flexRadioDefault1">
							Monedero de Mist (tienes {{$user->balance}} monedas Mist)
						</label>
					</div>
					@endif
					<div class="form-check">
						<input class="form-check-input" type="radio" name="creditcard" id="flexRadioDefault1">
						<label class="form-check-label" for="flexRadioDefault1">
							Tarjeta de Credito
						</label>
					</div>
					<div class="form-control mt-2">
						<div class="input-group">
							<span class="input-group-text bi-credit-card"></span>
							<input type="text" class="form-control" placeholder="Numero de tarjeta">
						</div>
						<div class="row mt-2">
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-text bi-calendar"></span>
									<input type="text" class="form-control" placeholder="MM/YY">
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-text bi-123"></span>
									<input type="text" class="form-control" placeholder="CVC">
								</div>
							</div>
						</div>
						<div class="input-group mt-2">
							<span class="input-group-text bi-person-fill"></span>
							<input type="text" class="form-control" placeholder="Nombre completo">
						</div>
					</div>
					<div class="d-grid gap-3 mt-5 text-center">
						<form action="" id="form" method="post">
							<input type="submit" class="btn btn-primary btn-lg" value="Finalizar compra">
						</form>
					</div>
			</div>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>