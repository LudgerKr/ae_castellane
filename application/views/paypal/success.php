<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<?php setlocale(LC_TIME, 'fr_FR'); ?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <strong><?='<div class="border p-1 ml-5">'.strftime('%a %d %B %Y'); ?>
            <span class="float-right"> <strong>Status: </strong><?= $status; ?></span>
        </div>
        <div class="card-body container">
            <div class="row container ml-3">
                <div class="col-sm-6">
                    <h6 class="mb-3">Vendu par : </h6>
                    <div>
                        <strong>Castellane-Auto</strong>
                    </div>
                    <div>TOULON</div>
                    <div>27, rue Général de Gaule Avenue</div>
                    <div>Email: castellane@gmail.com</div>
                    <div>Téléphone: 01.25.66.06.32</div>
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
                            <th>Description</th>
                            <th class="right">Prix</th>
                            <th class="right">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="center"><?= $item_number; ?></td>
                            <td class="left strong"><?= $item_name; ?></td>
                            <td class="left">Extended License</td>
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
    </div>
    <a href="<?= base_url('boutique'); ?>">Retour aux produits</a>
</div>