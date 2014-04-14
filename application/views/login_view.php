<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ConsultApp - Login</title>
</head>
<?php
//valores por defecto
$attr_form = array('name' => 'login-form', 'id' => 'login-form', 'method'=>'POST');
$attr_user = array('id' => 'user-field','name' => 'user-field','placeholder' => 'Usuario');
$attr_pass = array('id' => 'pass-field','name' => 'pass-field','placeholder' => 'Clave');
$attr_submit = array('id' => 'submit-button','name' => 'submit-button','value' => 'Acceder');
?>
<body>
	<div id="error-container">
		<?=validation_errors();?>
	</div>
	<div id="form-container">
	<?=form_open(site_url().'login_controller/loggin',$attr_form);?>
		<div>
		<?=form_input($attr_user);?>
		</div>
		<div>
		<?=form_password($attr_pass);?>
		</div>
		<div>
		<?=form_submit($attr_submit);?>
		</div>
	<?=form_close();?>
	</div>
</body>
</html>
