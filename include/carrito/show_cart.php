<?php
session_start();

$ids = implode( ', ', array_keys($_SESSION['products']));
$sql = "SELECT * FROM products WHERE id IN ($ids);"
?>
<table>
  <thead>
     <tr>
        <th>SKU</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Subtotal</th>
        <th> </th>    
    </tr>
  </thead>
  <tbody>
<?php
$total = 0;
foreach ($pdo->query($sql, PDO::FETCH_ASSOC) as $product ) {
      $quantity = $_SESSION['products'][$product['id']];
      $subtotal = $quantity * $product['price'];
      $total += $subtotal;
?>
     <tr>
          <td><a href="product_details?product_id=<?php echo $product['id'];?>"><?php echo $product['sku']; ?></a></td>
          <td><?php echo $product['name']; ?></td>
          <td><?php echo $product['price']; ?></td>
          <td><?php echo $quantity; ?></td>
          <td><?php echo $subtotal; ?></td>
          <td><button onclick="window.location.href='remove_from_cart.php?product_id=<?php echo $product['id']; ?>'">Quitar del carrito</button></td>
     </tr>
<?php
}?>
  </tbody>
</table>
<p>Total: <?php echo $total;?></p>