<?php

$dsn = require_once 'db.php';

$pdo = new PDO($dsn);
?>
<table>
  <thead>
     <tr>
        <th>SKU</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th> </th>    
    </tr>
  </thead>
  <tbody>
     <?php
$sql = "SELECT * FROM products";

foreach ($pdo->query($sql, PDO::FETCH_ASSOC) as $product ) {
?>
     <tr>
          <td><a href="product_details?product_id=<?php echo $product['id'];?>"><?php echo $product['sku']; ?></a></td>
          <td><?php echo $product['name']; ?></td>
          <td><?php echo $product['price']; ?></td>
          <td><button onclick="window.location.href='add_to_cart.php?product_id=<?php echo $product['id']; ?>'">Agregar al carrito</button></td>
     </tr>
<?php
}?>
  </tbody>
</table>