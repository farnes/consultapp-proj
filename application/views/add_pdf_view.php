<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ConsultApp</title>
</head>
<?php
//valores por defecto
$attr_form = array('name' => 'add-pdf-form', 'id' => 'add-pdf-form', 'method'=>'POST');
$attr_code = array('id' => 'code-field','name' => 'code-field','placeholder' => 'Codigo');
$attr_name = array('id' => 'name-field','name' => 'name-field','placeholder' => 'Nombre');
$attr_day = array('id' => 'date-field','name' => 'date-field','placeholder' => 'Dia');
$attr_month = array('id' => 'date-field','name' => 'date-field','placeholder' => 'Mes');
$attr_year = array('id' => 'date-field','name' => 'date-field','placeholder' => 'A&#241;o');
$attr_select_file = array('id' => 'select-button','name' => 'select-button','value' => 'Seleccionar Archivo...');
$attr_submit = array('id' => 'submit-button','name' => 'submit-button','value' => 'Guardar');
?>
<body>
	<?php include 'menu.php';?>
		
	<div id="error-container">
		<?=validation_errors();?>
		<p><?=$errorMessage;?></p>
	</div>
	<div id="form-container">
	<?=form_open(site_url().'add_pdf_controller/add',$attr_form);?>
		<div>
		<?=form_input($attr_code);?>
		</div>
		<div>
		<?=form_input($attr_name);?>
		</div>
		<div>
		<?=form_input($attr_day);?>
		</div>
		<div>
		<?=form_input($attr_month);?>
		</div>
		<div>
		<?=form_input($attr_year);?>
		</div>
		<div>
		<?=form_submit($attr_select_file);?>
		</div>
		<div>
		<?=form_submit($attr_submit);?>
		</div>
	<?=form_close();?>
	</div>
</body>
</html> 