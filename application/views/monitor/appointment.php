<?php 
  if(!empty($_SESSION['connect_monitor']))
  {
?>
  <ul class="nav container mt-5 nav-tabs">
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('monitor/accueil') ?>">Accueil</a>
    </li>
	<li class="nav-item">
      <a class="nav-link active" href="<?= site_url('monitor/appointment') ?>">Mes rendez-vous</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" href="<?= site_url('monitor/calendrier') ?>">Mon calendrier</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" href="<?= site_url('monitor/seance') ?>">Séances</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('monitor/vehicule') ?>">Véhicule</a>
    </li>
  </ul>

<div class="container mt-5">

<h2>Liste des rendez-vous</h2>
  <div class="table-responsive">
    <table class="table table-striped table-sm" id="dataTable">
      <thead>
        <tr>
          <th>#</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Date</th>
          <th>Nombre d'heure</th>
		  <th>Résultat</th>
		  <th></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($get_appointment_all as $row): if($_SESSION['connect_monitor'] == $row['idMonitor']){?>
        <tr>
		  <td><?= $row['idAppointment'] ?></td>
          <td><?= $row['lastname'] ?></td>
          <td><?= $row['firstname'] ?></td>
          <td><?= $row['date'] ?> / <?= $row['horraire'] ?></td>
          <td><?= $row['timeconduite'] ?></td>
		  <td><?php if($row['authorization'] == 1){ echo 'Accepter';}else{ echo 'Refuser';}?></td>
		  <td>
			  <button type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#myModal<?= $row['idAppointment'] ?>">
				Voir
       		  </button>
		  </td>
		 <!-- The Modal -->
		<div class="modal" id="myModal<?= $row['idAppointment'] ?>">
		 <div class="modal-dialog">
		  <div class="modal-content">
		   <!-- Modal Header -->
		   <div class="modal-header">
			<h4 class="modal-title"><?= $row['title'] ?></h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		   </div>
		   <!-- Modal body -->
		   <div class="modal-body">
			<br><b><u><?= $row['object'] ?></u></b> :<br><br>
			<p><?= $row['content'] ?></p>  
		   </div>
		   <!-- Modal footer -->
		   <div class="modal-footer">
			<?= form_open('monitor/update_appointment'); ?>
			    <input type="hidden" name="idAppointment" value="<?= $row['idAppointment'] ?>">
				<button type="input" name="authorization" value="1" class="btn btn-success text-white">Accepter</button>
				<button type="input" name="authorization" value="0" class="btn btn-warning text-white">Refuser</button>
			   <a class="btn btn-danger" href="<?= site_url('monitor/delete_appointment/' . $row['idAppointment']) ?>"><i class="fa fa-trash"></i></a>
			</form>
			<button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
		   </div>
		  </div>
		 </div>
		</div>
        </tr>
        <?php } endforeach; ?>
      </tbody>
    </table>
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