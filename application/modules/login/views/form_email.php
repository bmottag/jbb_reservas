<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
    <title>JBB</title>
	<link rel="icon" type="image/png" href="<?php echo base_url("images/favicon.ico"); ?>" />

    <!-- Bootstrap Core CSS -->
	<link href="<?php echo base_url("assets/bootstrap/vendor/bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url("assets/bootstrap/vendor/metisMenu/metisMenu.min.css"); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("assets/bootstrap/dist/css/sb-admin-2.css"); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url("assets/bootstrap/vendor/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css">
	
    <!-- jQuery -->
    <script src="<?php echo base_url("assets/bootstrap/vendor/jquery/jquery.min.js"); ?>"></script>
	<!-- jQuery validate-->
	<script type="text/javascript" src="<?php echo base_url("assets/js/general/general.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/general/jquery.validate.js"); ?>"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Recuper contraseña</h3>
                    </div>
                    <div class="panel-body">
						<?php if(isset($msjSuccess)){?>
							<div class="row">
								<div class="col-lg-12">
									<p class="text-success">
										<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
										<?php echo $msjSuccess ?>	
									</p>
								</div>
							</div>	
						<?php } ?>
						
						<?php if(isset($msj)){?>
							<div class="row">
								<div class="col-lg-12">
									<p class="text-danger">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
										<?php echo $msj ?>	
									</p>
								</div>
							</div>	
						<?php } ?>
						
						<?php if(!$_POST){ ?>
						<div class="row">
							<div class="col-lg-12">
								<p class="text-success">
									<span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span>
									Digite su correo electrónico para enviar las instrucciones de recuperación de contraseña.
								</p>
							</div>
						</div>	
							
						<form  name="form" id="form" role="form" method="post" action="<?php echo base_url("login/validateEmail"); ?>" >
						  <div class="form-group has-feedback">
							<input type="emal" id="email" name="email" size="50" class="form-control" placeholder="Correo electrónico" maxlength=50 required="required">
							<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
						  </div>
						  <div class="row">
							<div class="col-xs-8">

							</div>
							<!-- /.col -->
							<div class="col-xs-4">
							  <button type="submit" class="btn btn-info btn-block" id='btnSubmit' name='btnSubmit'>Enviar</button>
							</div>
							<!-- /.col -->
						  </div>
						</form>
						<?php } ?>					

						<br>	
						<a href="<?php echo base_url("login"); ?>">Ingresar</a><br>
						
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
