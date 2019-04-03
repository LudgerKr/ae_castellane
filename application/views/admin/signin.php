<?php if(!empty($_SESSION['connect_admin']))
{
  header('Location:'.site_url('admin/accueil'));
}
?>

<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-6 p-4">
        <div class="card">
          <div class="card-header">Administrateur</div>
            <div class="card-body">
            <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            <?= form_open('admin/signin') ?>  
              <div class="form-row">
                <div class="form-group col-12 col-md-6">
                    <label for="inputEmail4">* Email</label>
                    <input type="text" class="form-control" id="inputEmail4" placeholder="jean@castellane.com" name="email">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">* Mot de passe</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="*******" required name="password">
                </div>
                <div class="form-group col-md-6">
                  <a href="<?= site_url("admin/generer")?>"> Mot de passe oublier ?</a><br>
                  <input type="submit" class="btn btn-danger">
                </div> 
              </form>
            </div>
          </div>
        </div>
      </div>
</div>