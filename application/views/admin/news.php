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
      <a class="nav-link active" href="<?= site_url('admin/news') ?>">Annonces</a>
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
        
<div class="container">
  <div class="card-deck mt-5">
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal text-center">Création d'une nouvelle annonce</h4>
      </div>
      <div class="card-body">
        <div class="list-unstyled mt-3 mb-4">
          <?= form_open('admin/news') ?>
          <div class="form-group">
            <label >* Titre</label>
            <input type="text" class="form-control" name="title">
          </div>
          <div class="form-group">
            <label >* Description</label>
            <textarea class="form-control" rows="5" id="comment" name="content"></textarea>
          </div> 
          <input  type="hidden" name="userid" value="<?= $_SESSION['connect_admin']?>">
          <button type="submit" class="btn btn-primary mb-2">Poster</button>
          </form>
        </div>
      </div>
    </div>
  </div>
        <h2>Liste des Articles</h2>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr class="text-center">
                <th>#</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Utilisateurs</th>
                <th></th>
                <th></th>
              </tr>
            </thead> 
            <tbody>
              <?php foreach ($news as $row): ?>
                <tr class="text-center">
                  <td><?= $row['ID_News'] ?></td>
                  <td><?= $row['Titre'] ?></td>
                  <td><?= $row['Contenu'] ?></td>
                  <td><?= $row['Nom'] ?> <?= $row['Prénom'] ?></td>
                  <td><button type="button" class="btn btn-warning text-white" data-toggle="collapse" data-target="#modifier<?= $row['ID_News'] ?>">Modifier</button></td>
                  <td><a type="submit" class="btn btn-danger text-white" href="<?= site_url('admin/delete_news/' . $row['ID_News']) ?>">Supprimer</a></td>
                </tr>
                <tr id="modifier<?= $row['ID_News'] ?>" class="collapse">
                  <td></td>
                  <?= form_open('admin/edit_news'); ?>
                    <td><input id="inputS" type="text" class="form-control" name="title" value="<?= $row['Titre'] ?>"></td>
                    <td><textarea class="form-control mb-1" rows="5" id="comment" name="content"><?= $row['Contenu']?></textarea></td>
                    <td><input  type="hidden" name="userid" value="<?= $_SESSION['connect_admin']?>"></td>
                    <td><button type="submit" class="btn btn-success text-white container" data-toggle="collapse" data-target="#modifier">Modifier</button></td>
                    <td><input  type="hidden" name="idnews" value="<?= $row['ID_News'] ?>"></td>
                  </form> 
                </tr>
              <?php endforeach; ?>  
            </tbody>
          </table>
        </div>
      </main>
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