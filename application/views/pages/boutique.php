<div class="article-list">
  <?= form_open('user/signin') ?>    
    <div class="container">
      <div class="intro">
          <h2 class="text-center">Boutique</h2>
          <p class="text-center">Les tarifs des packs permis (Code + Conduite)</p><hr>
      </div>
      <div class="row articles">
        <?php foreach ($boutiques as $boutique): ?>
          <div class="col-sm-6 col-md-4 item"><a><h1 class="card-title pricing-card-title"><?= $boutique['price'] ?><small class="text-muted">/ EUR </small></h1></a>
              <h3 class="name"><?= $boutique['title'] ?></h3>
              <ul class="description">
                <li><?= $boutique['content'] ?></li>
                <li><?= $boutique['content2'] ?></li>
                <li><?= $boutique['content3'] ?></li>
                <li><?= $boutique['content4'] ?></li>
                <li><?= $boutique['content5'] ?></li>
              </ul>
              <?php 
                if(!empty($_SESSION['userid']))
                {
              ?>
              <a href="<?= base_url('products/buy/'.$boutique['idshop']); ?>" class="btn mt-1 btn-info text-white action-button">Acheter <i class="fa fa fa-cc-paypal"></i></a>
              <?php 
                }else{
                  echo '  
                    <div class="mt-5 container">
                      <a href="'.site_url('user/signin').'" class="btn mt-1 btn-success text-white action-button">Connexion</a>
                      <a href="'.site_url('user/signup').'" class="btn mt-1 btn-danger text-white action-button">Inscritption</a>
                    </div>
                ';
                }
              ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>