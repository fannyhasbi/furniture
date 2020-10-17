<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello World</title>
</head>
<body>
    <h1>Produk</h1>

    <div>
        <?php foreach ($products as $product): ?>
            <p><?= "{$product->name} - Rp {$product->price}" ?></p>

            <img src="<?= $product->image ?>" width="200" height="auto" />

            <a href="<?= site_url("/product/{$product->id}") ?>">Lihat</a>
        <?php endforeach; ?>
    </div>
</body>
</html>