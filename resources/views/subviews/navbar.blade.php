<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container-fluid">
		<!-- Nombre sujeto a cambios -->
		<a class="navbar-brand" href="/">🌫 Mist</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link" href="/">Tienda</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/games/ranking">Top Ventas</a>
				</li>
				@if(isset($_COOKIE['id']))
				<li class="nav-item">
					<a class="nav-link" href="/users">Usuarios</a>
				</li>
				@endif

			</ul>
			<ul class="nav navbar-nav ml-auto">
				{{-- Se muestra las ventanas de user y logout si el usuario esta logeado --}}
				@if(isset($_COOKIE['id']))
				<li>
					<a class="nav-link" href="/user/{{$_COOKIE['id']}}"><span class="bi-person-fill"></span>
						{{$_COOKIE['user']}}</a>
				</li>
				@if(isset($_COOKIE['role']))
				@if($_COOKIE['role']=='Admin')
				<li>
					<a class="nav-link"><span class="bi-person-fill"></span> Admin</a>
				</li>
				@elseif($_COOKIE['role']=='Developer')
				<li>
					<a class="nav-link"><span class="bi-person-fill"></span>Developer</a>
				</li>

				@endif
				<li>
					<a class="nav-link" href="/library/{{$_COOKIE['id']}}"><span class="bi-collection"></span> Mi
						Biblioteca</a>
				</li>
				<li>
					<a class="nav-link" href="/wishlists/{{$_COOKIE['id']}}"><span class="bi-card-checklist"></span> Mi
						Lista De Deseos</a>
				</li>

				<li>
					<a class="nav-link" href="/logout"><span class="bi-box-arrow-right"></span> Logout</a>
				</li>
				@else


				@endif
				@else
				<li class="nav-item">
					<a class="nav-link" href="/login"><span class="bi-box-arrow-in-right"></span> Iniciar Sesión</a>
				</li>
				<li>
					<a class="nav-link" href="/register"><span class="bi-person-fill"></span> Registrarse</a>
				</li>
				@endif


		</div>
	</div>
</nav>