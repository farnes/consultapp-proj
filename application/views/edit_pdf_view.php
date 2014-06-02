<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ConsultApp</title>
</head>
<?php
//valores por defecto
$attr_form = array('name' => 'edit-pdf-form', 'method'=>'POST');

$attr_code = array('id' => 'code-field','name' => 'code-field','value' => $code,'placeholder' => 'Codigo');
$attr_name = array('id' => 'name-field','name' => 'name-field','value' => $name,'placeholder' => 'Nombre');
$attr_date = array('id' => 'date-field','name' => 'date-field', 'value' => $pdf_date, 'placeholder' => 'Fecha en dia/mes/a&#241;o');
$attr_upload = array('id' => 'upload-field','name' => 'upload-field','value' => $full_path);

$attr_submit = array('name' => 'submit-button','value' => 'Guardar');
?>
<body>
	<?php include 'menu.php';?>
		
	<div id="error-container">
		<p><?=$dataMessage;?></p>
	</div>
	<div id="form-container">
	<?=form_open_multipart(site_url().'edit_pdf_controller/edit' ,$attr_form);?>
		<div>
		<?=form_input($attr_code);?>
		</div>
		<div>
		<?=form_input($attr_name);?>
		</div>
		<div>
		<?=form_input ($attr_date);?>
		</div>
		<div>
		<?=form_upload($attr_upload);?>
		</div>		
		<div>
		<?=form_submit($attr_submit);?>
		</div>
	<?=form_close();?>
	</div>
</body>
</html> 