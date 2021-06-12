<?php 

if (!$connect = mysqli_connect("localhost", "root", "")) {
    exit("Desolé, Connexion a localhost impossible");
}
if (!mysqli_select_db($connect, "boutique")) {
    exit("Desolé, l'acces a la base boutique impossible");
}

    $content = file_get_contents('./products.json');
    $initial_products = json_decode($content);
    //$products = array_map('map',$initial_products);
        foreach($initial_products as $products) {
        $ref = $products->sku;
        $name = $products->name;
        $description = $products->description;
        $price = $products->price;
        $image = $products->image;

        $sql = "INSERT INTO produits VALUES ('$ref','$name','$description','$price','$image')";
        $result = mysqli_query($connect, $sql);
    }
?>