<div id="main">
    <div class="section section-bg-10 pt-4 pb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="page-title text-center">Commander</h2>
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
                        <li>Ma Commande</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-checkout pt-7 pb-7">
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
                    <div  class="col-md-6 shipping-info">
                        <h3>Détails Livraison</h3>
                        <div class="col-md-12 error-text text-align-center">
                                        
                        </div>
                        <form id="shipping-form">
                            <div class="row">
                                <input type="hidden" name="userT" 
                                value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']['token'] : '00000000'; ?>" />
                                <div class="col-md-6">
                                    <label>Nom <span class="required">*</span></label>
                                    <div class="form-wrap">
                                        <input type="text" name="nom" 
                                        value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']['nom'] : ''; ?>" 
                                        size="255" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Prenoms <span class="required">*</span></label>
                                    <div class="form-wrap">
                                        <input type="text" name="prenoms" 
                                        value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']['prenoms'] : ''; ?>" 
                                        size="200" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Téléphone <span class="required">*</span></label>
                                    <div class="form-wrap">
                                        <input type="text" name="tel" 
                                        value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']['tel'] : ''; ?>" 
                                        size="20" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>E-Mail</label>
                                    <div class="form-wrap">
                                        <input type="text" name="email" 
                                        value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']['email'] : ''; ?>"
                                        size="200" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Commune <span class="required">*</span></label>
                                    <div class="form-wrap ">
                                        <select class="selectpicker " id="select-shipping-destination" data-live-search="true" data-width="100%" name="lieu_livraison">
                                            <?php foreach ($list_shipping_destination as $dest ): ?>
                                            <?php $isSelected=($_SESSION['cart']['shipping_dest']['token']==$dest->token) ? 'selected' : '' ?>
                                                <option  class="<?php echo $dest->token; ?>" shipping-amount="<?php echo $dest->frais; ?>"
                                                        data-tokens="ketchup mustard" value="<?php echo $dest->token ; ?>" 
                                                        <?php echo $isSelected; ?> >
                                                    <?php echo ucfirst($dest->commune); ?>
                                                </option>
                                            <?php endforeach;  ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Quartier <span class="required">*</span></label>
                                    <div class="form-wrap">
                                        <input type="text" name="quartier" value="" size="255" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Description lieu de livraison</label>
                                    <div class="form-wrap">
                                        <textarea name="description_lieu_livraison" class="input-text " id="order_comments" 
                                        placeholder="Donnez plus de details sur le lieu auquel vous voulez vous faire livrer vos produits."
                                         rows="2" cols="40">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <h3 class="mb-5">Détails Commande</h3>
                        <div class="order-review">
                            <table class="checkout-review-order-table">
                                <thead>
                                    <tr>
                                        <th class="product-name">PRODUITS</th>
                                        <th class="product-total">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($_SESSION['cart']['products_list'] as $token => $p): ?>
                                        <tr>
                                           <td class="product-name">
                                                <?php echo $p['nom']; ?> x 
                                                <strong class="product-quantity">
                                                    <?php echo $p['qtite_cart']; ?>
                                                </strong>
                                            </td> 
                                            <td class="product-total">
                                                <?php echo $p['price_cart']; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Sous Total</th>
                                        <td id="sous-total-vue-panier"
                                        sous-total-cart="<?php echo isset( $_SESSION['cart']['total_amount'] ) ? $_SESSION['cart']['total_amount'] : "0" ?>">
                                            <?php echo isset( $_SESSION['cart']['total_amount'] ) ? $_SESSION['cart']['total_amount'] : "0" ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Livraison</th>
                                        <td id="frais-livraison" montant-livraison="500">
                                            <?php echo $_SESSION['cart']['shipping_dest']['frais'] ?>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>TOTAL</th>
                                        <td>
                                            <strong id="total-vue-panier"> 
                                                <?php echo $_SESSION['cart']['total_amount'] + $_SESSION['cart']['shipping_dest']['frais']  ?> F CFA
                                            </strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="checkout-payment">
                            <ul class="payment-method">
                                <li>
                                    <div class="payment-box">
                                        <p>PAYER A LA LIVRAISON.</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="text-right text-center-sm">
                                <a id="commandeur-btn" class="organik-btn mt-1" href="#"> Valider </a>
                            </div>
                        </div>
                        <!-- <div class="row">
                            
                        </div> -->
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirm-order-modal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="confirm-order-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title text-uppercase" id="exampleModalLongTitle">Confirmation de commande</h5>
      </div>
      <div class="modal-body order-confirmation-body">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h6 class="text-uppercase">Détails de votre commande</h6>
                <div class="order-info">
                    <div class="col-sm-12">
                        <span class="order-amount-description">Montant Total : </span><span class="order-amount"></span>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 shipping-confirmation-details text-center">
                <h6 class="text-uppercase">Détail de livraison</h6>
                <div class="col-sm-12"><span class="shipping-name-label"> Nom et Prenoms : </span><span class="shipping-name"></span></div>
                <div class="col-sm-12"><span class="shipping-tel-label">Téléphone: </span><span class="shipping-tel"></span></div>
                <div class="col-sm-12"><span class="shipping-email-label">E-Mail : </span><span class="shipping-email"></span></div>
                <div class="col-sm-12"><span class="shipping-commune-label">Commune : </span><span class="shipping-commune"></span></div>
                <div class="col-sm-12"><span class="shipping-commune-label">Quartier : </span><span class="shipping-quartier"></span></div>
                <div class="col-sm-12">
                    <span class="shipping-detail-label">Description lieu de livraison : </span><span class="shipping-detail-lieu"></span>
                </div>

            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn organik-btn-cancel" data-dismiss="modal">ANNULER</button>
        <button type="button" id="confirm-command-btn" class="btn organik-btn text-align-right">Confirmer</button>
      </div>
    </div>
  </div>
</div>

</div>

<br><br><br><br>
