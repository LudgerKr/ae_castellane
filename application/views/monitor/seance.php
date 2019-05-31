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
      <a class="nav-link active" href="<?= site_url('monitor/seance') ?>">Séances</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('monitor/vehicule') ?>">Véhicule</a>
    </li>
  </ul>

  <canvas class="my-4 w-100 container" id="myChart" width="900" height="380"></canvas>

  <div class="container">
   <div class="row">

	 <div class="col-md-4 order-md-2 mb-4"> 
	  <div class="card-deck mb-3 mt-5 text-center">
		<div class="card mb-4 shadow-sm">
		  <div class="card-header">
			<h4 class="my-0 font-weight-normal">Création Séance</h4>
		  </div>
		  <div class="card-body">
			<div class="list-unstyled mt-3 mb-4">
			  <h3>Date</h3>
			  <?= form_open('monitor/seance') ?>
				<input type="date" name="i_date"> / 
				<input type="time" name="i_time"><br>
				<button type="submit" class="btn btn-success mt-3">Envoyer</button>
			  </form>
			</div>
		  </div>
		</div>
	   </div>
	  </div>

	  <div class="col-md-8 order-md-1">
		  <h2>Liste des séances</h2><hr>
		  <div class="table-responsive">
			<table class="table table-striped table-sm" id="dataTable">
			  <thead>
				<tr class="text-center">
				  <th>#</th>
				  <th>Date</th>
				  <th>Heure</th>
				  <th>Nombre de membres inscrits</th>
				  <th></th>
				  <th></th>
				</tr>
			  </thead>
			  <tbody>
				<?php foreach ($regroup as $row): ?>
				  <tr class="text-center">
					<td><?= $row['idseance'] ?></td>
					<td><?= $row['date'] ?></td>
					<td><?= $row['time'] ?></td>
					<td><?= $row['users_sum'] ?></td>
					<td><button type="button" class="btn btn-warning text-white" data-toggle="collapse" data-target="#modifier<?= $row['idseance'] ?>">Modifier</button></td>
					<td><a type="submit" class="btn btn-danger text-white" href="<?= site_url('monitor/delete_seance/' . $row['idseance']) ?>">Supprimer</a></td>
				  </tr>
				  <tr id="modifier<?= $row['idseance'] ?>" class="collapse text-center">
					<td class="p-4"><?= $row['idseance'] ?></td>
					<?= form_open('monitor/edit_seance'); ?>
					  <td class="p-3"><input type="date" class="form-control" name="in_date" value="<?= $row['date'] ?>"></td>
					  <td class="p-3"><input type="time" class="form-control" name="in_time" value="<?= $row['time']?>"></td>
					  <td></td>
					  <td><button type="submit" class="btn btn-success text-white mt-3" data-toggle="collapse" data-target="#modifier">Modifier</button></td>
					  <td><input  type="hidden" name="idseance" value="<?= $row['idseance'] ?>"></td>
					</form> 
				  </tr>
				<?php endforeach; ?>
			  </tbody>
			</table> 
		  </div>
		</div>

	</div><!-- end row -->
	<div class="row">

	 <div class="col-md-4 order-md-2 mb-4 mt-3">
 		<?php
   		  foreach($countListing as $row): 
		?>
		 <button  class="btn btn-info m-1" data-toggle="collapse" data-target="#demo<?= $row['idseance']?>">Séance <?= $row['idseance']?> du <?= $row['date']?> / <?= $row['time']?></button>
		<div id="demo<?= $row['idseance']?>" class="collapse">
			<table class="table table-striped table-sm">
							<thead>
								<tr>
									<th>Nom</th>
									<th>Prénom</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							<?php 
								foreach($listingAll as $row1):
								 if($row['idseance'] == $row1['Id_seance']):
							?>
							<tr>
								<td><?= $row1['Nom'] ?></td>
								<td><?= $row1['Prenom'] ?></td>
								<td>
								<?php if($row1['résultat'] == 1)
								{
									echo 'Présent';
								}
								elseif($row1['résultat'] == 0)
								{
									echo 'Absent';
								}?>
								</td>
							</tr>
								<?php 
										endif;
									endforeach;
								?>
							</tbody>
						</table>
		</div>
		 		<?php
   			endforeach;
  		?>
	 </div>
		
	<div class="col-md-8 order-md-1">
	  <div class="row">
	 	<?php foreach($regroup as $row): ?>
		 <div class="col-md-4 mb-4">
		  <div class="card-deck mb-3 mt-5 text-center">
			<div class="card mb-4 shadow-sm">
			  <div class="card-header">
				<h4 class="my-0 font-weight-normal">Seance <?= $row['idseance'] ?></h4>
			  </div>
			  <div class="card-body">
				<div class="list-unstyled mt-3 mb-4">
				  <h3><?= $row['date'] ?> / <?= $row['time'] ?></h3>
				  <p>
					Il y a <?php echo '<b>'.$row['users_sum'].'</b>'; ?> de membre(s) inscrit(s)
				  </p>
				  <a class="btn btn-success mt-3" href="<?= site_url('monitor/listing') ?>?seance=<?= $row['idseance'] ?>">Voir la liste des inscrits</a>
				</div>
			  </div>
			</div>
		   </div>
		  </div>
		<?php endforeach; ?>
	   </div>
	</div><!-- end row -->
		
</div>

  <!-- Icons -->
  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  
  <script>
    feather.replace()
  </script>

  <!-- Graphs Seance -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
  <script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [<?php foreach ($regroup as $row): ?>"<?= $row['date'] ?> / <?= $row['time'] ?>",<?php endforeach; ?>],
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
<?php 
}else{
  echo '  
  <div class="alert alert-danger container mt-5">
    <strong>Danger !</strong> Vous n\'êtes pas autoriser à accéder à cette page.
  </div>
';
}
?>