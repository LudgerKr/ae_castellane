<?php 
  if(!empty($_SESSION['userid']))
  {
?>
<div class="container bootstrap snippet mt-5">
    <div class="row">
  		    <div class="col-sm-3"><!--left col-->
            <div class="text-center">
    </div>
        <h2>Profil</h2>
        <hr>
        <br>
            <ul class="list-group">
                <li class="list-group-item text-muted">Activiter<i class="fa fa-dashboard fa-1x"></i></li>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header">
                            <a class="collapsed card-link" data-toggle="collapse" href="#collapse">Calendrier (Session)</a>
                        </div>
                        <div id="collapse" class="collapse" data-parent="#accordion">
                            <div class="container-fluid">
                                <div class="row container">
                                    <!-- Form code begins -->
                                    <?= form_open('user/profil'); ?>
                                    <div class="form-group"> 
                                    <!-- Date input -->
                                        <label class="control-label " for="date">Inscription Session</label>
                                        
                                        <select id="inputState" class="form-control" name="insert_session">
                                            <option selected disabled>Date des sessions</option>
                                            <?php foreach ($sessions as $session): ?>
                    
                                            <?php if (!in_array($session['idseance'], array_column($get_seances, 'idseance'))): ?>
                                                <option value="<?= $session['idseance'] ?>"><?= $session['date'] .' / '. $session['time'] ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group"> <!-- Submit button -->
                                        <button class="btn btn-primary" type="submit">S'inscrire</button>
                                    </div>
                                    </form>
                                     <!-- Form code ends --> 
                                     <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Horraire</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($get_seances as $row): 
                                            if($_SESSION['userid'] == $row['ID_User'])
                                            {
                                            ?>
                                        <tr> 
                                            <td><?=$row['date']?></td>
                                            <td><?=$row['time']?></td>
                                            <th><a href="<?= site_url('user/delete_seance/' . $row['idseance']) ?>"><i class="fa fa-trash"></i></a></th>
                                        </tr>
                                            <?php }endforeach; ?>
                                    </tbody>
                                </table>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">Mes articles</a>
                        </div>
                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Titre</th>
                                            <th>Nom catégories</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($get_article as $row): 
                                            if($_SESSION['userid'] == $row['ID_User'])
                                            {
                                            ?>
                                        <tr>
                                            <td><?= $row['ID_Article'] ?></td>
                                            <td><a href="<?=site_url('forum/articles?categorie='.$row['ID_Catégorie'].'#myModal'.$row['ID_Article'].'')?>"><?=$row['Titre_Article']?></a></td>
                                            <td><?=$row['Nom_Catégorie']?></td>
                                        </tr>
                                        <?php }endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <a class="collapsed card-link" data-toggle="collapse" href="#collapse2">Note de quizz</a>
                        </div>
                        <div id="collapse2" class="collapse" data-parent="#accordion">
                            <div class="container-fluid">
                                <div class="row container">

                                     <!-- Form code ends --> 
                                     <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($get_resultQuizz as $row): 
                                            if($_SESSION['userid'] == $row['userid'])
                                            {
                                            ?>
                                        <tr> 
                                            <td>Vous avez obtenue la note de <?=$row['note']?>/<?=$row['nbQuestion']?></td>
                                        </tr>
                                            <?php }endforeach; ?>
                                    </tbody>
                                </table>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </ul>
        </div><!--/aside-->

    	<div class="col-sm-9">
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                <div style="margin-top:50px;"> </div>
                    <hr>
                    <?php
                        foreach($get_users as $row):
                        if($row['iduser'] == $_SESSION['userid'])
                        {
                    ?>
                    <?= form_open('user/edit_users') ?>
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6">
                                <label for="inputEmail4">Email</label>
                                <input type="email" class="form-control" id="inputEmail4" value="<?= $row['email'] ?>" required name="email">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="inputtel">* Téléphone</label>
                                <input type="tel" class="form-control" id="inputtel" name="phone" value="0<?= $row['phone'] ?>">
                            </div>
                            <hr>
                            <div class="form-group col-12 col-md-6">
                                <label for="inputState">Question</label>
                                <select id="inputState" class="form-control" name="question">
                                    <?php foreach ($questions as $question): ?>
                                        <option value="<?= $question['idquestion'] ?>"><?= $question['content'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="inputreply">Réponse</label>
                                <input type="text" class="form-control" id="inputreply" required value="<?= $row['reply'] ?>" name="reply">
                            </div>
                            <input  type="hidden" name="iduser" value="<?= $row['iduser'] ?>">
                            <input type="submit" class="btn btn-danger">
                        </div>
                    </form>
          <?php 
              } endforeach;
          ?>
                </div><!--/tab-pane-->
            </div>
        </div><!-- /col-sm-9 -->
<?php 
}else{
  echo '  
    <div class="alert alert-danger mt-5 container">
        <strong>Attention !</strong> Vous devez vous connecter pour accéder au site <a class="alert-link" href="'. site_url('user/signin').'">Se connecter</a>.
    </div>
';
}
?>

