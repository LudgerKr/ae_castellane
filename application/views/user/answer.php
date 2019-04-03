<?php 
  if(!empty($_SESSION['userid']))
  {
?>
  <div class="mt-5 container text-center text-white">
    <a type="submit" href="<?= site_url('user/quizz') ?>" class="btn btn-success mt-1">Epreuve du Code !!!</a>
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