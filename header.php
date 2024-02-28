<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> >
<head>
	<title>Basket College Novara</title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta name="keywords" content="Oleggio, Magic, basket, pallacanestro, basketball, serie b, mamy.eu" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	<link href="<?php echo get_template_directory_uri();?>/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <!--<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />-->
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,700,600,300' rel='stylesheet' type='text/css'/>
    <!--<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700' rel='stylesheet' type='text/css'/>-->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,300,200,500,600,700,800,900' rel='stylesheet' type='text/css'/>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

    <link href="<?php echo get_template_directory_uri();?>/css/fonts/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!--Clients-->
    <link href="<?php echo get_template_directory_uri();?>/css/own/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_template_directory_uri();?>/css/own/owl.theme.css" rel="stylesheet" type="text/css" />


    <link href="<?php echo get_template_directory_uri();?>/css/jquery.bxslider.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_template_directory_uri();?>/css/jquery.jscrollpane.css" rel="stylesheet" type="text/css" />
    
    <link href="<?php echo get_template_directory_uri();?>/css/minislide/flexslider.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_template_directory_uri();?>/css/component.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_template_directory_uri();?>/css/prettyPhoto.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_template_directory_uri();?>/css/style_dir.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_template_directory_uri();?>/img/favicon.ico"  rel="shortcut icon" type="image/png" />
    <link href="<?php echo get_template_directory_uri();?>/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_template_directory_uri();?>/css/animate.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_template_directory_uri();?>/css/main.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo get_template_directory_uri();?>/css/custom.css" rel="stylesheet" type="text/css" />
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<!--SECTION TOP LOGIN-->
     <section class="content-top-login">
           <div class="container">
      <div class="col-md-12">
           <div class="box-support"> 
             <p class="support-info"><!--<i class="fa fa-envelope-o"></i>--></p>
          </div>
           <div class="box-login"> 
             <!--i class="fa fa-shopping-cart"></i-->
             <!--<a href='sponsor.html'>Sponsor</a>
             <a href='login.html'>CIUFF!</a>
             <a href='login.html'>Palasport</a>
             <a href='login.html'>Contatti</a>-->
          </div>
          <div class="cart-prod hiddenbox">
             <div class="sec-prod">
              <div class="content-cart-prod">
                <i class="fa fa-times"></i>
                <img src="http://placehold.it/160x160" alt="" />
                <p>FIVE BLX</p>
                <p>1 X $55.00</p>
              </div>
              <div class="content-cart-prod">
                <i class="fa fa-times"></i>
                <img class="racket-img" src="http://placehold.it/160x160" alt="" />
                <p>FIVE BLX</p>
                <p>1 X $125.00</p>
              </div>
               <div class="content-cart-prod">
                <p class="cart-tot-price">Total: $180.00</p>
                <a href="#" class="btn-cart">Go to cart</a>
                <a href="#" class="btn-cart">Checkout</a>
              </div>
             </div>
          </div>
        </div>
      </div>
     </section>
      <!--SECTION MENU -->
     <section class="container box-logo">
        <header>
           <div class="content-logo col-md-12">
          <div class="logo"> 
            <?php
			  $image_id = get_option('logo');
			  $image_url = wp_get_attachment_image_src($image_id, 'full');
			  $logo = $image_url[0];
			  ?>
			  <a href="<?php echo site_url(); ?>"><img src="<?=$logo?>"
				  alt="" /></a>
          </div>          
          <div class="bt-menu"><a href="#" class="menu"><span> &equiv; </span> Menu</a></div>
         <div class="box-menu">
			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<nav id="cbp-hrmenu" class="cbp-hrmenu">					
					<?php									
					wp_nav_menu( array(
          'theme_location'   => 'footer',
          'depth' => 3,
          'container' => false,
          'walker' => new WPDocs_Walker_Nav_Menu()
        ) );
		
					?>
				</nav>
			<?php
			endif;
			?>
            <!--<nav id="cbp-hrmenu" class="cbp-hrmenu">
					    <ul id="menu">    
                            <li><a class="lnk-menu active" href="<?php echo site_url(); ?>">Home</a></li>
                            <li>
								<a class="lnk-menu" href="#">Società</a>
                                <div class="cbp-hrsub sub-little">
                                  <div class="cbp-hrsub-inner"> 
                                      <div class="content-sub-menu">
								        <ul class="menu-pages w100">
                                            <li><a href="<?php echo site_url(); ?>/organigramma"><span>Organigramma</span></a></li>
									        <li><a href="<?php echo site_url(); ?>/storia"><span>Storia</span></a></li>
								          </ul>
                                        </div>
                                    </div>
                                </div>
							</li>
							<li>
								<a class="lnk-menu" href="<?php echo site_url(); ?>/serieb">Serie B</a>
                               
							</li>
                            <li>
								<a class="lnk-menu" href="#">Junior</a>
                                <div class="cbp-hrsub sub-little">
                                  <div class="cbp-hrsub-inner"> 
                                      <div class="content-sub-menu">
								        <ul class="menu-pages w100">
                                            <li><a href="promozione.html"><span>Promozione</span></a></li>
									        <li><a href="under18.html"><span>Under 18 Eccellenza</span></a></li>
                                            <li><a href="under16.html"><span>Under 16 Eccellenza</span></a></li>
                                            <li><a href="under15.html"><span>Under 15</span></a></li>
                                            <li><a href="under14.html"><span>Under 14</span></a></li>
                                            <li><a href="under13.html"><span>Under 13</span></a></li>
                                            <li><a href="underfem.html"><span>Under Femminile</span></a></li>
                                            <li><a href="minib.html"><span>Minibasket</span></a></li>
								        </ul>
                                        </div>
                                    </div>
                                </div>
							</li>
                        <li><a class="lnk-menu" href="#">Classifica</a>
                                <div class="cbp-hrsub sub-little">
                                  <div class="cbp-hrsub-inner"> 
                                      <div class="content-sub-menu">
								        <ul class="menu-pages w100">
                                            <li><a href="#"><span>Serie B</span></a></li>
									        <li><a href="#"><span>Promozione</span></a></li>
									        <li><a href="#"><span>Under 18 Eccellenza</span></a></li>
                                            <li><a href="#"><span>Under 16 Eccellenza</span></a></li>
                                            <li><a href="#"><span>Under 15</span></a></li>
                                            <li><a href="#"><span>Under 14</span></a></li>
                                            <li><a href="#"><span>Under 13</span></a></li>
                                            <li><a href="#"><span>Under Femminile</span></a></li>
                                            <li><a href="#"><span>Minibasket</span></a></li>
								        </ul>
                                        </div>
                                    </div>
                                </div></li>
						<li><a class="lnk-menu" href="<?php echo site_url(); ?>/calendario">Calendario</a></li>
                        <li><a class="lnk-menu" href="#">Media</a>
                                <div class="cbp-hrsub sub-little">
                                  <div class="cbp-hrsub-inner"> 
                                      <div class="content-sub-menu">
								        <ul class="menu-pages w100">
                                            <li><a href="<?php echo site_url(); ?>/photogallery"><span>Photo Gallery</span></a></li>
                                            <li><a href="<?php echo site_url(); ?>/videogallery"><span>Video gallery</span></a></li>
									   </ul>
                                      </div>
                                  </div>
                                </div></li>
                            <li><a class="lnk-menu" href="<?php echo site_url(); ?>/news">Ufficio Stampa</a></li>
                            <li>
								<a class="lnk-menu" href="#">MAGIC COLLEGE</a>
                                <div class="cbp-hrsub sub-little">
                                  <div class="cbp-hrsub-inner"> 
                                      <div class="content-sub-menu">
								        <ul class="menu-pages w100">
                                            <li><a href="http://www.collegebasketball.it" target="_blank"><span>College basketball</span></a></li>
									        <li><a href="http://www.novarabasket.it" target="_blank"><span>Novara basket</span></a></li>
                                            <li><a href="http://www.aronabasket.it" target="_blank"><span>Arona basket</span></a></li>
									        <li><a href="http://www.basketgalliate.com" target="_blank"><span>Basket galliate</span></a></li>
								          </ul>
                                        </div>
                                    </div>
                                </div>
							</li>
					</ul>
				</nav>-->
              </div>
			</div>
	    </header>
     </section>
