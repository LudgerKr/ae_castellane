<?php 
  if(!empty($_SESSION['connect_admin']))
  {
?>
  <ul class="nav container mt-5 nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" href="<?= site_url('admin/accueil') ?>">Accueil</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('admin/user') ?>">Utilisateurs</a>
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
        
<div class="container">
  <div class="card-deck mb-3 text-center">
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Création Séance</h4>
      </div>
      <div class="card-body">
        <div class="list-unstyled mt-3 mb-4">
          <h3>Date</h3>
          <?= form_open('admin/accueil') ?>
            <input type="date" name="date"> / 
            <input type="time" name="time"><br>
            <button type="submit" class="btn btn-danger mt-3">Envoyer</button>
          </form>
        </div>
      </div>
    </div>

    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Définir des droits</h4>
      </div>
      <div class="card-body">
        <div class="list-unstyled mt-3 mb-4">
          <?= form_open('admin/right'); ?>
            <div class="form-row">
                <label for="inputsexe">* Email</label>
                <select id="inputS" class="form-control" name="email">
                <?php foreach ($users as $row): ?>
                        <option value="<?= $row['email'] ?>"><?= $row['email'] ?></option>
                <?php endforeach; ?>
                </select>
                <label class="mt-3" for="inputsexe">* Droits</label>
                <select id="inputS" class="form-control" name="right">
                  <option value="Utilisateur">Utilisateur</option>
                  <option value="Moniteur">Moniteur</option>
                  <option value="Administrateur">Administrateur</option>
                </select>
                <input type="submit" class="btn btn-danger mt-3">
            </div>
          </form>                  
        </div>
      </div>
    </div>
  </div>
        <h2>Liste des Administrateurs</h2>
        <div class="table-responsive">
          <table class="table table-striped table-sm" id="dataTable">
            <thead>
              <tr class="text-center">
                <th>#</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Droit</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $row): if($row['right'] != 'Utilisateur'){  ?>
              <tr class="text-center">
                <td><?= $row['iduser'] ?></td>
                <td><?= $row['lastname'] ?></td>
                <td><?= $row['firstname'] ?></td>
                <td><?= $row['email'] ?></td>
                <td>0<?= $row['phone'] ?></td>
                <td><?= $row['right'] ?></td>
                <?php   
                if($row['right'] != 'Super_Administrateur'){
                  if($row['ban'] == 0)
                  {  
                ?> 
                    <td><a type="submit" class="btn btn-danger text-white" href="<?= site_url('admin/delete_user/' . $row['iduser']) ?>">Supprimer</a></td>
                    <td><a type="submit" class="btn btn-warning text-white" href="<?= site_url('admin/ban/' . $row['iduser']) ?>">Banissement</a></td>
                <?php 
                  }
                  elseif($row['ban'] == 1)
                  {  
                ?> 
                    <td><a type="submit" class="btn btn-danger text-white" href="<?= site_url('admin/delete_user/' . $row['iduser']) ?>">Supprimer</a></td>
                    <td><a type="submit" class="btn btn-success text-white" href="<?= site_url('admin/unban/' . $row['iduser']) ?>">Débanissement</a></td>
                <?php }} ?>
              </tr>
              <?php }endforeach; ?>
            </tbody>
          </table>
          
  </div>
  </main>
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