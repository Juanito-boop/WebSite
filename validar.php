<?php foreach($resultado as $row) {?>
                            <?php
                                $unique = $row['producto'];
                                $imagen = "img/vinos/". $unique ."/Principal.png";
                                if(!file_exists($imagen)){
                                    $imagen = "img/logo.png";
                                }
                            ?>
                            <img src="<?php echo $imagen;?>" alt="" class="product__img">
                            <div class="product__description">
                                <h3 class="product__title"><?php echo $row['nombre'];?></h3>
                                <h3 class="product__title"><?php echo $row['sepa'];?></h3>
                                <span class="product__price"><?php echo number_format($row['precio'], 3, '.', ',');?></span>
                            </div>
                                <a href="" class="product-btn">
                                    <em class="fas fa-shopping-cart"> COMPRAR</em>
                                </a>
                            </div>
                        <?php } ?>

                        <h2 class="main-title">VINOS IMPORTADOS MAS EXQUISITOS </h2>
            <div class="container-products">
                <div class="product">
                    <img src="img/vinos/Muga.png" alt="" class="product__img">
                    <br>
                    <div class="product__description">
                        <h3 class="product__title">muga<br>tempranillo
                        </h3>
                        <span class="product__price">$50.00 USD</span>
                    </div>
                    <a href="" class="product-btn">
                        <em class="fas fa-shopping-cart"> COMPRAR</em>
                    </a>
                </div>
                <div class="product">
                    <img src="img/vinos/Chatteu.png" alt="" class="product__img">
                    <br>
                    <div class="product__description">
                        <h3 class="product__title">st Michelle<br>cabernet sauvignon</h3>
                        <span class="product__price">$50.00 USD</span>
                    </div>
                    <a href="" class="product-btn">
                        <em class="fas fa-shopping-cart"> COMPRAR</em>
                    </a>
                </div>
                <div class="product">
                    <img src="img/vinos/Maison-castel.png" alt="" class="product__img">
                    <br>
                    <div class="product__description">
                        <h3 class="product__title">maison castel gran reserva<br>cabernet sauvignon
                        </h3>
                        <span class="product__price">$50.00 USD</span>
                    </div>
                    <a href="" class="product-btn">
                        <em class="fas fa-shopping-cart"> COMPRAR</em>
                    </a>
                </div>
                <div class="product">
                    <img src="img/vinos/Santa-margheritta.png" alt="" class="product__img">
                    <br>
                    <div class="product__description">
                        <h3 class="product__title">SANTA MARGHERITA<br>pinot grigio
                        </h3>
                        <span class="product__price">$50.00 USD</span>
                    </div>
                    <a href="" class="product-btn">
                        <em class="fas fa-shopping-cart"> COMPRAR</em>
                    </a>
                </div>
                <div class="product">
                    <img src="img/vinos/Montes-alpha.png" alt="" class="product__img">
                    <br>
                    <div class="product__description">
                        <h3 class="product__title">montes ALFA<br>M</h3>
                        <span class="product__price">$50.00 USD</span>
                    </div>
                    <a href="" class="product-btn">
                        <em class="fas fa-shopping-cart"> COMPRAR</em>
                    </a>
                </div>
            </div>
            <h2 class="main-title">NUESTROS MEJORES VINOS </h2>
            <div class="container-products">
                <div class="product">
                    <img src="img/vinos/Angelica-zapata.png" alt="" class="product__img">
                    <div class="product__description">
                        <h3 class="product__title">Angelica zapata Malbec</h3>
                        <span class="product__price">$50.00 USD</span>
                    </div>
                    <a href="" class="product-btn">
                        <em class="fas fa-shopping-cart"> COMPRAR</em>
                    </a>
                </div>
                <div class="product">
                    <img src="img/vinos/Gran-enemigo.png" alt="" class="product__img">
                    <div class="product__description">
                        <h3 class="product__title">Gran enemigo Malbec</h3>
                        <span class="product__price">$50.00 USD</span>
                    </div>
                    <a href="" class="product-btn">
                        <em class="fas fa-shopping-cart"> COMPRAR</em>
                    </a>
                </div>
                <div class="product">
                    <img src="img/vinos/Zuccardi.png" alt="" class=" product__img">
                    <div class="product__description">
                        <h3 class="product__title">Zuccardi serie a Malbec</h3>
                        <span class="product__price">$50.00 USD</span>
                    </div>
                    <a href="" class="product-btn">
                        <em class="fas fa-shopping-cart"> COMPRAR</em>
                    </a>
                </div>
                <div class="product">
                    <img src="img/vinos/Cerro-verde.png" alt="" class="product__img">
                    <div class="product__description">
                        <h3 class="product__title">Cerro verde merlot</h3>
                        <span class="product__price">$50.00 USD</span>
                    </div>
                    <a href="" class="product-btn">
                        <em class="fas fa-shopping-cart"> COMPRAR</em>
                    </a>
                </div>
                <div class="product">
                    <img src="img/vinos/Codice.png" alt="" class="product__img">
                    <div class="product__description">
                        <h3 class="product__title">Codice tempranillo</h3>
                        <span class="product__price">$50.00 USD</span>
                    </div>
                    <a href="" class="product-btn">
                        <em class="fas fa-shopping-cart"> COMPRAR</em>
                    </a>
                </div>
            </div>