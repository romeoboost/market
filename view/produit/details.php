<div id="main">
    <div class="section section-bg-10 pt-4 pb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="page-title text-center">Détails Produit</h2>
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
                        <li>Détails Produit</li>
                        <li> <?php echo ucfirst($produit->nom_produit) ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="section pt-7 pb-7">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-push-1">
                    <div class="single-product">
                        <div class="col-md-5">
                            <div class="image-gallery">
                                <div class="image-gallery-inner">
                                    <div>
                                        <div class="image-thumb">
                                            <a href="<?php echo WEBROOT_URL; ?>images/shop/large/<?php echo $produit->image ?>.jpg" data-rel="prettyPhoto[gallery]">
                                                <img src="<?php echo WEBROOT_URL; ?>images/shop/<?php echo $produit->image ?>.jpg" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                    <!-- <div>
                                        <div class="image-thumb">
                                            <a href="<?php echo WEBROOT_URL; ?>images/shop/large/shop_2.jpg" data-rel="prettyPhoto[gallery]">
                                                <img src="<?php echo WEBROOT_URL; ?>images/shop/shop_3.jpg" alt="" />
                                            </a>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="image-thumb">
                                            <a href="<?php echo WEBROOT_URL; ?>images/shop/large/shop_3.jpg" data-rel="prettyPhoto[gallery]">
                                                <img src="<?php echo WEBROOT_URL; ?>images/shop/shop_4.jpg" alt="" />
                                            </a>
                                        </div>
                                    </div> -->
                                </div>
                            </div>

                            <!-- <div class="image-gallery-nav">
                                <div class="image-nav-item">
                                    <div class="image-thumb">
                                        <img src="<?php echo WEBROOT_URL; ?>images/shop/thumb/shop_1.jpg" alt="" />
                                    </div>
                                </div>
                                <div class="image-nav-item">
                                    <div class="image-thumb">
                                        <img src="<?php echo WEBROOT_URL; ?>images/shop/thumb/shop_3.jpg" alt="" />
                                    </div>
                                </div>
                                <div class="image-nav-item">
                                    <div class="image-thumb">
                                        <img src="<?php echo WEBROOT_URL; ?>images/shop/thumb/shop_4.jpg" alt="" />
                                    </div>
                                </div>
                            </div> -->

                        </div>
                        <div class="col-md-7">
                            <div class="summary">
                                <h1 class="product-title"><?php echo ucfirst($produit->nom_produit) ?></h1>
                                <div class="product-rating">
                                    <!-- <div class="star-rating">
                                        <span style="width:100%"></span>
                                    </div>
                                    <i>(2 customer reviews)</i> -->
                                </div>
                                <div class="product-price">
                                    <!-- <del>$15.00</del>
                                    <ins>$12.00</ins> -->
                                    <?php if($produit->ispromo==1){ ?>
                                        <del><?php echo $produit->prix_qtite_unit ?></del>
                                    <?php } ?>
                                    <!-- <del>$15.00</del>  -->
                                    <ins><?php echo $produit->prix_qtite_unit - $produit->prix_qtite_unit*$produit->percent_promo/100 ?>  
                                        CFA / <?php echo $produit->qtite_unit ?>
                                        <?php echo ($unites[$produit->unite] == 'NA') ? '' : $unites[$produit->unite] ?>
                                    </ins>

                                </div>
                                <div class="mb-3">
                                    <p><?php echo ucfirst($produit->description) ?></p>
                                </div>
                                <form id="produit-detail-form" class="cart">
                                    <div class="quantity-chooser">
                                        <div class="quantity">
                                            <span class="qty-minus" data-min="1"><i class="ion-ios-minus-outline"></i></span>
                                            <input type="text" name="quantity" value="1" title="quantité" class="quantite-product-detail input-text qty text" size="4">
                                            <input type="hidden" class="token-product-detail" name="token" value="<?php echo $produit->token_produit ?>">
                                            <span class="qty-plus" data-max=""><i class="ion-ios-plus-outline"></i></span>
                                        </div>
                                    </div>
                                    <button type="submit" class="single-add-to-cart">AJOUTER AU PANIER</button>
                                </form>
                                <!-- <div class="product-tool">
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to wishlist">
                                     Browse Wishlist </a>
                                    <a class="compare" href="#" data-toggle="tooltip" data-placement="top" title="Add to compare">
                                     Compare </a>
                                </div> -->
                                <div class="product-meta">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="label">Categorie</td>
                                                <td><a href="<?php echo BASE_URL.DS.'produit/liste/categorie/'.$produit->token_cat; ?>">
                                                    <?php echo ucfirst($produit->categorie) ?></a>
                                                    <span id="detailCategory" class="hidden"><?php echo $produit->token_cat ?></span>
                                                </td>
                                            </tr>
                                           <!--  <tr>
                                                <td class="label">Share</td>
                                                <td class="share">
                                                    <a target="_blank" href="#"><i class="fa fa-facebook"></i></a> 
                                                    <a target="_blank" href="#"><i class="fa fa-twitter"></i></a> 
                                                    <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                                                </td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="commerce-tabs tabs classic">
                                <ul class="nav nav-tabs tabs">
                                    <li class="active">
                                        <a data-toggle="tab" href="#tab-description" aria-expanded="true">Description</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#tab-reviews" aria-expanded="false">Commentaires</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade active in" id="tab-description">
                                        <p>
                                            <?php echo ucfirst($produit->description) ?>
                                        </p>
                                    </div>

                                    <div id="tab-reviews" class="tab-pane fade">

                                        <!-- <div class="single-comments-list mt-0">
                                            <div class="mb-2">
                                                <h2 class="comment-title">2 reviews for Orange Juice</h2>
                                            </div>
                                            <ul class="comment-list">
                                                <li>
                                                    <div class="comment-container">
                                                        <div class="comment-author-vcard">
                                                            <img alt="" src="<?php echo WEBROOT_URL; ?>images/avatar/avatar.png" />
                                                        </div>
                                                        <div class="comment-author-info">
                                                            <span class="comment-author-name">admin</span>
                                                            <a href="#" class="comment-date">July 27, 2016</a>
                                                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                                                        </div>
                                                        <div class="reply">
                                                            <a class="comment-reply-link" href="#">Reply</a>
                                                        </div>
                                                    </div>
                                                    <ul class="children">
                                                        <li>
                                                            <div class="comment-container">
                                                                <div class="comment-author-vcard">
                                                                    <img alt="" src="<?php echo WEBROOT_URL; ?>images/avatar/avatar.png" />
                                                                </div>
                                                                <div class="comment-author-info">
                                                                    <span class="comment-author-name">admin</span>
                                                                    <a href="#" class="comment-date">July 27, 2016</a>
                                                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                                                                </div>
                                                                <div class="reply">
                                                                    <a class="comment-reply-link" href="#">Reply</a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <div class="comment-container">
                                                        <div class="comment-author-vcard">
                                                            <img alt="" src="<?php echo WEBROOT_URL; ?>images/avatar/avatar.png" />
                                                        </div>
                                                        <div class="comment-author-info">
                                                            <span class="comment-author-name">admin</span>
                                                            <a href="#" class="comment-date">July 27, 2016</a>
                                                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                                                        </div>
                                                        <div class="reply">
                                                            <a class="comment-reply-link" href="#">Reply</a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div> -->

                                        <div class="single-comment-form mt-0">
                                            <div class="mb-2">
                                                <h2 class="comment-title">LAISSER UN COMMENTAIRE</h2>
                                            </div>
                                            <form class="comment-form">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <textarea id="comment" name="comment" cols="45" rows="5" placeholder="Message *"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input id="author" name="author" type="text" value="" size="30" placeholder="Nom *" class="mb-2">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input id="email" name="email" type="email" value="" size="30" placeholder="Email *" class="mb-2">
                                                    </div>
                                                    <!-- <div class="col-md-4">
                                                        <input id="url" name="url" type="text" value="" placeholder="Website">
                                                    </div> -->
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <input name="submit" type="submit" id="submit" class="btn btn-alt btn-border" value="Envoyer">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="related">
                                <div class="related-title">
                                    <!-- <h2 class="text-center section-title mtn-2 fz-24">Produits</h2> -->
                                    <div class="text-center mb-1 section-pretitle fz-34">Produits Apparentés</div>
                                    
                                </div>

                                <div product-display="false" 
                                     product-data-category="<?php echo $produit->token_cat ?>"
                                     class="product-carousel p-0 products-related-container" data-auto-play="true" data-desktop="3" 
                                     data-laptop="2" data-tablet="2" data-mobile="1">

                                </div>
								
									
								
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="col-md-3 col-md-pull-9">
                    <div class="sidebar">
                        <div class="widget widget-product-search">
                            <form class="form-search">
                                <input type="text" class="search-field" placeholder="Search products…" value="" name="s" />
                                <input type="submit" value="Search" />
                            </form>
                        </div>
                        <div class="widget widget-product-categories">
                            <h3 class="widget-title">Product Categories</h3>
                            <ul class="product-categories">
                                <li><a href="#">Dried</a> <span class="count">6</span></li>
                                <li><a href="#">Fruits</a> <span class="count">5</span></li>
                                <li><a href="#">Juice</a> <span class="count">6</span></li>
                                <li><a href="#">Vegetables</a> <span class="count">6</span></li>
                            </ul>
                        </div>
                        <div class="widget widget-products">
                            <h3 class="widget-title">Products</h3>
                            <ul class="product-list-widget">
                                <li>
                                    <a href="shop-detail.html">
                                        <img src="<?php echo WEBROOT_URL; ?>images/shop/thumb/shop_1.jpg" alt="" />
                                        <span class="product-title">Orange Juice</span>
                                    </a>
                                    <del>$15.00</del>
                                    <ins>$12.00</ins>
                                </li>
                                <li>
                                    <a href="shop-detail.html">
                                        <img src="<?php echo WEBROOT_URL; ?>images/shop/thumb/shop_2.jpg" alt="" />
                                        <span class="product-title">Aurore Grape</span>
                                    </a>
                                    <ins>$9.00</ins>
                                </li>
                                <li>
                                    <a href="shop-detail.html">
                                        <img src="<?php echo WEBROOT_URL; ?>images/shop/thumb/shop_3.jpg" alt="" />
                                        <span class="product-title">Blueberry Jam</span>
                                    </a>
                                    <ins>$15.00</ins>
                                </li>
                                <li>
                                    <a href="shop-detail.html">
                                        <img src="<?php echo WEBROOT_URL; ?>images/shop/thumb/shop_4.jpg" alt="" />
                                        <span class="product-title">Passionfruit</span>
                                    </a>
                                    <ins>$35.00</ins>
                                </li>
                                <li>
                                    <a href="shop-detail.html">
                                        <img src="<?php echo WEBROOT_URL; ?>images/shop/thumb/shop_5.jpg" alt="" />
                                        <span class="product-title">Carrot</span>
                                    </a>
                                    <ins>$12.00</ins>
                                </li>
                            </ul>
                        </div>
                        <div class="widget widget-tags">
                            <h3 class="widget-title">Product Tags</h3>
                            <div class="tagcloud">
                                <a href="#">bread</a> <a href="#">food</a> <a href="#">fruits</a> <a href="#">green</a> <a href="#">healthy</a> <a href="#">natural</a> <a href="#">organic store</a> <a href="#">vegatable</a>
                            </div>
                        </div>
                    </div>
                </div> -->


            </div>
        </div>
    </div>
</div>
            
