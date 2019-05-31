<?php 
  if(!empty($_SESSION['connect_monitor']))
  {
?>
  <ul class="nav container mt-5 nav-tabs">
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('monitor/accueil') ?>">Accueil</a>
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
      <a class="nav-link active" href="<?= site_url('monitor/vehicule') ?>">Véhicule</a>
    </li>
  </ul>

  <canvas class="my-4 w-100 container" id="myChart" width="900" height="380"></canvas>

<div class="container mt-5">
    <h1 class="mt-5">Réservation</h1><hr>
	<?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
	<?= form_open('monitor/reserv') ?>  
	  <div class="form-row">
		<div class="form-group col-12 col-md-6">
			<label for="inputEmail4">Sélectionner le véhicule</label>
			<select id="inputState" class="form-control" name="idVehicule">
				<option selected disabled>Sélectionner le véhicule</option>
				<?php foreach ($get_vehicles as $vehicle): if($vehicle['status'] == 'Disponible'):?>
					<option value="<?= $vehicle['idvehicles'] ?>"><?= $vehicle['brand'] ?></option>
				<?php endif; endforeach; ?>
			</select>
		</div>
	    <div class="form-group col-12 col-md-6">
			<label for="inputEmail4">Sélectionner la Date</label>
			<select id="inputState" class="form-control" name="idDate">
				<option selected disabled>Sélectionner la Date</option>
				<?php foreach($get_appointments as $date): if($date['idMonitor'] == $_SESSION['connect_monitor']): ?>
					<option value="<?= $date['idAppointment'] ?>"><?= $date['date'] ?> / <?= $date['horraire'] ?> avec <?= $date['lastname'] ?> <?= $date['firstname'] ?></option>
				<?php endif; endforeach; ?>
			</select>
		</div>   
		<div class="form-group col-md-6">
		  <input type="hidden" name="idMonitor" value="<?= $_SESSION["connect_monitor"]?>">
		  <input type="submit" class="btn btn-success">
		</div> 
	  </form>
</div>
	<h1 class="mt-5">Formulaire fin de conduite</h1><hr>
	<?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
	<?= form_open('monitor/form_add') ?>  
	  <div class="form-row">
		<div class="form-group col-12 col-md-6">
			<label for="inputEmail4">Sélectionner le véhicule</label>
			<select id="inputState" class="form-control" name="idVehicule">
				<option selected disabled>Sélectionner le véhicule</option>
				<?php foreach ($get_vehicles as $vehicle): if($vehicle['status'] == 'Occupée'): ?>
					<option value="<?= $vehicle['idvehicles'] ?>"><?= $vehicle['brand'] ?></option>
				<?php endif; endforeach; ?>
			</select>
		</div>
		<div class="form-group col-md-6">
			<label for="inputPassword4">Nombre de klm a ajouter</label>
			<input type="number" class="form-control" id="inputPassword4" required name="mileage">
		</div>
		<div class="form-group col-md-6">
		  <input type="submit" class="btn btn-danger">
		</div> 
	  </form>
</div>

<!-- Graphs Seance -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
  <script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ["Utilisé","Non Utilisé","Réparation"],
        datasets: [{
        data: ["1","1","1"],
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

<?php 
}else{
  echo '  
  <div class="alert alert-danger container mt-5">
    <strong>Danger !</strong> Vous n\'êtes pas autoriser à accéder à cette page.
  </div>
';
}
?>
