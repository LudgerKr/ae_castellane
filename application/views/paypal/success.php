<meta http-equiv="refresh" content="5" >
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<div class="container mt-5">
<?php
foreach($payment as $row){
	if($_SESSION['userid'] == $row['Id_User']){
?>
<div class="card">
	<div class="card-header">
		<span class="float-right"> <strong>Status: </strong><?= $row['Statut']; ?></span>
	</div>
	<div class="card-body container">
		<div class="row container ml-3">
			<div class="col-sm-6">
				<h6 class="mb-3">Acheter par :</h6>
				<div>
					<strong><?= $row['Nom'] ?> <?= $row['Prenom'] ?></strong>
				</div>
				<div>numéro de facture: <?= $row['Id_Payment'] ?></div>
				<div>Email: <?= $row['Email'] ?></div>
				<div>Téléphone: 0<?= $row['phone']?></div>
			</div>

			<div class="col-sm-6 mb-5">
				<h6 class="mb-3">Vendu par : </h6>
				<div>
					<strong>Castellane-Auto</strong>
				</div>
				<div>TOULON</div>
				<div>27, rue Général de Gaule Avenue</div>
				<div>Email: castellane@gmail.com</div>
				<div>Téléphone: 01.25.66.06.32</div>
			</div>
		</div>
		<div class="table-responsive-sm">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Produit</th>
						<th class="right">Prix</th>
						<th class="right">Total</th>
					</tr>
					</thead>
					<tbody>
					<tr>
                            <td class="center"><?= $item_number; ?></td>
                            <td class="left strong"><?= $item_name; ?></td>
                            <td class="right"><?= $payment_amt.' '.$currency_code; ?></td>
                            <td class="right"><?= $payment_amt.' '.$currency_code; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                        <tbody>
                        <tr>
                            <td class="left">
                                <strong>Total</strong>
                            </td>
                            <td class="right">
                                <strong><?= $payment_amt.' '.$currency_code; ?></strong>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	    <a href="<?= base_url('boutique'); ?>">Retour aux produits</a>
    </div>

</div>
<?php
		}
	}
?>