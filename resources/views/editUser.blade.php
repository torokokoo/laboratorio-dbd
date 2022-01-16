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
		.bd-placeholder-img {
		font-size: 1.125rem;
		text-anchor: middle;
		-webkit-user-select: none;
		-moz-user-select: none;
		user-select: none;
		}
		
		@media (min-width: 768px) {
		.bd-placeholder-img-lg {
		font-size: 3.5rem;
		}
		}
		html,
		body {
		height: 100%;
		}

		body {
		display: inline;
		align-items: center;
		padding-top: 40px;
		padding-bottom: 40px;
		background-color: #f5f5f5;
		}

		.form-signin {
		width: 100%;
		max-width: 330px;
		padding: 15px;
		margin: auto;
		}

		.form-signin .checkbox {
		font-weight: 400;
		}

		.form-signin .form-floating:focus-within {
		z-index: 2;
		}

		.form-signin input[type="email"] {
		margin-bottom: -1px;
		border-bottom-right-radius: 0;
		border-bottom-left-radius: 0;
		}

		.form-signin input[type="password"] {
		margin-bottom: 10px;
		border-top-left-radius: 0;
		border-top-right-radius: 0;
		}
	</style>
		@include('subviews.navbar')

	<div class="container">
		<main class="form-signin">
		<form action="" method="post" >
      @csrf
        @method('put')
		<h1 class="h3 mb-3 fw-normal">Edición de usuario</h1>

		<div class="form-floating">
		<input type="text" class="form-control"  class="@error('name') is-invalid @enderror" id="name" name="name" placeholder="name@example.com">
		<label for="floatingUsername">Nombre de usuario</label>
		</div>
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

		<div class="form-floating">
		<input type="text" class="form-control"  class="@error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com">
		<label for="floatingUsername">Correo Electronico</label>
		</div>
    @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

		<div class="form-floating">
		<input type="text" class="form-control"  class="@error('password') is-invalid @enderror" id="password" name="password" placeholder="name@example.com">
		<label for="floatingUsername">Contraseña</label>
		</div>
    @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

		<div class="form-floating">
		<input type="text" class="form-control"  class="@error('home_address_id') is-invalid @enderror" id="home_address_id" name="home_address_id" placeholder="name@example.com">
		<label for="floatingUsername">Direccion</label>
		</div>
    @error('home_address_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    		<div class="form-floating">
		<input type="text" class="form-control"  class="@error('birthday') is-invalid @enderror" id="birthday" name="birthday" placeholder="name@example.com">
		<label for="floatingUsername">Fecha de nacimiento</label>
		</div>
    @error('birthday')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

		<div class="form-floating">
		<input type="text" class="form-control"  class="@error('currency_id') is-invalid @enderror" id="currency_id" name="currency_id" placeholder="name@example.com">
		<label for="floatingUsername">Moneda</label>
		</div>
    @error('currency_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

		<div class="mt-3">
			<button class="w-100 btn btn-lg btn-primary" type="submit">Registrarse</button>
		</div>
		<p class="mt-5 mb-3 text-muted">&copy; DEBEDE 2021-2022</p>
		</form>
		</main>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>	
</html> 
  </body>
</html>