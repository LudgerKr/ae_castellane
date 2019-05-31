<?php 
  if(!empty($_SESSION['connect_admin']))
  {
?>
  <ul class="nav container mt-5 nav-tabs">
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('admin/accueil') ?>">Accueil</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="<?= site_url('admin/user') ?>">Utilisateurs</a>
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
      <a class="nav-link" href="<?= site_url('admin/certificats') ?>">Certificats</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" href="<?= site_url('admin/vehicule') ?>">Vehicules</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" target="blank" href="https://analytics.google.com/analytics/web/?authuser=0#/report-home/a137353005w197830555p192588774">Statistique Google</a>
    </li>
  </ul>
<div class="container mt-5">
<h2>Liste des utilisateurs</h2>
  <div class="table-responsive">
    <table class="table table-striped table-sm" id="dataTable">
      <thead>
        <tr>
          <th>#</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
          <th>Téléphone</th>
          <th>Droit</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($users as $row):
        if($row['right'] != 'Administrateur'){  ?>
        <tr>
          <td><?= $row['iduser'] ?></td>
          <td><?= $row['lastname'] ?></td>
          <td><?= $row['firstname'] ?></td>
          <td><?= $row['email'] ?></td>
          <td>0<?= $row['phone'] ?></td>
          <td><?= $row['right'] ?></td>
          <?php   
            if($row['right'] != 'Super_Administrateur'){
              if($row['ban'] == 0)
              {  
          ?>
              <td><a type="submit" class="btn btn-danger text-white" href="<?= site_url('admin/delete_user/' . $row['iduser']) ?>">Supprimer</a></td>
              <td><a type="submit" class="btn btn-warning text-white" href="<?= site_url('admin/i_ban/' . $row['iduser']) ?>">Banissement</a></td>
          <?php 
              }
              elseif($row['ban'] == 1)
              { 
          ?>
              <td><a type="submit" class="btn btn-danger text-white" href="<?= site_url('admin/delete_user/' . $row['iduser']) ?>">Supprimer</a></td>
              <td><a type="submit" class="btn btn-success text-white" href="<?= site_url('admin/i_unban/' . $row['iduser']) ?>">Débanissement</a></td>
          <?php 
            }} ?>
        </tr>
        <?php }endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
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