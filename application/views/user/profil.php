<?php 
  if(!empty($_SESSION['userid'])){
?>
<div class="container bootstrap snippet mt-5">
    <div class="row">
        <div class="col-sm-3"><!--left col-->
            <h2>Profil</h2>
            <hr><br>
            <ul class="list-group">
                <li class="list-group-item text-muted">Activiter <i class="fa fa-dashboard fa-1x"></i></li>
                    <div id="accordion">
					   <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#collap">Mes heures de conduites</a>
                            </div>
                            <div id="collap" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Numéro</th>
                                                <th>Jour</th>
											    <th>heure de conduite</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<p class="text-danger">En cours </p><p class="text-success">Accepter</p>
                                            <?php 
								  				foreach ($get_appointment as $row):
	  											  if($_SESSION['userid'] == $row['iduser']){ 
											?>
                                            <tr class="<?php if($row['authorization'] == '0'){echo"bg-danger text-white";}elseif($row['authorization'] == '1'){echo"bg-success text-white";}?>">
 												<td><?= $row['idAppointment']?></td>
												<td><?= $row['date']?>  <?= $row['horraire']?></td>
												<td><?= $row['timeConduite']?></td>
                                            </tr>
                                            <?php } endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
                                                <select id="inputState" class="form-control mt-3" name="insert_session">
                                                    <option selected disabled>Date des sessions</option>
                                                    <?php foreach ($sessions as $session): ?>
                                                        <option value="<?= $session['idseance'] ?>"><?= $session['date'] .' / '. $session['time'] ?></option>
                                                    <?php endforeach;?>
                                                </select>
                                                <button class="btn btn-primary mt-1" type="submit">inscription</button>
                                            </div>
                                        </form><!-- Form code ends --> 
										
                                        <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Horraire</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    foreach ($get_seances as $row): 
                                                        if($_SESSION['userid'] == $row['ID_User']): 
                                                ?>
                                                <tr> 
                                                    <td><?=$row['Date']?></td>
                                                    <td><?=$row['Time']?></td>
                                                    <th><a href="<?= site_url('user/delete_seance/' . $row['Id_Seance']) ?>"><i class="fa fa-trash"></i></a></th>
                                                </tr>
                                                <?php 
                                                        endif;
                                                    endforeach;
                                                ?>
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
				        <?php
							foreach($payment as $row):
								if($_SESSION['userid'] == $row['Id_User']):
						?>
				        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-toggle="collapse" href="#collapse3">Quizz</a>
                            </div>
                            <div id="collapse3" class="collapse" data-parent="#accordion">
                                <div class="card-body">
									<a class="btn btn-info action-button m-2" href="<?= site_url('user/quizz') ?>">Commencer le quizz </a>
                                </div>
                            </div>
                        </div>
						<?php
								endif;
							endforeach;
						?>
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
                                                <?php 
                                                    foreach ($get_resultQuizz as $row): 
                                                        if($_SESSION['userid'] == $row['userid']):
                                                ?>
                                                <tr> 
                                                    <td>  <?php 
          foreach($certificats as $row):
			if($_SESSION['userid'] == $row['ID_user']):
            if(isset($_POST['mailform'.$row['Nom']]))
            {
				
            $header="MIME-Version: 1.0\r\n";
            $header.='From:"ae-castellane.com"<support@castellaneauto.com>'."\n";
            $header.='Content-Type:text/html; charset="uft-8"'."\n";
            $header.='Content-Transfer-Encoding: 8bit';
  
            $message='
            <html>
<body link="#00a5b5" vlink="#00a5b5" alink="#00a5b5">

<table class=" main contenttable" align="center" style="font-weight: normal;border-collapse: collapse;border: 0;margin-left: auto;margin-right: auto;padding: 0;font-family: Arial, sans-serif;color: #555559;background-color: white;font-size: 16px;line-height: 15px;width: 300px;">
		<tr>
			<td class="border" style="border-collapse: collapse;border: 1px solid #eeeff0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;">
				<table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
					<tr>
						<td colspan="4" valign="top" class="image-section" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 10px;background-color: #fff;border-bottom: 4px solid #00a5b5">
							<a href="https://ae-castellane"><img class="top-image" src="'.site_url("assets/img/logoCastellane.png").'" style="line-height: 1;width: 100px;" alt="Castellane Logo"></a>
						</td>
					</tr>
					<tr>
						<td valign="top" class="side title" style="border-collapse: collapse;border: 0;margin: 0;padding: 20px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;vertical-align: top;background-color: white;border-top: none;">
							<table style="font-weight: normal;border-collapse: collapse;border: 0;margin: 0;padding: 0;font-family: Arial, sans-serif;">
								<tr>
									<td class="head-title" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 28px;line-height: 34px;font-weight: bold; text-align: center;">
										<div class="mktEditable" id="main_title">
											Castellane-Auto
										</div>
									</td>
								</tr>
								<tr>
									<td class="sub-title" style="border-collapse: collapse;border: 0;margin: 0;padding: 0;padding-top:5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 18px;line-height: 29px;font-weight: bold;text-align: center;">
									<div class="mktEditable" id="intro_title">
									'.$row["Nom"].' '.$row["Prenom"].'
									</div></td>
								</tr>
								<tr>
									<td class="top-padding" style="border-collapse: collapse;border: 0;margin: 0;padding: 5px;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;"></td>
								</tr>
								<tr>
									<td class="grey-block" style="border-collapse: collapse;border: 0;margin: 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 26px;background-color: #fff; text-align:center;">
									<div class="mktEditable" id="cta">
			                            <strong>Félicitation </strong> vous venez d\'obtenir le certificat castellane auto avec la note de : '.$row["Note"].'/'.$row["NombreQuestion"].' le numéro de votre certificat est <strong> '.$row["Id_Resultat"].'</strong><br><br>
			                             <a style="color:#ffffff; background-color: red;  border: 10px solid #ff8300; border-radius: 3px; text-decoration:none;" href="https://ae-castellane.com/">Revenir sur le site</a>
									</div>
									</td>
								</tr>
								<tr>
									<td class="top-padding" style="border-collapse: collapse;border: 0;margin: 0;padding: 15px 0;-webkit-text-size-adjust: none;color: #555559;font-family: Arial, sans-serif;font-size: 16px;line-height: 21px;">
										<hr size="1" color="#eeeff0">
									</td>
								</tr>
								
					</table>
				  </body>
            </html>
            ';
  
            mail($row['Email'], "Votre note est arriver [Castellane-auto]", $message, $header);
            } 
      ?>
      <div class="stats-col text-center">
          <form method="POST">
            <input type="submit" class="btn btn-success action-button m-1" value="Recevoir mon certificat" name="mailform<?= $row['Nom'] ?>"/>
          </form>
          </form>
       </div>
      <?php  endif; endforeach; ?></td>
                                                </tr>
                                                <?php 
                                                        endif;
                                                    endforeach; 
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </ul>
            <div class="col-sm-9">
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <div style="margin-top:14px;" class="order-md-2"><a href="<?= site_url('user/appointment') ?>">Prendre rendez-vous avec un moniteur</a>
						</div>
                        <hr>
                        <?php
                            foreach($get_users as $row):
                                if($row['iduser'] == $_SESSION['userid']):
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
								<div class="form-group col-12 col-md-6">
                                    <label for="inputpassword">Mot de passe</label>
                               		<input type="password" class="form-control" id="inputpassword" required value="<?= password_verify($row['password']) ?>" name="password">
                                </div>
                                <input  type="hidden" name="iduser" value="<?= $row['iduser'] ?>">
                                <input type="submit" class="btn btn-danger">
                            </div>
                        </form>
                        <?php 
                                endif;
                            endforeach;
                        ?>
                    </div><!--/tab-pane-->
                </div>
            </div><!-- /col-sm-9 -->
        </div>
    </div>
<?php 
    }else{
    echo '  
        <div class="alert alert-danger mt-5 container">
            <strong>Attention !</strong> Vous devez vous connecter pour accéder au site <a class="alert-link" href="'. site_url('user/signin').'">Se connecter</a>.
        </div>
    ';
    }
?>

