<div class="container">
	<h3 class="mt-5">Formulaire de rendez-vous</h3>
	<hr>
	<?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
	<?= form_open('user/appointment') ?>
	  <div class="row">
		<div class="col-sm-offset-1 col-sm-8">
		  <div class="form-horizontal mt-2">
			<div class="form-group">
			  <label class="col-sm-12 control-label" for="contact-name">Sélectionner le moniteur avec qui vous voulez prendre rendez-vous :</label>
			  <div class="col-sm-10">
				  <select name="idMonitor" class="custom-select">
					<option selected>Liste moniteur</option>
					<?php 
					  foreach($userMonitor as $row):
						if($row['right'] == 'Moniteur'):
					?>
						<option value="<?= $row['iduser'] ?>"><?= $row['lastname'] ?> <?= $row['firstname'] ?></option>
					<?php
						endif;
					  endforeach;
					?>
				  </select>
			  </div>
			</div>
			<div class="form-group">
			  <label class="col-sm-4 control-label" for="contact-name">Titre :</label>
			  <div class="col-sm-10">
				<input class="form-control" type="text" id="contact-name" name="titre" placeholder="Titre">
			  </div>
			</div>
			<div class="form-group">
			  <label class="col-sm-4 control-label" for="contact-name">Objet du rendez-vous :</label>
			  <div class="col-sm-10">
				<input class="form-control" type="text" id="contact-name" name="object" placeholder="Objet">
			  </div>
			</div>
			<div class="form-group">
			  <label for="contact-message" class="col-sm-4 control-label">Message :</label>
			  <div class="col-sm-10">
				<textarea id="contact-message" cols="" rows="3" class="form-control" name="content" placeholder="Message ..."></textarea>
			  </div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
					  <h3 class="mt-5">Jour du rendez-vous</h3>
					  <hr>
					  <label class="col-sm-4 control-label" for="contact-name">Date</label>
					  <div class="col-sm-6">
						<input class="form-control" type="date" id="contact-name" name="date">
					  </div>
					  <label class="col-sm-4 control-label mt-2" for="contact-name">Horraire</label>
			  		  <div class="col-sm-6">
						<input class="form-control" type="time" id="contact-name" name="time">
					  </div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
					    <h3 class="mt-5">Heure de conduite demander</h3>
					    <hr>
			  			<label class="col-sm-6 control-label mt-2" for="contact-name">Temps de conduite</label>
			  			<div class="col-sm-6">
							<input class="form-control" type="time" id="contact-name" name="heureConduite">
					  	</div>
					</div>
				</div>
			  </div>
			<div class="form-group">
			  <div class="col-sm-offset-2 col-sm-10">
				<button class="btn btn-success btn-lg" type="submit">Demander un rendez-vous</button>
			  </div>
			</div>
		</div>	
	  </div>
	  <div class="col-sm-offset-2 col-sm-4">
		<img src="<?= site_url('assets/img/logoCastellane') ?>" alt="Erreur de chargement" width="400" height="400">
	  </div>
	</form>
</div>