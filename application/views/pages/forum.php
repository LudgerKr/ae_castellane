<div class=" container my-3 p-3 bg-white rounded shadow-sm">
<?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
  <div class="row">
    <h6 class="border-bottom border-gray pb-2 col-sm-8 mb-0">Catégories</h6>
    <a class="btn btn-success text-white action-button col-sm-4" data-toggle="collapse" data-target="#demo">Créer un article</a>
  </div>

  <div id="demo" class="collapse">

  <?php if(empty($_SESSION['userid'])): ?>
  <div class="alert alert-warning mt-3">
    <strong>Attention !</strong>Vous devez être <a href="<?=site_url('user/signin')?>" class="alert-link"> connecté </a> pour créer un nouveau sujet. (<a href="<?=site_url('user/signup')?>" class="alert-link"> Inscription </a>)
  </div>
<?php endif;?>
  <?= form_open('forum/forum'); ?>
    <div class="row mt-3">
      <div class="form-group col-sm-6">
        <label for="title">Titre de l'article</label>
        <input type="text" class="form-control" id="title" name="title">
      </div>
      <div class="form-group col-sm-6">
      <label for="inputState">Catégorie</label>
        <select id="inputState" class="form-control" name="categoryid">
            <option selected disabled>Sélectionner une Catégorie</option>
            <?php foreach ($categories as $categorie): ?>
                <option value="<?= $categorie['idcategory'] ?>"><?= $categorie['name'] ?></option>
            <?php endforeach; ?>
        </select>
      </div>
    </div>
      <div class="form-group">
        <label for="comment">Descritpion :</label>
        <textarea class="form-control" rows="5" id="comment" name="content"></textarea>
      </div>
      <button type="submit" class="btn btn-success">Ajouter</button>
    </form><hr>
  </div>

  <?php 
          if (count($categories)>0)
          {
            foreach ($categories as $categorie): ?>
    <div class="media text-muted pt-3 border-bottom border-gray">
      <a href="<?= site_url('articles?categorie='. $categorie['idcategory'].'') ?>" style="text-decoration: none; color: grey;" onmouseover="this.style.color = 'red';" onmouseout="this.style.color = 'grey';">
        <p class="media-body pb-3 mb-0 small lh-125 ">
          <strong class="d-block text-gray-dark">@<?= $categorie['name'] ?></strong>
          <?= $categorie['content'] ?> ...
        </p>
      </a>
    </div>
  <?php endforeach;
  }else{
      echo '<div class="alert alert-warning container mt-5" role="alert">Aucune Catégories !</div>';
  }?>
</div> 
 