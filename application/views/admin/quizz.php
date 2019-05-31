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
      <a class="nav-link active" href="<?= site_url('admin/quizz') ?>">Quizz</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= site_url('admin/certificats') ?>">Certificats</a>
    </li>
	     <li class="nav-item">
      <a class="nav-link" href="<?= site_url('admin/vehicules') ?>">Vehicules</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" target="blank" href="https://analytics.google.com/analytics/web/?authuser=0#/report-home/a137353005w197830555p192588774">Statistique Google</a>
    </li>
  </ul> 
        
<div class="container">
  <div class="card-deck mt-5">
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal text-center">Création d'une question</h4>
      </div>
      <div class="card-body">
        <div class="list-unstyled mt-3 mb-4">
          <h3>Saisir la question</h3>
          <?= form_open('admin/add_question') ?>
            <div class="form-group">
              <label >* Question (<label class="text-danger">Le point d'intérrogation est automatique</label>)</label>
              <input type="text" class="form-control" name="question">
              <input type="submit" class="btn btn-success mt-3">
            </div>
          </form>
        </div>
      </div>
      <div class="card-body">
        <div class="list-unstyled mt-3 mb-4">
          <h3>Affectation des réponses</h3>
          <?= form_open('admin/add_answers') ?>
          <div class="form-group col-12 col-md-6">
                <label for="inputState">* Question</label>
                <select id="inputState" class="form-control" name="idquestion">
                    <option selected disabled>Sélectionner une Question</option>
                    <?php foreach ($get_quizzQuestions as $question): ?>
                        <option value="<?= $question['idQuestion'] ?>"><?= $question['question'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="inputtel">* Réponse</label>
                <input type="text" class="form-control" id="inputtel" name="reply">
            </div>
            <div class="form-group col-12 col-md-6">
                <label for="inputState">* Bonne ou Mauvaise réponse </label>
                <select id="inputState" class="form-control" name="correct">
                    <option selected disabled>Sélectionner réponse</option>
                        <option value="1">Bonne réponse</option>
                        <option value="0">Mauvaise réponse</option>
                </select>
                <input type="submit" class="btn btn-success mt-3">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

        <h2>Liste des Questions</h2>
        <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr class="text-center">
                <th>#</th>
                <th>Question</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($get_quizz as $row):?>
				
              <tr class="text-center">
                <td><?= $row['Id_Question'] ?></td>
                <td><?= $row['Question'] ?></td>
                <td><button type="button" class="btn btn-warning text-white" data-toggle="collapse" data-target="#modifier<?= $row['Id_Question'] ?>">Modifier</button></td>
                <td><a type="submit" class="btn btn-danger text-white" href="<?= site_url('admin/delete_question_quizz/' . $row['Id_Question']) ?>">Supprimer</a></td>
              </tr>
              <tr id="modifier<?= $row['Id_Question'] ?>" class="collapse">
              <td></td>
              <td>
                <div class="card-body">
                  <div class="list-unstyled mt-3 mb-4">
                    <h3>Modifier une réponse</h3>
                    
                    <?= form_open('admin/update_answers') ?>
                    <div class="form-group col-12 col-md-6">
                          <label for="inputState">Réponse est :</label>
                          <select id="inputState" class="form-control" name="IdReponse">
                            <?php $reponse = $row['Reponse']; $rep = explode(",", $reponse); ?>
							  <?php foreach($rep as $row1){ ?>
                            <option value="<?= $row['Id_Reponse'] ?>">
								<?= $row1 ?>
							</option>
							  <?php } ?>
                          </select>
                      </div>
                      <div class="form-group col-12 col-md-6">
                          <label for="inputtel">* Modifier la réponse</label>
                          <input type="text" class="form-control" id="inputtel" name="reponse">
                      </div>
                      <div class="form-group col-12 col-md-6">
                          <label for="inputState">* sélectionner la réponse</label>
                          <select id="inputState" class="form-control" name="correct">
                              <option selected disabled value="<?= $row['Correct'] ?>">sélectionner la réponse</option>
                                  <option value="1">Bonne réponse</option>
                                  <option value="0">Mauvaise réponse</option>
                          </select>
                          <input type="hidden" name="IdReponse" value="<?= $row['Id_Reponse'] ?>">
                          <input type="hidden" name="IdQuestion" value="<?= $row['Id_Question'] ?>">
                          <input type="submit" class="btn btn-success mt-3">
                      </div>
                    </form>
                  </div>
                </div>
              </td>
                </div>
                <td>
				<b class="text-danger">Mauvaise réponse</b><br>
				<b class="text-success mb-5">Bonne réponse</b><br><hr>
				<div class="mt-2">
			     <?php foreach($get_quizzAnswers AS $row1){ ?>
				  <?php 
	  				if($row['Id_Question'] == $row1['IdQuestion'])
					{
						if($row1['correct'] == 1){
							echo '<span class="text-success">'.$row1['reponse'].'</span><br>';
						}
						elseif($row1['correct'] != 1){
							echo '<span class="text-danger">'.$row1['reponse'].'</span><br>';
						}
					}
				  ?>
				  <?php } ?>
				 </div>
				</td>
                <td></td>
              </form>
            <?php  endforeach; ?>  
              </tr>
            </tbody>
          </table>
        </div>
      </main>
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
