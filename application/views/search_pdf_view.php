<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ConsultApp</title>
</head>
<?php
//valores por defecto
$attr_form = array('name' => 'search-pdf-form', 'method'=>'POST');

$attr_code = array('id' => 'code-field','name' => 'code-field','value' => $code,'placeholder' => 'Codigo');
$attr_name = array('id' => 'name-field','name' => 'name-field','value' => $name,'placeholder' => 'Nombre');
$attr_start_date = array('id' => 'start-date-field','name' => 'start-date-field', 'value' => $startDate, 'placeholder' => 'Fecha Inicio dia/mes/a&#241;o');
$attr_end_date = array('id' => 'end-date-field','name' => 'end-date-field', 'value' => $endDate, 'placeholder' => 'Fecha Fin dia/mes/a&#241;o');

$attr_submit = array('name' => 'submit-button','value' => 'Buscar');
$attr_clean = array('clean' => 'submit-button','value' => 'Limpiar');
?>
<body>
	<?php include 'menu.php';?>
		
	<div id="error-container">
		<p><?=$dataMessage;?></p>
	</div>
	<div id="form-container">
	<?=form_open(site_url().'search_pdf_controller/search' ,$attr_form);?>
		<div>
		<?=form_input($attr_code);?>
		</div>
		<div>
		<?=form_input($attr_name);?>
		</div>
		<div>
		<?=form_input ($attr_start_date);?>
		</div>
		<div>
		<?=form_input ($attr_end_date);?>
		</div>	
		<div>
		<?=form_submit($attr_submit);?>
		</div>
		<div>
		<?=form_submit($attr_clean);?>
		</div>
	<?=form_close();?>
	</div>	
	<?=$dataGrid;?>
</body>
</html> 