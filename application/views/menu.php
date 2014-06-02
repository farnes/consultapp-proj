<?php 
// se obtiene la base de la aplicacion y el nombre del usuario que vive en el sesion
$app_base = site_url(); 
$name = $this->session->userdata(INFO_SESSION_USER)->name_vc;
?>

<p>	Bienvenido <?=$name?> <a href="<?=$app_base?>login_controller/loggout">Cerrar sesion</a></p>
<p>
	<a href="<?=$app_base?>add_pdf_controller">Alta</a> |
	<a href="<?=$app_base?>search_pdf_controller">Busqueda</a>
</p>