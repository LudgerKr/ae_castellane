<?php if(!empty($_SESSION['connect_monitor']))
{
  header('Location:'.site_url('monitor/accueil'));
}
?>

<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-6 p-4">
        <div class="card">
          <div class="card-header">Moniteur</div>
            <div class="card-body">
              <?= form_open('monitor/signin') ?>  
              <div class="form-row">
                <div class="form-group col-12 col-md-6">
                    <label for="inputEmail4">* Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="jean@castellane.com" required name="email">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">* Mot de passe</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="*******" required name="password">
                </div>
                <div class="form-group col-md-6"><br>
                  <input type="submit" class="btn btn-danger">
                </div> 
              </form>
              <p><?= validation_errors() ?></p>
            </div>
          </div>
        </div>
      </div>
</div>