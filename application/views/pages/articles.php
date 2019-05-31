<div class=" container my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">ARTICLES</h6>
  <?php 
      if (count($articles)>0)
      {
      foreach ($articles as $article):
        if($article['ID_Catégorie'] == $_GET['categorie']):
  ?>
    <div class="media text-muted pt-3 border-bottom border-gray">
      <a  href="?article=<?=$article['ID_Article']?>" data-toggle="modal" data-target="#myModal<?=$article['ID_Article']?>" style="text-decoration: none; color: grey;" onmouseover="this.style.color = 'red';" onmouseout="this.style.color = 'grey';">
        <p class="media-body container pb-3 mb-0 small lh-125 ">
          <strong class="d-block text-gray-dark"><?= $article['Titre_Article'] ?></strong>
          <?= $article['Contenu_Article'] ?> ...
        </p>
      </a>
    </div>
    <!-- The Modal -->
    <div class="modal" id="myModal<?=$article['ID_Article']?>">

      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title"><?=$article['Titre_Article']?></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
          <div class="row container">
            <p class="col-sm-12"> 
              <?=$article['Contenu_Article']?>
            </p>  
          </div>
          <?php 
            if(!empty($_SESSION['userid']))
            {
              if($article['ID_User'] == $_SESSION['userid'] OR $article['ID_User'] != $_SESSION['userid'] )
              {
				  
          ?>
          
            <!-- Formulaire -->
          <h4 class="text-muted mt-5">Commentaires</h4><hr>
          
			  
		  <?php 
            foreach($comments as $row):
              if($row['ID_Catégory'] == $article['ID_Catégorie']):
				 if($row['Id_Article'] == $article['ID_Article']):
          ?>
            <div class="container border mb-2">
				<h5><i>@<?= $row['Nom']?> <?= $row['Prénom']?></i></h5>
				<div class="container"><?= $row['Contenu'] ?></div>
				  <?php if($row['ID_Utilisateur'] == $_SESSION['userid']):?>
					<a type="submit" href="<?= site_url('forum/delete_commentaires/' . $row['ID_Commentaire']) ?>" class="btn btn-danger m-3"><i class="fa fa-trash"></i></a>
				  <?php endif; ?>
				</div>
              <?php endif; endif; endforeach;?>
          <hr>
			  
			  
			  
          <h6>Poster un commentaire</h6>
           <?= form_open('forum/insert_comment'); ?>
                <input  type="hidden" name="userid" value="<?= $_SESSION['userid'] ?>">
                <input  type="hidden" name="categorieid" value="<?= $_GET['categorie'] ?>">
                <input  type="hidden" name="articleid" value="<?= $article['ID_Article'] ?>">
                <textarea class="form-control" rows="5" id="comment" name="content"></textarea>
                <button type="submit" class="btn btn-success mt-2">Poster</button>
            </form>
          <?php
              }
              elseif($article['ID_User'] != $_SESSION['userid'])
              {}}
          ?>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
          <?php 
            if(!empty($_SESSION['userid']))
            {
              if($article['ID_User'] == $_SESSION['userid'])
              {
          ?>

            </div>
                <div class="container row ml-1">
                <button type="button" class="btn btn-warning text-white col-6 mb-1" data-toggle="collapse" data-target="#demo<?= $article['ID_Article'] ?>">Modifier</button>
                <a type="submit" href="<?= site_url('forum/delete_article/' . $article['ID_Article']) ?>" class="btn btn-danger col-6 mb-1"><i class="fa fa-trash"></i></a>
                <button type="button" class="btn btn-danger col-6 mb-1" data-dismiss="modal">Fermer</button>
          <?php 
              }
              elseif($article['ID_User'] != $_SESSION['userid'])
              {
          ?>
            </div>
                <div class="container row ml-1">
                <button type="button" class="btn btn-danger col-6 mb-1" data-dismiss="modal">Fermer</button>
          <?php  
              }
            }
            else
            {
          ?>
            <div class="alert alert-warning">
              <strong>Attention!</strong> Vous devez être <a href="<?=site_url('user/signin')?>" class="alert-link">Connecté</a> pour intérragire avec cette l'article.
            </div>
            
            <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
          <?php 
            } 
          ?>
          </div>
          <div id="demo<?=$article['ID_Article']?>" class="collapse container">
              <div class="row mt-3">
                <div class="form-group col-sm-6">
                  <label for="inputState">Titre</label>
                  <input type="text" class="form-control" id="title" value="<?= $article['Titre_Article']?>"name="title">
                </div>
                <div class="form-group col-sm-6">
                <label for="inputState">Catégorie</label>
                  <select id="inputState" class="form-control" name="categoryid">
                      <?php foreach ($categories as $categorie): ?>
                          <option value="<?= $categorie['idcategory'] ?>"><?= $categorie['name'] ?></option>
                      <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="comment">Descritpion :</label>
                <textarea class="form-control" rows="5" id="comment" name="content"><?= $article['Contenu_Article']?></textarea>
              </div> 
              <input  type="hidden" name="idarticle" value="<?= $article['ID_Article'] ?>">
              <button type="submit" class="btn btn-success m-3">Modifier</button>
            </form>
          </div>
        </div>

      </div>
    </div>
    
  <?php 
     endif;
    endforeach;
  }else{
    echo '<div class="alert alert-warning container mt-5" role="alert">Aucun Articles !</div>';
}
  
 ?>
</div> 

