<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<?php $dashboardURL = $this->session->userdata("dashboardURL"); ?>
		<a class="navbar-brand" href="<?php echo base_url($dashboardURL); ?>"><img src="<?php echo base_url("images/logo.png"); ?>" class="img-rounded" width="210" height="50" /></a>
	</div>
	<!-- /.navbar-header -->


<!-- /.TOP MENU -->
	<ul class="nav navbar-top-links navbar-right">
		<li>
		    <a href="https://jbb.gov.co/"></i> Incio</a>
		</li>
		<li>
		    <a href="http://www.jbb.gov.co/index.php/nuestro-jardin"></i> Nuestro Jardín</a>
		</li>
		<li>
		    <a href="http://www.jbb.gov.co/index.php/productos-y-servicios"></i> Productos y Servicios</a>
		</li>
		<li>
		    <a href="http://www.jbb.gov.co/index.php/servicio-al-ciudadano"></i> Servicio al Ciudadano</a>
		</li>
		<li>
		    <a href="http://www.jbb.gov.co/index.php/gestion-institucional"></i> Gestión Institucional</a>
		</li>
		<li>
		    <a href="http://www.jbb.gov.co/index.php/contactenos"></i> Contáctenos</a>
		</li>
<?php
		if($topMenu){
			echo $topMenu;
		}
?>
	</ul>
<!-- /.TOP MENU -->

</nav>