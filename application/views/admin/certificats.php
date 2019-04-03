<?php 
  if(!empty($_SESSION['connect_admin']))
  {
?>
  <ul class="nav container mt-5 nav-tabs">
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('admin/accueil') ?>">Accueil</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('admin/user') ?>">Utilisateurs</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('admin/seance') ?>">Séances</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('admin/news') ?>">Annonces</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('admin/forum') ?>">Forum</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('admin/article') ?>">Articles (Forum)</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('admin/quizz') ?>">Quizz</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="<?= site_url('admin/certificats') ?>">Certificats</a>
    </li>
  </ul>
    <div class="row">
      <?php foreach($certificats as $row): ?>
      <div class="stats-col text-center col-md-3">
        <div class="circle mt-5">
          <span class="stats-no" data-toggle="counter-up"><?= $row['Note']?>/<?= $row['NombreQuestion']?> </span><?= $row['Nom']?> <?= $row['Prenom']?>
          <a type="submit" class="btn btn-success text-white" href="">Envoyer</a>
        </div>
        </div>
      <?php endforeach; ?>
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

