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
      <a class="nav-link active" href="<?= site_url('admin/article') ?>">Articles (Forum)</a>
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

<div class="container">
<h2 class="mt-5">Liste des Articles</h2>
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>Titre</th>
          <th>Contenu</th>
          <th>Auteur</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($article_all_info as $row): ?>
        <tr>
          <td><?= $row['ID_Article'] ?></td>
          <td><?=$row['Titre_Article']?></td>
          <td><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal<?=$row['ID_Article']?>">Voir</button></td>
          <td><?= $row['Nom']?> <?= $row['Prénom']?></td>
          <td><a type="submit" class="btn btn-danger text-white" href="<?= site_url('admin/delete_article/' . $row['ID_Article']) ?>">Supprimer</a></td>
        </tr>
        <!-- The Modal -->
        <div class="modal" id="myModal<?=$row['ID_Article']?>">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title"><?= $row['Nom']?> <?= $row['Prénom']?> /  ( <?=$row['Nom_Catégorie'] ?> )</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <?=$row['Contenu_Article']?>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
              </div>

            </div>
          </div>
        </div>
        <?php endforeach; ?>
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