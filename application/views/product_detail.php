<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $product->name ?></title>
</head>
<body>
    <h1><?= $product->name ?></h1>
    <p>Rp <?= $product->price ?></p>

    <img src="<?= $product->image ?>" width="500" height="auto" />

    <div>
        <p>Warna</p>
        <ul>
            <?php foreach ($product->colors as $color): ?>
                <li><?= $color ?></li>
            <?php endforeach ?>
        </ul>
    </div>

    <hr />

    <div>
        <h3>Produk Serupa</h3>

        <hh4><?= $similar->name ?></h4>
        <p>Rp <?= $similar->price ?></p>

        <img src="<?= $similar->image ?>" width="500" height="auto" />

        <div>
            <p>Warna</p>
            <ul>
                <?php foreach ($similar->colors as $color): ?>
                    <li><?= $color ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</body>
</html>