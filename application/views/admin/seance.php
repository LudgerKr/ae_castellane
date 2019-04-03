<?php 
  if(!empty($_SESSION['connect_admin']))
  {
?>
<ul class="nav container mt-5 nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="<?= site_url('admin/accueil') ?>">Accueil</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?= site_url('admin/user') ?>">Utilisateurs</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="<?= site_url('admin/seance') ?>">Séances</a>
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
</ul>

<canvas class="my-4 w-100 container" id="myChart" width="900" height="380"></canvas>

<div class="container">

  <div class="card-deck mb-3 mt-5 text-center">
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Création Séance</h4>
      </div>
      <div class="card-body">
        <div class="list-unstyled mt-3 mb-4">
          <h3>Date</h3>
          <?= form_open('admin/seance') ?>
            <input type="date" name="i_date"> / 
            <input type="time" name="i_time"><br>
            <button type="submit" class="btn btn-success mt-3">Envoyer</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <h2>Liste des séances</h2><hr>
  <div class="table-responsive container">
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
        <?php foreach ($seances as $row): ?>
          <tr class="text-center">
            <td><?= $row['idseance'] ?></td>
            <td><?= $row['date'] ?></td>
            <td><?= $row['time'] ?></td>
            <td><?= $row['users_sum'] ?></td>
            <td><button type="button" class="btn btn-warning text-white" data-toggle="collapse" data-target="#modifier<?= $row['idseance'] ?>">Modifier</button></td>
            <td><a type="submit" class="btn btn-danger text-white" href="<?= site_url('admin/delete_seance/' . $row['idseance']) ?>">Supprimer</a></td>
          </tr>
          <tr id="modifier<?= $row['idseance'] ?>" class="collapse text-center">
            <td class="p-4"><?= $row['idseance'] ?></td>
            <?= form_open('admin/edit_seance'); ?>
              <td class="p-3"><input type="date" class="form-control" name="in_date" value="<?= $row['date'] ?>"></td>
              <td class="p-3"><input type="time" class="form-control" name="in_time" value="<?= $row['time']?>"></td>
              <td></td>
              <td><button type="submit" class="btn btn-warning text-white mt-3" data-toggle="collapse" data-target="#modifier">Modifier</button></td>
              <td><input  type="hidden" name="idseance" value="<?= $row['idseance'] ?>"></td>
            </form> 
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table> 
  </div>

</div><!-- end content -->

<!--========= SCRIPT =========-->
  
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
        labels: [<?php foreach ($seances as $row): ?>"<?= $row['date'] ?> / <?= $row['time'] ?>",<?php endforeach; ?>],
        datasets: [{
        data: [<?php foreach ($seances as $row): ?>"<?= $row['users_sum'] ?>",<?php endforeach; ?>],
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
  }
  else
  {
    echo '  
    <div class="alert alert-danger container mt-5">
      <strong>Danger !</strong> Vous n\'êtes pas autoriser à accéder à cette page.
    </div>
    ';
  }
?>