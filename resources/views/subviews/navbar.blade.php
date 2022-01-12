<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
<!-- Nombre sujeto a cambios -->
<a class="navbar-brand" href="#">🌫 Mist</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav me-auto mb-2 mb-lg-0">
	<li class="nav-item">
	<a class="nav-link" aria-current="page" href="#">Home</a>
	</li>
	<li class="nav-item">
	<a class="nav-link" href="#">Tienda</a>
	</li>
</ul>
<ul class="nav navbar-nav ml-auto">
	<!-- Esto de @guest y @auth deberia funcionar en algun momento, esperemos que si -->
	@guest
	<li class="nav-item">
	<a class="nav-link" href=""><span class="bi-box-arrow-in-right"></span> Ingresar</a>
	</li>
	<li>
	<a class="nav-link" href=""><span class="bi-person-fill"></span> Registrarse</a>
	</li>
	@endguest
	@auth 
	<li class="nav-item">
	<a class="nav-link" href=""><span class="bi-box-arrow-right"></span> Salir</a>
	</li>
	@endauth
</div>
</div>
</nav>   