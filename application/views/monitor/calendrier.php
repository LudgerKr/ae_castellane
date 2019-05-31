<?php 
  if(!empty($_SESSION['connect_monitor']))
  {
?>
  <ul class="nav container mt-5 nav-tabs">
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('monitor/accueil') ?>">Accueil</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" href="<?= site_url('monitor/appointment') ?>">Mes rendez-vous</a>
    </li>
	<li class="nav-item">
      <a class="nav-link active" href="<?= site_url('monitor/calendrier') ?>">Mon calendrier</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" href="<?= site_url('monitor/seance') ?>">Séances</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('monitor/vehicule') ?>">Véhicule</a>
    </li>
  </ul>
<div class="container mt-5">
 <div id='calendar'></div>
</div>
<?php 
}else{
  echo '  
  <div class="alert alert-danger container mt-5">
    <strong>Danger !</strong> Vous n\'êtes pas autoriser à accéder à cette page.
  </div>
';
}
?>