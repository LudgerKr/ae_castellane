<?php 
  if(!empty($_SESSION['connect_monitor']))
  {
?>
  <ul class="nav container mt-5 nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" href="<?= site_url('monitor/accueil') ?>">Accueil</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" href="<?= site_url('monitor/appointment') ?>">Mes rendez-vous</a>
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

	<div class="container">
	
	<canvas class="my-4 w-100 container" id="myChart" width="900" height="380"></canvas>
        
	<div class="container">
	  <div class="card-deck mb-3 text-center">
		<div class="card mb-4 shadow-sm">
		  <div class="card-header">
			<h4 class="my-0 font-weight-normal">Création Séance</h4>
		  </div>
		  <div class="card-body">
			<div class="list-unstyled mt-3 mb-4">
			  <h3>Date</h3>
			  <?= form_open('monitor/accueil') ?>
				<input type="date" name="date"> / 
				<input type="time" name="time"><br>
				<button type="submit" class="btn btn-danger mt-3">Envoyer</button>
			  </form>
			</div>
		  </div>
		</div>
	   </div>
		
		<div class="row">
		
		<div class="col-sm-4">
		
		  <h3 class="text-center">Dernier rendez-vous</h3>
			<hr class="container">
			<?php foreach($get_appointment_all as $row): 
   					if($_SESSION['connect_monitor'] == $row['idMonitor']){
   						if($row['authorization'] == null){ ?>
		  <div class="toast" data-autohide="false">
			<div class="toast-header">
			  <strong class="mr-auto text-primary"><u><b><?= $row['lastname']?> <?= $row['firstname']?></b></u></strong>
			  <small class="text-muted"><?= $row['date']?> / <?= $row['horraire']?></small>
			  <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
			</div>
			<div class="toast-body">
			  <u><?= $row['object']?> : </u>
			  <br>
			  <?= $row['content']?><br>
				Je vous demande <b><?= $row['timeconduite']?></b> heures de conduite.
			</div>
			<div class="btn-group container">
			  <?= form_open('monitor/update_appointment_1'); ?>
			    <input type="hidden" name="idAppointment" value="<?= $row['idAppointment'] ?>">
				<button type="input" name="authorization" value="1" class="btn btn-sm m-1 btn-outline-success" data-dismiss="toast" >Accepter</button>
				<button type="input" name="authorization" value="0" class="btn btn-sm m-1 btn-outline-warning" data-dismiss="toast" >Refuser</button>
			   <a class="btn btn-danger" href="<?= site_url('monitor/delete_appointment/' . $row['idAppointment']) ?>" data-dismiss="toast" ><i class="fa fa-trash"></i></a>
			</form>
			</div>
		  </div>
			<?php }} endforeach; ?>
		</div>
		
		<div class="col-sm-4"></div>
		
		<div class="col-sm-4">
	
		  <h3 class="text-center">Actuellement disponible</h3>
		  <hr class="container">
		  <?php foreach($get_vehicle as $row2): 
   						if($row2['status'] == 'Disponible'){ ?>
		  <div class="toast" data-autohide="false">
			<div class="toast-header">
			  <strong class="mr-auto text-primary"><u><b><?= $row2['status']?></b></u></strong>
			  <small class="text-muted"><?= $row2['mileage']?> Klm</small>
			  <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
			</div>
			<div class="toast-body">
			  <u>Vehicule de la marque <b><?= $row2['brand']?></b> avec la plaque d'immatriculation <?= $row2['licenseplate']?> </u>
			</div>
			<div class="btn-group container">
			</div>
		  </div>
			<?php } endforeach; ?>
		</div>
		</div>	
	</div>

    </div>
  <!-- Icons -->
  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace()
  </script>

<!-- Graphs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
  type: 'line',
  data: {
	labels: [<?php foreach ($seance as $row): ?>"<?= $row['date'] ?> / <?= $row['time'] ?>",<?php endforeach; ?>],
	datasets: [{
	data: [<?php foreach ($regroup as $row): ?>"<?= $row['users_sum'] ?>",<?php endforeach; ?>],
	  lineTension: 0,
	  backgroundColor: 'transparent',
	  borderColor: '#007bff',
	  borderWidth: 4,
	  pointBackgroundColor: '#007bff'
	}]
  },
  options: {
	scales: {
	  yAxes: [{
		ticks: {
		  beginAtZero: false
		}
	  }]
	},
	legend: {
	  display: false,
	}
  }
});
</script>
<script>
$(document).ready(function(){
$("#myBtn").click(function(){
$('.toast').toast('show');
});
});
</script>
<?php 
}else{
  echo '  
  <div class="alert alert-danger container mt-5">
    <strong>Danger !</strong> Vous n\'êtes pas autoriser à accéder à cette page.
  </div>
';
}
?>