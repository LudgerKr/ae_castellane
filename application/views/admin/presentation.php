<?php if(!empty($_SESSION['connect_admin']))
{
  header('Location:'.site_url('admin/accueil'));
}
?>
<?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
<?= form_open('admin/presentation') ?>  
  <div class="form-row">
	<div class="form-group col-12 col-md-6">
		<label for="inputEmail4">* titre</label>
		<input type="text" class="form-control" id="inputEmail4" placeholder="jean@castellane.com" name="email">
	</div>
	<div class="form-group col-md-6">
		<label for="inputPassword4">* contenu</label>
		<input type="password" class="form-control" id="inputPassword4" placeholder="*******" required name="password">
		<input type="hidden" name="userid" value="<?=$_SESSION['connect_admin']?>">
	</div>
	<div class="form-group col-12 col-md-6">
		<label for="inputState">Categorie</label>
		<select id="inputState" class="form-control" name="idcategorie">
			<option selected disabled>Sélectionner une categorie</option>
			<?php foreach ($get_categories as $categorie): ?>
				<option value="<?= $categorie['idcategorie'] ?>"><?= $categorie['name'] ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="form-group col-md-6">
	  <input type="submit" class="btn btn-danger">
	</div> 
</form>