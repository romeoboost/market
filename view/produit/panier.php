<div id="main">
    <div class="section section-bg-10 pt-4 pb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="page-title text-center">Mon Panier</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="section border-bottom pt-2 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumbs">
                        <li><a href="<?php echo BASE_URL.DS.'accueil/index'; ?>">Accueil</a></li>
                        <li><a href="<?php echo BASE_URL.DS.'produit/liste'; ?>">Le Marché</a></li>
                        <li>Mon Panier</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="section pt-7 pb-7">
        <div class="container">
            <div class="row">
                <?php if( !isset($_SESSION['cart']['products_list']) || empty($_SESSION['cart']['products_list']) ) { ?>
                    <div class="col-sm-12 text-center">
                        <div class="commerce">
                            <p class="cart-empty"> Votre panier est vide.</p>
                            <a class="organik-btn small" href="<?php echo BASE_URL.DS.'produit/liste'; ?>"> Retourner au marché </a>
                        </div>
                    </div>
                <?php }else{ ?>
                    <div class="col-md-8">
                        <table class="table shop-cart">
                            <tbody>
                                <form id="cart-content-panier">
                                <?php 
                                    $i=0;
                                    $classPairTr="pair-product-item";
                                    $classPairTrTwo="pair-product-item-subtotal-amount";
                                    foreach ($_SESSION['cart']['products_list'] as $token => $p):
                                        $checkClass = $i % 2;
                                        $classPairTr= ($checkClass == 0) ? "pair-product-item" : "impair-product-item";
                                        $classPairTrTwo= ($checkClass == 0) ? "pair-product-item-subtotal-amount" : "impair-product-item-subtotal-amount";
                                ?>
                                    <tr class="cart_item <?php echo $classPairTr;  echo ' '.$token; ?>  ">
                                        <td class="product-remove">
                                            <a href="" class="remove remove-product-cart" id-product="<?php echo $token; ?>">×</a>
                                        </td>
                                        <td class="product-thumbnail text-center product-info">
                                            <a href="<?php echo $p['link_to_details']; ?>">
                                                <strong><?php echo $p['nom']; ?></strong>
                                            </a>
                                            <a href="<?php echo $p['link_to_details']; ?>">
                                                <img src="<?php echo $p['link_to_image']; ?>" alt=""> 
                                            </a>
                                            <span class="amount amount-cart">
                                                <?php echo $p['qtite_unit']; ?> <?php echo $p['symbole_unite']; ?> x 
                                                <?php echo $p['prix_qtite_unit']; ?> F 
                                            </span>
                                        </td>
                                        <td class="product-quantity text-center">
                                            <div class="quantity">
                                                <span class="qty-minus" data-min="1"><i class="ion-ios-minus-outline"></i></span>
                                                <input type="text" name="<?php echo $token; ?>" 
                                                    value="<?php echo $p['qtite_cart']; ?>" 
                                                    title="Nombre de tas de quantité unitaire. Exemple : 2 tas de
                                                    <?php echo $p['qtite_unit']; ?> <?php echo $p['symbole_unite']; ?> <?php echo ( empty($p['symbole_unite']) ) ? '' : 'de '; ?> <?php echo $p['nom']; ?>" 
                                                    class="quantite-product-detail input-text qty text" size="4" required>
                                                <span class="qty-plus" data-max=""><i class="ion-ios-plus-outline"></i></span>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount"><?php echo $p['price_cart']; ?> F</span>
                                        </td>
                                    </tr>
                                    <tr class="cart_item cart-item-info-responsive text-center <?php echo $classPairTrTwo;  echo ' '.$token; ?>">
                                        <td colspan="3" class="product-subtotal-responsive">
                                            sous total produit :  <?php echo $p['price_cart']; ?> F
                                        </td>
                                    </tr>
                                <?php 
                                    //$i++; 
                                    endforeach; 
                                ?>
                                <tr>
                                    <td colspan="4" class="actions">
                                        <a class="continue-shopping text-center" href="<?php echo BASE_URL.DS.'produit/liste'; ?>"> Retourner au marché</a>
                                        <input type="submit" class="update-cart" name="update_cart" value="Modifier Panier" />
                                    </td>
                                </tr>
                                </form>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        
                        <div class="cart-totals">
                            <table>
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Sous Total</th>
                                        <td id="sous-total-vue-panier" 
                                        sous-total-cart="<?php echo isset( $_SESSION['cart']['total_amount'] ) ? $_SESSION['cart']['total_amount'] : "0" ?>">
                                            <?php echo isset( $_SESSION['cart']['total_amount'] ) ? $_SESSION['cart']['total_amount'] : "0" ?> F
                                        </td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>Frais Livraison</th>
                                        <td id="frais-livraison" montant-livraison="500">
                                            <?php echo ucfirst($_SESSION['cart']['shipping_dest']['frais']) ?>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td>
                                            <strong id="total-vue-panier">
                                                <?php 
                                                 echo isset( $_SESSION['cart']['total_amount'] ) ? $_SESSION['cart']['total_amount']+$_SESSION['cart']['shipping_dest']['frais'] : "0" 
                                                ?> F
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="proceed-to-checkout">
                                <?php if ( isset($_SESSION['user']) ): ?>
                                    <a href="<?php echo BASE_URL.DS.'commande/details'; ?>" class="">
                                        Commander
                                    </a>
                                <?php else: ?>
                                    <a href="#" role="" data-toggle="modal" data-target="#login-modal" class="order-connect-btn checkout">
                                        Commander
                                    </a>
                                <?php endif; ?>
                                <!-- <a href="<?php echo BASE_URL.DS.'commande/details'; ?>">Commander</a> -->
                            </div>
                        </div>
                        
                        <!-- <div class="coupon-shipping">
                            <div class="coupon">
                                <form>
                                    <input type="text" name="coupon_code" class="coupon-code" id="coupon_code" value="" placeholder="Coupon code" />
                                    <input type="submit" class="apply-coupon" name="apply_coupon" value="Apply Coupon" />
                                </form>
                            </div>
                        </div> -->

                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<br><br><br><br>
