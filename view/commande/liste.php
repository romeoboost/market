<div id="main">
    <div class="section section-bg-10 pt-4 pb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="page-title text-center">Le Marché</h2>
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
                        <li>tous les produits</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="section pt-3 pb-2">
        <div class="container">
            <div class="row">
                <div class="text-center mb-1 "><h3 class="product-title-category">Les Categories</h3></div>
                <?php 
                    $categories = $this->request('Accueil', 'getCategoryProduit'); 
                    $nbreCat = $this->request('Produit', 'NbreProduitCateg'); 
                    //var_dump($nbreCat);
                ?>
                    <div class="category-carousel-2 mb-1" data-auto-play="true" data-desktop="4" data-laptop="4" data-tablet="2" data-mobile="1">
                        <?php foreach ($categories as $c): ?>
                            <div class="cat-item">
                                <div class="cats-wrap <?php echo (isset($filter['categorie']) && $filter['categorie']['token']==$c->token) ? 'cat-active' : ''; ?>" 
                                    data-bg-color="#f8c9c2">
                                    <a href="<?php echo BASE_URL.DS.'produit/liste/categorie/'.$c->token; ?>">
                                        <img src="<?php echo WEBROOT_URL; ?>images/category/<?php echo $c->image; ?>.png" alt="" />
                                        <h2 class="category-title"> 
                                            <?php echo ucfirst($c->nom); ?> 

                                            <mark class="count">(<?php echo isset($nbreCat[$c->id]) ? $nbreCat[$c->id] : '0'; ?>)</mark>
                                        </h2>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
            </div>
        </div>
        

    </div>

    <div class="section pt-2 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-push-3">
                    <style type="text/css">
                        #status{position: fixed; font-size: 24px; color: #ff0031;
    top: 200px;}
                    </style>

                    <!-- <div id="status">0 | 0</div> -->
                    <div class="row">
                       <div class="shop-filter">
                            <div class="col-md-6">
                                <p class="result-count">
                                    <span class="product-nombre-low">0</span> à 
                                    <span class="product-found">0</span> sur 
                                    <span class="product-total">0</span> produits
                                    <?php if($filter['status']==true && isset($filter['categorie'])){ ?>
                                        <span class="filter-category"> / catégorie : <?php echo $filter['categorie']['nom']; ?> </span>
                                    <?php } ?>
                                </p>
                            </div>
                            <div class="col-md-6 ">
                                <div class="shop-filter-right">
                                    <!-- <div class="switch-view">
                                        <a href="shop-list.html" class="switcher" data-toggle="tooltip" data-placement="top" title="" data-original-title="List"><i class="ion-navicon"></i></a> 
                                        <a href="shop.html" class="switcher active" data-toggle="tooltip" data-placement="top" title="" data-original-title="Grid"><i class="ion-grid"></i></a>
                                    </div> -->
                                    <form class="commerce-ordering ">
                                        <select name="orderby" class="orderby">
                                            <option value="0">Tri par défaut</option>
                                            <option value="1">Tri par popularité</option>
                                            <option value="2">Tri par note moyenne</option>
                                            <option value="3" selected="selected">Tri par nouveauté</option>
                                            <option value="4">Tri par promo</option>
                                            <option value="5">Tri par tarif croissant</option>
                                            <option value="6">Tri par tarif décroissant</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <!-- masonry-grid-post -->
                    <div id="list_produits" class="product-grid " 
                    product-data-display="false" product-data-found="5" product-data-total="254"
                    product-data-search="" 
                    product-data-category="<?php echo isset($filter['categorie']) ? $filter['categorie']['token'] : ''; ?>" 
                    product-data-number-page="1" product-data-order="3"
                    >
                    

                        <div class="col-md-12">
                            <div id="loaderBox">
                                <div class="containerWrap">
                                    <div class="loader">...</div>
                                    <div id="load" class="text-center">Chargement...</div>
                                </div>
                            </div>
                        </div>

                            <!-- <div class="col-md-4 col-sm-6 product-item text-center mb-1">
                                <div class="product-thumb">
                                    <a href="shop-detail.html">
                                        <div class="badges">
                                            <span class="hot">Hot</span>
                                            <span class="onsale">Sale!</span>
                                        </div>
                                        <img src="<?php echo WEBROOT_URL; ?>images/shop/shop_1.jpg" alt="" />
                                    </a>
                                    <div class="product-action">
                                        <span class="add-to-cart">
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="Ajouter au panier"></a>
                                        </span>
                                        <span class="quickview">
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="Voir détails"></a>
                                        </span>
                                    </div>
                                </div>

                                <div class="product-info">
                                    <a href="shop-detail.html">
                                        <h2 class="title">Orange Juice</h2>
                                        <span class="price">
                                            <del>$15.00</del> 
                                            <ins>$12.00</ins>
                                        </span>
                                    </a>
                                </div>
                            </div> -->
                    </div>

                    <div class="pagination"> 
                        <!-- <a class="prev page-numbers" href="#">Prev</a>
                        <a class="page-numbers" href="#">1</a>
                        <span class="page-numbers current">2</span> 
                        <a class="page-numbers" href="#">3</a> 
                        <a class="next page-numbers" href="#">Next</a> -->
                    </div>
                </div>
                <!-- <div class="loadmore-contain"></div> -->
                <div class="col-md-3 col-md-pull-9">
                    <div class="sidebar">

                        <div class="widget widget-product-search">
                            <form class="form-search">
                                <input type="text" class="search-field" placeholder="Rechercher produit..." value="" name="product_searched" />
                                <input type="submit" value="Search" />
                            </form>
                        </div>
                        <!--<div class="widget widget-product-categories">
                            <h3 class="widget-title">Product Categories</h3>
                            <ul class="product-categories">
                                <li><a href="#">Dried</a> <span class="count">6</span></li>
                                <li><a href="#">Fruits</a> <span class="count">5</span></li>
                                <li><a href="#">Juice</a> <span class="count">6</span></li>
                                <li><a href="#">Vegetables</a> <span class="count">6</span></li>
                            </ul>
                        </div> -->

                        <!-- <div class="widget widget_price_filter">
                            <h3 class="widget-title">Filtrer par prix</h3>
                            <div class="price_slider_wrapper">
                                <div class="price_slider" style="display:none;"></div>
                                <div class="price_slider_amount">
                                    <input type="text" id="min_price" name="min_price" value="" data-min="0" placeholder="Min price"/>
                                    <input type="text" id="max_price" name="max_price" value="" data-max="50000" placeholder="Max price"/>
                                    <button type="submit" class="button">Filtrer</button>
                                    <div class="price_label" style="display:none;">
                                        Prix: <span class="from"></span> &mdash; <span class="to"></span>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div> -->
                        <div class="widget widget-products">
                            <h3 class="widget-title">Les plus demandés</h3>
                            <ul class="product-list-widget">
                                <?php foreach ($produits_plus_vendus as $ppv): ?>
                                    <li>
                                        <a href="shop-detail.html">
                                            <img src="<?php echo WEBROOT_URL; ?>images/shop/thumb/<?php echo $ppv->image; ?>.jpg" alt="" />
                                            <span class="product-title"><?php echo ucfirst($ppv->nom_produit) ?></span>
                                        </a>
                                        <?php if($ppv->ispromo==1){ ?>
                                            <del><?php echo $ppv->prix_qtite_unit ?></del>
                                        <?php } ?>
                                        <ins><?php echo $ppv->prix_qtite_unit - $ppv->prix_qtite_unit*$ppv->percent_promo/100 ?>  
                                            CFA/<?php echo $ppv->qtite_unit ?>
                                            <?php echo ($unites[$ppv->unite] == 'NA') ? '' : $unites[$ppv->unite] ?>
                                        </ins>

                                    </li>
                                <?php endforeach; ?>
                                
                            </ul>
                        </div>
                        <!-- <div class="widget widget-tags">
                            <h3 class="widget-title">Tags</h3>
                            <div class="tagcloud">
                                <a href="#">Frais</a> <a href="#">food</a> 
                                <a href="#">fruits</a> <a href="#">green</a>
                                 <a href="#">healthy</a>
                                  <a href="#">natural</a> 
                                  <a href="#">organic store</a> 
                                  <a href="#">vegatable</a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            
