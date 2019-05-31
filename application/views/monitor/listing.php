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
      <a class="nav-link" href="<?= site_url('monitor/vehicule') ?>">Véhicule</a>
    </li>
  </ul>
 <div class="container">
		<div class="mt-5">
		  <h2>Liste des utilisteurs inscrits pour la seance <?= $_GET['seance']?></h2><hr>
		  <div class="table-responsive container">
		<?= form_open('monitor/listing') ?> 
			<table class="table table-striped table-sm" id="dataTable">
			  <thead>
				<tr class="text-center">
				  <th>Nom</th>
				  <th>Prénom</th>
				  <th></th>
				  <th></th>
				</tr>
			  </thead>
			  <tbody>
				<?php foreach ($seanceAll as $row): if($_GET['seance'] == $row['Id_Seance']):?>
				  <tr class="text-center">
					<td><?= $row['Nom'] ?></td>
					<td><?= $row['Prenom'] ?></td>
					  <td>    
						<label class="btn btn-outline-success active">
    						<input name="result[]" value="1" type="checkbox" autocomplete="off"> Présent
  						</label>
					  </td>
					  <td>    
						<label class="btn btn-outline-danger active">
    						<input name="result[]" value="0" type="checkbox" autocomplete="off"> Absent
  						</label>
					  </td>
					<td><input  type="hidden" name="idseance[]" value="<?= $_GET['seance'] ?>"></td>
					<td><input  type="hidden" name="iduser[]" value="<?= $row['ID_User'] ?>"></td>
				  </tr>
				<?php endif; endforeach; ?>
			  </tbody>
				<tfoot>
					<tr>
						<td></td>
						<td><button type="submit" class="btn btn-success mt-3">Confimer la liste</button></td>
						<td></td>
						<td></td>
						<td></td>		
					</tr>
				</tfoot>
			 </table>
		   </form>
			  
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