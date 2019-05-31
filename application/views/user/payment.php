<div class="container mt-3">
<h1> Ma Facture </h1>
<hr>
<form>
  <input id="impression" name="impression" type="button" onclick="imprimer_page()" value="Imprimer / PDF " />
</form>
<?php
	foreach($payment as $row):
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
						<td class="center"> 1 </td>
						<td class="left strong"><?= $row['nomProduit'] ?></td>
						<td class="right"><?= $row['prix'] ?></td>
						<td class="right"><?= $row['prix'] ?></td>
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
							<strong><?= $row['prix'] ?></strong>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<a href="<?= base_url('user/profil'); ?>">Retour sur mon profil</a>
</div>
</div>
<script type="text/javascript">
function imprimer_page(){
  window.print();
}
</script>
<?php
	} endforeach;
?>