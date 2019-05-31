<div class="highlight-phone">
 <div class="container">
  <div class="row">
   <div class="col-md-8">
    <div class="intro">
	 <h2>Maintenant sur téléphone !!!</h2>
	 <p>
	  Castellane-Auto vous propose d'obtenir et d'effectuer votre code en ligne et maintenant possible depuis votre téléphone portable.
	 </p>
     <a class="btn btn-primary" role="button" target="bold" href="http://play.google.com/store/apps/details?id=com.google.android.apps.maps">Télécharger</a>
	</div>
   </div>
   <div class="col-sm-4">
    <div class="d-none d-md-block iphone-mockup">
     <img src="assets/img/iphone.svg" alt="erreur de chargement" class="device">
	</div>
   </div>
  </div>
 </div> 
</div>
<div class="projects-horizontal">
 <div class="container">
  <div class="intro"></div>
   <div class="row projects">
    <?php 
      if (count($news)>0)
      {
       foreach($news as $row):
    ?>
    <div class="col-sm-6 item">
     <div class="row">
      <div class="col-sm-10">
	   <h3 class="name"><?= $row['title'] ?></h3>
       <p class="description">
		<?= substr($row['content'],0, 50) ?> ...
	   </p>
       <button type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#myModal<?= $row['idnew'] ?>">
        Plus d'informations
       </button>
      </div>
     </div>
    </div>
    <!-- The Modal -->
    <div class="modal" id="myModal<?= $row['idnew'] ?>">
     <div class="modal-dialog">
      <div class="modal-content">
	   <!-- Modal Header -->
	   <div class="modal-header">
		<h4 class="modal-title"><?= $row['title'] ?></h4>
		<button type="button" class="close" data-dismiss="modal">&times;</button>
	   </div>
       <!-- Modal body -->
       <div class="modal-body">
        <?= $row['content'] ?>
       </div>
       <!-- Modal footer -->
       <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
       </div>
      </div>
     </div>
    </div>
    <?php 
       endforeach;
      }
	  else
	  {
       echo '<div class="alert alert-warning container mt-5" role="alert">Aucune publication !</div>';
      }
    ?>
   </div>
  </div>
 </div>
