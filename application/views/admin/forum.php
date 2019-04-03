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
    <a class="nav-link active" href="<?= site_url('admin/forum') ?>">Forum</a>
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
</ul> 

<div class="container mt-5"> 
  <div class="container">

    <div class="row">

      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Les catégories</span>
          <span class="badge badge-secondary badge-pill"><?= $count_categories?></span>
        </h4>
      
        <ul class="list-group mb-3">
        <?php foreach ($get_forum_categories as $row): ?>
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0"><?= $row['name']?></h6>
              <small class="text-muted"><?= $row['content']?></small>
            </div>
            <span class="text-muted">
              <a type="submit" class="btn btn-danger text-white" href="<?= site_url('admin/delete_categories/'. $row['idcategory']) ?>">Supprimer</a>
            </span>
          </li>
        <?php endforeach; ?>
        </ul>

        <?= form_open('admin/forum') ?>
          <div class="card p-2">
            <div class="input-group">
              <input type="text" class="form-control" name="name" placeholder="Nom de la nouvelle catégorie">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-secondary">Créer</button>
                </div>
              </div>
              <div class="input-group">
                <input type="text" class="form-control" name="content" placeholder="Contenu de la catégorie">
                <div class="input-group-append"></div>
              </div>
            </div>
          </div>
        </form>

        <div class="col-md-8 order-md-1">

        <h2>Liste des catégories</h2><hr>
  <div class="table-responsive">
    <table class="table table-striped table-sm" id="dataTable">
      <thead>
        <tr class="text-center">
          <th>#</th>
          <th>Nom</th>
          <th>Description</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($get_forum_categories as $row): ?>
        <tr class="text-center">
          <td><?= $row['idcategory'] ?></td>
          <td><?= $row['name'] ?></td>
          <td><?= $row['content'] ?></td>
          <td><button type="button" class="btn btn-warning text-white" data-toggle="collapse" data-target="#modifier<?= $row['idcategory'] ?>">Modifier</button></td>
          <td><a type="submit" class="btn btn-danger text-white" href="<?= site_url('admin/delete_categories/' . $row['idcategory']) ?>">Supprimer</a></td>
        </tr>
        <tr id="modifier<?= $row['idcategory'] ?>" class="collapse text-center">
          <td><?= $row['idcategory'] ?></td>
          <?= form_open('admin/edit_categories'); ?>
            <td><input type="text" class="form-control" name="name" value="<?= $row['name'] ?>"></td>
            <td><input type="text" class="form-control" name="content" value="<?= $row['content']?>"></td>
            <td><button type="submit" class="btn btn-warning text-white" data-toggle="collapse" data-target="#modifier">Modifier</button></td>
            <td><input type="hidden" name="idcategory" value="<?= $row['idcategory'] ?>"></td>
          </form>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table> 
  </div>
    </div><!-- end row -->
  </div><!-- end Container resume article -->



</div><!-- fin container ALL-->
<?php 
  }
  else
  {
    echo '  
    <div class="alert alert-danger container mt-5">
      <strong>Danger !</strong> Vous n\'êtes pas autoriser à accéder à cette page.
    </div>
    ';
  }
?>

