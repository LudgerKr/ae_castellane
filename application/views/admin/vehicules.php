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

<canvas class="my-4 w-100 container" id="myChart" width="900" height="380"></canvas>

<div class="container mt-5">
	<div class="row">
		
		<div class="col-sm-6">
			<h3> Liste des voitures actifs</h3>
			<table class="table table-striped table-sm" id="dataTable">
			  <thead>
				<tr class="text-center">
				  <th>#</th>
				  <th>Nom voiture</th>
				  <th>Kilométrage</th>
				  <th>Plaque Immatriculation</th>
				  <th>Révision</th>
				  <th></th>
				</tr>
			  </thead>
			  <tbody>
				<?php foreach ($get_vehicles as $row): if($row['status'] == 'Occupée'): ?>
				  <tr class="text-center">
					<td><?= $row['idvehicles'] ?></td>
					<td><?= $row['brand'] ?></td>
					<td><?= $row['mileage'] ?></td>
					<td><?= $row['licenseplate'] ?></td>
					<td><?= $row['status'] ?></td>
					<td><button type="button" class="btn btn-warning text-white" data-toggle="collapse" data-target="#modifier<?= $row['idvehicles'] ?>">Modifier</button></td>
				  </tr>
				  <tr id="modifier<?= $row['idvehicles'] ?>" class="collapse text-center">
					<td class="p-4"><?= $row['idvehicles'] ?></td>
					<?= form_open('admin/edit_vehicles'); ?>
					  <td class="p-3"><input name="brand" class="form-control" type="input" value="<?= $row['brand'] ?>"></td>
					  <td class="p-3"><input name="mileage" class="form-control" type="input" value="<?= $row['mileage']?>"></td>
					  <td class="p-3"><input name="licenseplate" class="form-control" type="input" value="<?= $row['licenseplate'] ?>"></td>
					  <td class="p-3">
					     <select  id="inputsexe" class="custom-select" name="status">
							<option value="Disponible">Disponible</option>
							<option value="Occupée">Occupée</option>
							<option value="Réparation">Réparation</option>
						</select>
					  </td>
					  <td><button type="submit" class="btn btn-success text-white mt-3" data-toggle="collapse" data-target="#modifier">Modifier</button></td>
					  <td><input  type="hidden" name="idvehicles" value="<?= $row['idvehicles'] ?>"></td>
					</form> 
				
				  </tr><tr></tr>
				<?php  endif; endforeach; ?>
			  </tbody>
			</table> 
		</div>
<div class="col-sm-6">
			<h3> Liste des voitures non actifs</h3>
			<table class="table table-striped table-sm" id="dataTable">
			  <thead>
				<tr class="text-center">
				  <th>#</th>
				  <th>Nom voiture</th>
				  <th>Kilométrage</th>
				  <th>Plaque Immatriculation</th>
				  <th>Révision</th>
				  <th></th>
				</tr>
			  </thead>
			  <tbody>
				<?php foreach ($get_vehicles as $row): if($row['status'] == 'Disponible'): ?>
				  <tr class="text-center">
					<td><?= $row['idvehicles'] ?></td>
					<td><?= $row['brand'] ?></td>
					<td><?= $row['mileage'] ?></td>
					<td><?= $row['licenseplate'] ?></td>
					<td><?= $row['status'] ?></td>
					<td><button type="button" class="btn btn-warning text-white" data-toggle="collapse" data-target="#modifier<?= $row['idvehicles'] ?>">Modifier</button></td>
				  </tr>
				  <tr id="modifier<?= $row['idvehicles'] ?>" class="collapse text-center">
					<td class="p-4"><?= $row['idvehicles'] ?></td>
					<?= form_open('admin/edit_vehicles'); ?>
					  <td class="p-3"><input name="brand" class="form-control" type="input" value="<?= $row['brand'] ?>"></td>
					  <td class="p-3"><input name="mileage" class="form-control" type="input" value="<?= $row['mileage']?>"></td>
					  <td class="p-3"><input name="licenseplate" class="form-control" type="input" value="<?= $row['licenseplate'] ?>"></td>
					  <td class="p-3">
					     <select  id="inputsexe" class="custom-select" name="status">
							<option value="Disponible">Disponible</option>
							<option value="Occupée">Occupée</option>
							<option value="Réparation">Réparation</option>
						</select>
					  </td>
					  <td><button type="submit" class="btn btn-success text-white mt-3" data-toggle="collapse" data-target="#modifier">Modifier</button></td>
					  <td><input  type="hidden" name="idvehicles" value="<?= $row['idvehicles'] ?>"></td>
					</form> 
				
				  </tr><tr></tr>
				<?php  endif; endforeach; ?>
			  </tbody>
			</table> 
		</div>
	</div>
		<div class="mt-5">
			<h3> Liste des voitures en révisions </h3><hr>
		    <table class="table table-striped table-sm" id="dataTable">
			  <thead>
				<tr class="text-center">
				  <th>#</th>
				  <th>Nom voiture</th>
				  <th>Kilométrage</th>
				  <th>Plaque Immatriculation</th>
				  <th>Révision</th>
				  <th></th>
				</tr>
			  </thead>
			  <tbody>
				<?php foreach ($get_vehicles as $row): if($row['status'] == 'Réparation'): ?>
				  <tr class="text-center">
					<td><?= $row['idvehicles'] ?></td>
					<td><?= $row['brand'] ?></td>
					<td><?= $row['mileage'] ?></td>
					<td><?= $row['licenseplate'] ?></td>
					<td><?= $row['status'] ?></td>
					<td><button type="button" class="btn btn-warning text-white" data-toggle="collapse" data-target="#modifier<?= $row['idvehicles'] ?>">Modifier</button></td>
				  </tr>
				  <tr id="modifier<?= $row['idvehicles'] ?>" class="collapse text-center">
					<td class="p-4"><?= $row['idvehicles'] ?></td>
					<?= form_open('admin/edit_vehicles'); ?>
					  <td class="p-3"><input name="brand" class="form-control" type="input" value="<?= $row['brand'] ?>"></td>
					  <td class="p-3"><input name="mileage" class="form-control" type="input" value="<?= $row['mileage']?>"></td>
					  <td class="p-3"><input name="licenseplate" class="form-control" type="input" value="<?= $row['licenseplate'] ?>"></td>
					  <td class="p-3">
					     <select  id="inputsexe" class="custom-select" name="status">
							<option value="Disponible">Disponible</option>
							<option value="Occupée">Occupée</option>
							<option value="Réparation">Réparation</option>
						</select>
					  </td>
					  <td><button type="submit" class="btn btn-success text-white mt-3" data-toggle="collapse" data-target="#modifier">Modifier</button></td>
					  <td><input  type="hidden" name="idvehicles" value="<?= $row['idvehicles'] ?>"></td>
					</form> 
				
				  </tr><tr></tr>
				<?php  endif; endforeach; ?>
			  </tbody>
			</table> 
		</div>

		<div class="mt-5">
			<div class="row">
				<h3 class="border-bottom border-gray pb-2 col-sm-8 mb-0"> Liste de toute les voitures </h3> 
				<a class="btn btn-success text-white action-button col-sm-4" data-toggle="collapse" data-target="#demo">Ajouter un nouveau véhicule</a>
            </div>
			  <div id="demo" class="collapse">
				  <?= form_open('admin/add_vehicles'); ?>
					<div class="row mt-3">
					  <div class="form-group col-sm-6">
						<label for="title">Marque de la voiture </label>
						<input name="brand" class="form-control" type="input">
					  </div>
					  <div class="form-group col-sm-6">
					  <label for="inputState">Statut</label>
					     <select  id="inputsexe" class="custom-select" name="status">
							<option value="Disponible">Disponible</option>
							<option value="Occupée">Occupée</option>
							<option value="Réparation">Réparation</option>
						</select>
					  </div>
					</div>
				    <div class="row mt-3">
					 <div class="form-group col-sm-6">
						<label for="comment">Kilométrage :</label>
						<input name="mileage" class="form-control" type="number">
					  </div>
				  	   <div class="form-group col-sm-6">
						<label for="comment1">Plaque immatriculation :</label>
						<input name="licenseplate" class="form-control" type="input" placeholder="" >
					  </div>
				  </div>
					  <button type="submit" class="btn btn-success">Ajouter</button>
					</form><hr>
				  </div>

		    <table class="table table-striped table-sm" id="dataTable">
			  <thead>
				<tr class="text-center">
				  <th>#</th>
				  <th>Nom voiture</th>
				  <th>Kilométrage</th>
				  <th>Plaque Immatriculation</th>
				  <th>Révision</th>
				  <th></th>
				  <th></th>
				</tr>
			  </thead>
			  <tbody>
				<?php foreach ($get_vehicles as $row): ?>
				  <tr class="text-center">
					<td><?= $row['idvehicles'] ?></td>
					<td><?= $row['brand'] ?></td>
					<td><?= $row['mileage'] ?></td>
					<td><?= $row['licenseplate'] ?></td>
					<td><?= $row['status'] ?></td>
					<td><button type="button" class="btn btn-warning text-white" data-toggle="collapse" data-target="#modifier<?= $row['idvehicles'] ?>">Modifier</button></td>
					<td><a class="btn btn-danger text-white" href="<?= site_url('monitor/delete_vehicles/' . $row['idvehicles']) ?>">Supprimer</a></td>
					
				  </tr>
				  
				  <tr id="modifier<?= $row['idvehicles'] ?>" class="collapse text-center">
					<td class="p-4"><?= $row['idvehicles'] ?></td>
					<?= form_open('admin/edit_vehicles'); ?>
					  <td class="p-3"><input name="brand" class="form-control" type="input" value="<?= $row['brand'] ?>"></td>
					  <td class="p-3"><input name="mileage" class="form-control" type="input" value="<?= $row['mileage']?>"></td>
					  <td class="p-3"><input name="licenseplate" class="form-control" type="input" value="<?= $row['licenseplate'] ?>"></td>
					  <td class="p-3">
					     <select  id="inputsexe" class="custom-select" name="status">
							<option value="Disponible">Disponible</option>
							<option value="Occupée">Occupée</option>
							<option value="Réparation">Réparation</option>
						</select>
					  </td>
					  <td><button type="submit" class="btn btn-success text-white mt-3" data-toggle="collapse" data-target="#modifier">Modifier</button></td>
					  <td><input  type="hidden" name="idvehicles" value="<?= $row['idvehicles'] ?>"></td>
					</form> 
				  </tr>
				<?php endforeach; ?>
			  </tbody>
			</table> 
		</div>

	<h1 class="mt-5">Formulaire fin de conduite</h1><hr>
	<?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
	<?= form_open('admin/form_add') ?>  
	  <div class="form-row">
		<div class="form-group col-12 col-md-6">
			<label for="inputEmail4">Sélectionner le véhicule</label>
			<select id="inputState" class="form-control" name="idVehicule">
				<option selected disabled>Sélectionner le véhicule</option>
				<?php foreach ($get_vehicles as $vehicle): ?>
					<option value="<?= $vehicle['idvehicles'] ?>"><?= $vehicle['brand'] ?></option>
				<?php endforeach; ?>
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