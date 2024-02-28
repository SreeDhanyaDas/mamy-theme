<?php
/**
 * Template Name: Storia
 */
get_header();
$post = get_post(get_the_ID()); 
$content = apply_filters('the_content', $post->post_content); 
?>
  <section class="drawer">
  <?php
      $page_banner_id = get_option('single_page_banner');
      $page_banner_url = wp_get_attachment_image_src($page_banner_id, 'full');
      $page_banner_image = $page_banner_url[0];
    ?>
    <div class="col-md-12 size-img back-img" style='background: url(<?= $page_banner_image ?>) no-repeat top center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;' >
        
    <!-- <div class="col-md-12 size-img back-img"> -->
        <div class="effect-cover">
            <h3 class="txt-advert animated">Storia</h3>
            <p class="txt-advert-sub">Dagli anni '70 a oggi... </p>
        </div>
    </div>
    
    <section id="summary" class="container secondary-page">
      <div class="general general-results">
           <div id="c-calend" class="top-score-title right-score col-md-12" style="margin-bottom:50px; font-size: 18px; line-height: 25px; text-align: justify;">
                <h3><span>La nostra </span>storia<span class="point-little">.</span></h3>
                <?php echo $content; ?>
                <!--div class="accordion" id="section1"><i class="fa fa-calendar-o"></i>JANUARY<span></span></div>
                    <div class="acc-content">
                            <div class="col-md-1 acc-title">Cat.</div>
                            <div class="col-md-2 acc-title">Date</div>
                            <div class="col-md-3 acc-title">Tournament</div>
                            <div class="col-md-2 acc-title">$ Money</div>
                            <div class="col-md-2 acc-title">Draw</div>
                            <div class="col-md-2 acc-title">Winners</div>
                            
                            <div class="col-md-1 timg"><img src="<?php echo get_template_directory_uri();?>/images/atp_img.png" alt="" /></div>
                            <div class="col-md-2 t1"><p>29.12.2013</p></div>
                            <div class="col-md-3 t2"><p>Brisbane International presented by Suncorp</p> </div>
                            <div class="col-md-2 t3"><p>$ 552,670</p></div>
                            <div class="col-md-2 t4"><p>SGL 28 <br />DBL 16</p></div>
                            <div class="col-md-2 t5"><p>Robert Roy</p></div>
                            <div class="acc-footer"></div>

                            <div class="col-md-1 timg"><img src="<?php echo get_template_directory_uri();?>/images/atp_img.png" alt="" /></div>
                            <div class="col-md-2 t1"><p>30.12.2013</p></div>
                            <div class="col-md-3 t2"><p>Qatar ExxonMobil Open</p> </div>
                            <div class="col-md-2 t3"><p>$ 1,096,910</p></div>
                            <div class="col-md-2 t4"><p>SGL 32<br />DBL 16</p></div>
                            <div class="col-md-2 t5"><p>Rafael Doe</p></div>
                            <div class="acc-footer"></div>

                            <div class="col-md-1 timg"><img src="<?php echo get_template_directory_uri();?>/images/atp_img.png" alt="" /></div>
                            <div class="col-md-2 t1"><p>06.01.2014</p></div>
                            <div class="col-md-3 t2"><p>Aircel Chennai Open </p> </div>
                            <div class="col-md-2 t3"><p>$ 452,670</p></div>
                            <div class="col-md-2 t4"><p>SGL 28 <br />DBL 16</p></div>
                            <div class="col-md-2 t5"><p> Carlo Zimp</p></div>
                            <div class="acc-footer"></div>

                            <div class="col-md-1 timg"><img src="<?php echo get_template_directory_uri();?>/images/atp_img.png" alt="" /></div>
                            <div class="col-md-2 t1"><p>06.01.2014</p></div>
                            <div class="col-md-3 t2"><p>Aircel Chennai Open </p> </div>
                            <div class="col-md-2 t3"><p>$ 452,670</p></div>
                            <div class="col-md-2 t4"><p>SGL 28 <br />DBL 16</p></div>
                            <div class="col-md-2 t5"><p> Jhon Doe</p></div>
                            <div class="acc-footer"></div>

                            <div class="col-md-1 timg"><img src="<?php echo get_template_directory_uri();?>/images/atp_img.png" alt="" /></div>
                            <div class="col-md-2 t1"><p>29.12.2013</p></div>
                            <div class="col-md-3 t2"><p>Brisbane International presented by Suncorp</p> </div>
                            <div class="col-md-2 t3"><p>$ 552,670</p></div>
                            <div class="col-md-2 t4"><p>SGL 28 <br />DBL 16</p></div>
                            <div class="col-md-2 t5"><p>Robert Roy</p></div>
                            <div class="acc-footer"></div>
                    </div>
                    <div class="accordion" id="section2"><i class="fa fa-calendar-o"></i>FEBRUARY<span></span></div>
                    <div class="acc-content">
                           <div class="col-md-1 acc-title">Cat.</div>
                            <div class="col-md-2 acc-title">Date</div>
                            <div class="col-md-3 acc-title">Tournament</div>
                            <div class="col-md-2 acc-title">$ Money</div>
                            <div class="col-md-2 acc-title">Draw</div>
                            <div class="col-md-2 acc-title">Winners</div>
                            
                            <div class="col-md-1 timg"><img src="<?php echo get_template_directory_uri();?>/images/atp_img.png" alt="" /></div>
                            <div class="col-md-2 t1"><p>29.12.2013</p></div>
                            <div class="col-md-3 t2"><p>Brisbane International presented by Suncorp</p> </div>
                            <div class="col-md-2 t3"><p>$ 552,670</p></div>
                            <div class="col-md-2 t4"><p>SGL 28 <br />DBL 16</p></div>
                            <div class="col-md-2 t5"><p>Jhon Doe</p></div>
                            <div class="acc-footer"></div>

                            <div class="col-md-1 timg"><img src="<?php echo get_template_directory_uri();?>/images/atp_img.png" alt="" /></div>
                            <div class="col-md-2 t1"><p>30.12.2013</p></div>
                            <div class="col-md-3 t2"><p>Qatar ExxonMobil Open</p> </div>
                            <div class="col-md-2 t3"><p>$ 1,096,910</p></div>
                            <div class="col-md-2 t4"><p>SGL 32<br />DBL 16</p></div>
                            <div class="col-md-2 t5"><p>Jhon Doe</p></div>
                            <div class="acc-footer"></div>
                    </div>
                    <div class="accordion" id="section3"><i class="fa fa-calendar-o"></i>MARCH<span></span></div>
                    <div class="acc-content">
                           <div class="col-md-1 acc-title">Cat.</div>
                            <div class="col-md-2 acc-title">Date</div>
                            <div class="col-md-3 acc-title">Tournament</div>
                            <div class="col-md-2 acc-title">$ Money</div>
                            <div class="col-md-2 acc-title">Draw</div>
                            <div class="col-md-2 acc-title">Winners</div>

                            <div class="col-md-1 timg"><img src="<?php echo get_template_directory_uri();?>/images/atp_img.png" alt="" /></div>
                            <div class="col-md-2 t1"><p>30.12.2013</p></div>
                            <div class="col-md-3 t2"><p>Qatar ExxonMobil Open</p> </div>
                            <div class="col-md-2 t3"><p>$ 1,096,910</p></div>
                            <div class="col-md-2 t4"><p>SGL 32<br />DBL 16</p></div>
                            <div class="col-md-2 t5"><p>Jhon Doe</p></div>
                            <div class="acc-footer"></div>

                            <div class="col-md-1 timg"><img src="<?php echo get_template_directory_uri();?>/images/atp_img.png" alt="" /></div>
                            <div class="col-md-2 t1"><p>30.12.2013</p></div>
                            <div class="col-md-3 t2"><p>Qatar ExxonMobil Open</p> </div>
                            <div class="col-md-2 t3"><p>$ 1,096,910</p></div>
                            <div class="col-md-2 t4"><p>SGL 32<br />DBL 16</p></div>
                            <div class="col-md-2 t5"><p>Jhon Doe</p></div>
                            <div class="acc-footer"></div>

                            <div class="col-md-1 timg"><img src="<?php echo get_template_directory_uri();?>/images/atp_img.png" alt="" /></div>
                            <div class="col-md-2 t1"><p>30.12.2013</p></div>
                            <div class="col-md-3 t2"><p>Qatar ExxonMobil Open</p> </div>
                            <div class="col-md-2 t3"><p>$ 1,096,910</p></div>
                            <div class="col-md-2 t4"><p>SGL 32<br />DBL 16</p></div>
                            <div class="col-md-2 t5"><p>Jhon Doe</p></div>
                            <div class="acc-footer"></div>
                    </div>
                    <div class="accordion" id="section4"><i class="fa fa-calendar-o"></i>APRIL<span></span></div>
                    <div class="acc-content">
                            <div class="col-md-1 acc-title">Cat.</div>
                            <div class="col-md-2 acc-title">Date</div>
                            <div class="col-md-3 acc-title">Tournament</div>
                            <div class="col-md-2 acc-title">$ Money</div>
                            <div class="col-md-2 acc-title">Draw</div>
                            <div class="col-md-2 acc-title">Winners</div>
                            
                            <div class="col-md-1 timg"><img src="<?php echo get_template_directory_uri();?>/images/atp_img.png" alt="" /></div>
                            <div class="col-md-2 t1"><p>29.12.2013</p></div>
                            <div class="col-md-3 t2"><p>Brisbane International presented by Suncorp</p> </div>
                            <div class="col-md-2 t3"><p>$ 552,670</p></div>
                            <div class="col-md-2 t4"><p>SGL 28 <br />DBL 16</p></div>
                            <div class="col-md-2 t5"><p>Jhon Doe</p></div>
                            <div class="acc-footer"></div>

                            <div class="col-md-1 timg"><img src="<?php echo get_template_directory_uri();?>/images/atp_img.png" alt="" /></div>
                            <div class="col-md-2 t1"><p>30.12.2013</p></div>
                            <div class="col-md-3 t2"><p>Qatar ExxonMobil Open</p> </div>
                            <div class="col-md-2 t3"><p>$ 1,096,910</p></div>
                            <div class="col-md-2 t4"><p>SGL 32<br />DBL 16</p></div>
                            <div class="col-md-2 t5"><p>Jhon Doe</p></div>
                            <div class="acc-footer"></div>
                    </div>
                    <div class="accordion" id="section5"><i class="fa fa-calendar-o"></i>MAY<span></span></div>
                    <div class="acc-content">
                            <div>Sample Content</div>
                            <p>Content here....</p>
                    </div>
                    <div class="accordion" id="section6"><i class="fa fa-calendar-o"></i>JUNE<span></span></div>
                    <div class="acc-content">
                            <div>Sample Content</div>
                            <p>Content here....</p>
                    </div>
                    <div class="accordion" id="section7"><i class="fa fa-calendar-o"></i>JULY<span></span></div>
                    <div class="acc-content">
                            <div>Sample Content</div>
                            <p>Content here....</p>
                    </div>
                    <div class="accordion" id="section8"><i class="fa fa-calendar-o"></i>AUGUST<span></span></div>
                    <div class="acc-content">
                            <div>Sample Content</div>
                            <p>Content here....</p>
                    </div>
                    <div class="accordion" id="section9"><i class="fa fa-calendar-o"></i>SEPTEMBER<span></span></div>
                    <div class="acc-content">
                            <div>Sample Content</div>
                            <p>Content here....</p>
                    </div>
                    <div class="accordion" id="section10"><i class="fa fa-calendar-o"></i>OCTOBER<span></span></div>
                    <div class="acc-content">
                            <div>Sample Content</div>
                            <p>Content here....</p>
                    </div>
                    <div class="accordion" id="section11"><i class="fa fa-calendar-o"></i>NOVEMBER<span></span></div>
                    <div class="acc-content">
                            <div>Sample Content</div>
                            <p>Content here....</p>
                    </div-->

           </div><!--Close Top Match-->
           <div class="col-md-3 right-column">
           <!--<div class="top-score-title col-md-12 right-title">
                <h3>Ultime News</h3>
                <div class="right-content">
                    <p class="news-title-right">A New Old Life</p>
                    <p class="txt-right">Simon, who’s seeded just a lowly 26th here, was in many ways the right man for this grueling assignment</p>
                    <a href="single_news.html" class="ca-more"><i class="fa fa-angle-double-right"></i>continua...</a>
                </div>
                <div class="right-content">
                    <p class="news-title-right">A New Old Life</p>
                    <p class="txt-right">Simon, who’s seeded just a lowly 26th here, was in many ways the right man for this grueling assignment</p>
                    <a href="single_news.html" class="ca-more"><i class="fa fa-angle-double-right"></i>continua...</a>
                </div>
                <div class="right-content">
                    <p class="news-title-right">A New Old Life</p>
                    <p class="txt-right">Simon, who’s seeded just a lowly 26th here, was in many ways the right man for this grueling assignment</p>
                    <a href="single_news.html" class="ca-more"><i class="fa fa-angle-double-right"></i>continua...</a>
                </div>
          </div>-->
          <!--div class="top-score-title col-md-12">
            <img src="http://placehold.it/1000x475" alt="" />
          </div-->
          <!--div class="top-score-title col-md-12 right-title">
                <h3>Photos</h3> 
               <ul class="right-last-photo">
                        <li>
                            <div class="jm-item second">
							    <div class="jm-item-wrapper">
								    <div class="jm-item-image">
									    <img src="http://placehold.it/320x213" alt="" />
									    <div class="jm-item-description">
                                            <div class="jm-item-button">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </div>
								    </div>	
							    </div>
						    </div>
                        </li>
                        <li>
                            <div class="jm-item second">
							    <div class="jm-item-wrapper">
								    <div class="jm-item-image">
									    <img src="http://placehold.it/320x213" alt="" />
									    <div class="jm-item-description">
                                            <div class="jm-item-button">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </div>
								    </div>	
							    </div>
						    </div>
                        </li>
                        <li>
                            <div class="jm-item second">
							    <div class="jm-item-wrapper">
								    <div class="jm-item-image">
									    <img src="http://placehold.it/320x213" alt="" />
									    <div class="jm-item-description">
                                            <div class="jm-item-button">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </div>
								    </div>	
							    </div>
						    </div>
                        </li>
                        <li>
                            <div class="jm-item second">
							    <div class="jm-item-wrapper">
								    <div class="jm-item-image">
									    <img src="http://placehold.it/320x213" alt="" />
									    <div class="jm-item-description">
                                            <div class="jm-item-button">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </div>
								    </div>	
							    </div>
						    </div>
                        </li>
                        <li>
                            <div class="jm-item second">
							    <div class="jm-item-wrapper">
								    <div class="jm-item-image">
									    <img src="http://placehold.it/320x213" alt="" />
									    <div class="jm-item-description">
                                            <div class="jm-item-button">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </div>
								    </div>	
							    </div>
						    </div>
                        </li>
                        <li>
                            <div class="jm-item second">
							    <div class="jm-item-wrapper">
								    <div class="jm-item-image">
									    <img src="http://placehold.it/320x213" alt="" />
									    <div class="jm-item-description">
                                            <div class="jm-item-button">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </div>
								    </div>	
							    </div>
						    </div>
                        </li>
                        <li>
                            <div class="jm-item second">
							    <div class="jm-item-wrapper">
								    <div class="jm-item-image">
									    <img src="http://placehold.it/320x213" alt="" />
									    <div class="jm-item-description">
                                            <div class="jm-item-button">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </div>
								    </div>	
							    </div>
						    </div>
                        </li>
                        <li>
                            <div class="jm-item second">
							    <div class="jm-item-wrapper">
								    <div class="jm-item-image">
									    <img src="http://placehold.it/320x213" alt="" />
									    <div class="jm-item-description">
                                            <div class="jm-item-button">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </div>
								    </div>	
							    </div>
						    </div>
                        </li>
                        <li>
                            <div class="jm-item second">
							    <div class="jm-item-wrapper">
								    <div class="jm-item-image">
									    <img src="http://placehold.it/320x213" alt="" />
									    <div class="jm-item-description">
                                            <div class="jm-item-button">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </div>
								    </div>	
							    </div>
						    </div>
                        </li>
                </ul>
          </div-->
         </div>
        </section>
        

<?php 
get_footer();
