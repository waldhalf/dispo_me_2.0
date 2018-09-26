<!DOCTYPE HTML>
<!--
	Massively by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Dispo.me</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="{{ 'css/main.css' }}" />
		<link rel="stylesheet" href="{{ 'css/font-awesome.min.css' }}" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		
	</head>
	<body class="is-preload">
		
		<!-- Wrapper -->
		<div id="wrapper" class="fade-in">
			
			<!-- Intro -->
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="#">Dispo.me</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Link</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Dropdown
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link disabled" href="#">Disabled</a>
						</li>
					</ul>
					@if (Route::has('login'))
					<div class="top-right links">
						@auth
						<a href="{{ url('/home') }}">Home</a>
						@if ($user=Auth::user()->is_admin == 1)
						<a href="{{ url('/admin') }}">admin</a>
						@endif
						@else
						<a href="{{ route('login') }}">Login</a>
						<a href="{{ route('register') }}">Register</a>
						@endauth
					</div>
					@endif
				</div>
			</nav>
			<div id="intro">
				<h1>Changez instantanément vos 
					disponibilités<br />
				</h1>
				<p> Prenez votre planning en main!</p>
				<ul class="actions">
					<li><img src="../img/nbr1.png" alt="number1" class="imgnbr"> Renseignez vos informations ainsi que vos disponibilités</li>
					<li><img src="../img/nbr2.png" alt="number1" class="imgnbr"> Un lien unique vous est alors attribué. Recopiez le lien et synchronisez le avec tous vos profils.</li>
					<li><img src="../img/nbr3.png" alt="number1" class="imgnbr"> Changez sans délai et sans contrainte votre statut sur l'ensemble des plateformes.</li>
				</ul>
			</div>
			
			<!-- Header -->
			<header id="header">
				<a href="/" class="logo">Dispo.me</a>
			</header>
			
			<!-- Nav -->
			<nav id="nav">
				<ul class="links">
					<li class="active"><a href="index.html">A la une</a></li>
					<li><a href="generic.html">Mon profil</a></li>
					<li><a href="elements.html">A définir</a></li>
				</ul>
				<ul class="icons">
					<li><a href="#"><img src="../img/twitter-logo_318-40459.jpg " alt="logo-twitter"  class="logo-img"></a></li>
					<li><a href="#"><img src="../img/facebook-symbol_318-37686.jpg" alt="logo-facebook"  class="logo-img"></a></li>
					<li><a href="#"><img src="../img/logo-instagram.png" alt="logo-instagram"  class="logo-img"></a></li>
					<li><a href="#"><img src="../img/logo-github.png" alt="logo-github"  class="logo-img"></a></li>
				</ul>
			</nav>
			logo-github.png
			<!-- Main -->
			<div id="main">
				
				<!-- Featured Post -->
				<article class="post featured">
					<header class="major">
						<span class="date">April 25, 2017</span>
						<h2><a href="#">And this is a<br />
							massive headline</a></h2>
							<p>Aenean ornare velit lacus varius enim ullamcorper proin aliquam<br />
								facilisis ante sed etiam magna interdum congue. Lorem ipsum dolor<br />
								amet nullam sed etiam veroeros.</p>
							</header>
							<a href="#" class="image main"><img src="images/pic01.jpg" alt="" /></a>
							<ul class="actions special">
								<li><a href="#" class="button large">Full Story</a></li>
							</ul>
						</article>
						
						<!-- Posts -->
						<section class="posts">
							<article>
								<header>
									<span class="date">April 24, 2017</span>
									<h2><a href="#">Sed magna<br />
										ipsum faucibus</a></h2>
									</header>
									<a href="#" class="image fit"><img src="images/pic02.jpg" alt="" /></a>
									<p>Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis magna etiam.</p>
									<ul class="actions special">
										<li><a href="#" class="button">Full Story</a></li>
									</ul>
								</article>
								<article>
									<header>
										<span class="date">April 22, 2017</span>
										<h2><a href="#">Primis eget<br />
											imperdiet lorem</a></h2>
										</header>
										<a href="#" class="image fit"><img src="images/pic03.jpg" alt="" /></a>
										<p>Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis magna etiam.</p>
										<ul class="actions special">
											<li><a href="#" class="button">Full Story</a></li>
										</ul>
									</article>
									<article>
										<header>
											<span class="date">April 18, 2017</span>
											<h2><a href="#">Ante mattis<br />
												interdum dolor</a></h2>
											</header>
											<a href="#" class="image fit"><img src="images/pic04.jpg" alt="" /></a>
											<p>Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis magna etiam.</p>
											<ul class="actions special">
												<li><a href="#" class="button">Full Story</a></li>
											</ul>
										</article>
										<article>
											<header>
												<span class="date">April 14, 2017</span>
												<h2><a href="#">Tempus sed<br />
													nulla imperdiet</a></h2>
												</header>
												<a href="#" class="image fit"><img src="images/pic05.jpg" alt="" /></a>
												<p>Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis magna etiam.</p>
												<ul class="actions special">
													<li><a href="#" class="button">Full Story</a></li>
												</ul>
											</article>
											<article>
												<header>
													<span class="date">April 11, 2017</span>
													<h2><a href="#">Odio magna<br />
														sed consectetur</a></h2>
													</header>
													<a href="#" class="image fit"><img src="images/pic06.jpg" alt="" /></a>
													<p>Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis magna etiam.</p>
													<ul class="actions special">
														<li><a href="#" class="button">Full Story</a></li>
													</ul>
												</article>
												<article>
													<header>
														<span class="date">April 7, 2017</span>
														<h2><a href="#">Augue lorem<br />
															primis vestibulum</a></h2>
														</header>
														<a href="#" class="image fit"><img src="images/pic07.jpg" alt="" /></a>
														<p>Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis magna etiam.</p>
														<ul class="actions special">
															<li><a href="#" class="button">Full Story</a></li>
														</ul>
													</article>
												</section>
												
												<!-- Footer -->
												<footer>
													<div class="pagination">
														<!--<a href="#" class="previous">Prev</a>-->
														<a href="#" class="page active">1</a>
														<a href="#" class="page">2</a>
														<a href="#" class="page">3</a>
														<span class="extra">&hellip;</span>
														<a href="#" class="page">8</a>
														<a href="#" class="page">9</a>
														<a href="#" class="page">10</a>
														<a href="#" class="next">Next</a>
													</div>
												</footer>
												
											</div>
											
											<!-- Footer -->
											<footer id="footer">
												<section>
													<form method="post" action="#">
														<div class="fields">
															<div class="field">
																<label for="name">Name</label>
																<input type="text" name="name" id="name" />
															</div>
															<div class="field">
																<label for="email">Email</label>
																<input type="text" name="email" id="email" />
															</div>
															<div class="field">
																<label for="message">Message</label>
																<textarea name="message" id="message" rows="3"></textarea>
															</div>
														</div>
														<ul class="actions">
															<li><input type="submit" value="Send Message" /></li>
														</ul>
													</form>
												</section>
												<section class="split contact">
													<section class="alt">
														<h3>Address</h3>
														<p>1234 Somewhere Road #87257<br />
															Nashville, TN 00000-0000</p>
														</section>
														<section>
															<h3>Phone</h3>
															<p><a href="#">(000) 000-0000</a></p>
														</section>
														<section>
															<h3>Email</h3>
															<p><a href="#">info@untitled.tld</a></p>
														</section>
														<section>
															<h3>Social</h3>
															<ul class="icons alt">
																<li><a href="#" class="icon alt fa-twitter"><span class="label">Twitter</span></a></li>
																<li><a href="#" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>
																<li><a href="#" class="icon alt fa-instagram"><span class="label">Instagram</span></a></li>
																<li><a href="#" class="icon alt fa-github"><span class="label">GitHub</span></a></li>
															</ul>
														</section>
													</section>
												</footer>
												
												<!-- Copyright -->
												<div id="copyright">
													<ul><li>&copy; Dispo.me</li><li>Design: <a href="https://html5up.net">HTML5 UP</a></li></ul>
												</div>
												
											</div>
											
											<!-- Scripts -->
											<script src="js/jquery.min.js"></script>
											<script src="js/jquery.scrollex.min.js"></script>
											<script src="js/jquery.scrolly.min.js"></script>
											<script src="js/browser.min.js"></script>
											<script src="js/breakpoints.min.js"></script>
											<script src="js/util.js"></script>
											<script src="js/main.js"></script>
											<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
											<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
											
										</body>
										</html>