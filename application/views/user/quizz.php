<?php 
  if(!empty($_SESSION['userid']))
  {
    $_SESSION['currentQuestion'] = 1;
    $_SESSION['note'] = 0;

    foreach($row as $rows)
    {
      if($rows['userid'] == $_SESSION['userid'])
      {
        redirect('user/quizz_Error');
      }  
    }
      
?>
<div class="container">
  <div class="mt-3" id="question"></div><br>
  <div id="info"></div>
  <button class="btn btn-success text-white center mb-4" id="leBouton" type='button' value='Valider' onclick="valid()">Valider</button>
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