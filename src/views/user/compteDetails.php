<div class=" text-center py-5">
    <h1>Voici le détail de votre facture</h1>
</div>
<a href="javascript:history.go(-1)"><button class="btn btn-warning" ><< Retour</button></a>
<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Reference</th>
                <th scope="col">Produit</th>
                <th scope="col">Quantité</th>
                <th scope="col">Total des produits</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <form action="" method="POST">
                <?php foreach ($all_sales as $sale) : ?>
                    <?php if ($_SESSION["user"]["id"] == $sale["id_user"]) : ?>
                        <tr>
                            <td><?= $sale['id'] ?></td>
                            <td><?= $sale['name'] ?></td>
                            <td><?= $sale['quantity'] ?></td>
                            <td><?= $sale['price_total_product'] ?> €</td>
                        </tr>
                    <?php endif ?>
                <?php endforeach; ?>
            </form>
        </tbody>
    </table>
</div>