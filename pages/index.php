<?php
session_start();
require_once "../controller/db_operations.php";
if(isset($_SESSION["user_obj"])){
    $user = $_SESSION["user_obj"];
}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="initial-scale=1.0" />

    <title>Nursery System</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Lato%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C700%2C700italic%2C900%2C900italic&amp;subset=latin&amp;' type='text/css' media='all' />
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Noto+Sans%3Aregular%2Citalic%2C700%2C700italic&amp;subset=greek%2Ccyrillic-ext%2Ccyrillic%2Clatin%2Clatin-ext%2Cvietnamese%2Cgreek-ext&amp;' type='text/css' media='all' />
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Merriweather%3A300%2C300italic%2Cregular%2Citalic%2C700%2C700italic%2C900%2C900italic&amp;subset=latin%2Clatin-ext&amp;' type='text/css' media='all' />
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Mystery+Quest%3Aregular&amp;subset=latin%2Clatin-ext&amp;' type='text/css' media='all' />


    <link rel='stylesheet' href='../css/style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../plugins/superfish/css/superfish.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../plugins/dl-menu/component.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../plugins/font-awesome-new/css/font-awesome.min.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../plugins/elegant-font/style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../plugins/fancybox/jquery.fancybox.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../plugins/flexslider/flexslider.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../css/style-responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../css/style-custom.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../plugins/masterslider/public/assets/css/masterslider.main.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../css/master-custom.css' type='text/css' media='all' />


</head>

<body data-rsssl=1 class="home page-template-default page page-id-5680 _masterslider _msp_version_3.2.7 woocommerce-no-js">
    <div class="body-wrapper  float-menu" data-home="https://demo.goodlayers.com/greennature/">
        <header class="greennature-header-wrapper header-style-5-wrapper greennature-header-with-top-bar">
        
            <div id="greennature-header-substitute"></div>
            <div class="greennature-header-inner header-inner-header-style-5">
                <div class="greennature-header-container container">
                    <div class="greennature-header-inner-overlay"></div>
                
                    <div class="greennature-logo">
                        <div class="greennature-logo-inner" style="width: 200px; font-weight: bold">
                            <a href="index.php">
                                <img style="float: left;" src="../images/logo2.png" alt="The little wings" /> </a>
                                <p style="font-size: 20px" class="text-white">The little wings</p>
                        </div>
                        <div class="greennature-responsive-navigation dl-menuwrapper" id="greennature-responsive-navigation">
                            <button class="dl-trigger">Open Menu</button>
                            <ul id="menu-main-menu" class="dl-menu greennature-main-mobile-menu">
                                <li class="menu-item menu-item-home current-menu-item page_item page-item-5680 current_page_item"><a href="index.php" aria-current="page">Home</a></li>
                                <li class="menu-item menu-item-has-children menu-item-15">
                                    
                                </li>
                               
       
                            </ul>
                        </div>
                    </div>
                    <!-- navigation -->
                    <div class="greennature-navigation-wrapper">
                        <nav class="greennature-navigation" id="greennature-main-navigation">
                            <ul id="menu-main-menu-1" class="sf-menu greennature-main-menu">
                                <li class="menu-item menu-item-home current-menu-item greennature-normal-menu"><a href=""><i class="fa fa-home"></i>Home</a></li>
                                 <li class="menu-item menu-item-home current-menu-item greennature-normal-menu"><a href="#features"><i class="fa fa-group"></i> The Features </a></li>
                                 <?php
                                 if(isset($user)){
                                     $routePage = Controller::routeToAuthorizedPage($user["rule"]);
                                    echo "<li class='menu-item menu-item-home current-menu-item greennature-normal-menu'><a href='../controller/admin_controller.php?outMe=true'><i class='fa fa-sign-out'></i>Logout</a></li>"
                                    . "<li class='menu-item menu-item-home current-menu-item greennature-normal-menu'><a href='../pages/".$routePage."'><i class='fa fa-sign-out'></i>Back To Console</a></li>";
                                 } else {
                                    echo "<li class='menu-item menu-item-home current-menu-item greennature-normal-menu'><a href='login.php'><i class='fa fa-sign-in'></i>Login</a></li>";
                                }
                                 ?>
                               
                              
                            </ul>

                        </nav>
                        <div class="greennature-navigation-gimmick" id="greennature-navigation-gimmick"></div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </header>
        <!-- is search -->
        <div class="content-wrapper">
            <div class="greennature-content">

                <!-- Above Sidebar Section-->

                <!-- Sidebar With Content Section-->
                <div class="with-sidebar-wrapper">
                    <section id="content-section-1">
                        <div class="greennature-full-size-wrapper gdlr-show-all no-skin" style="padding-bottom: 0px;  background-color: #ffffff; ">
                            <div class="greennature-master-slider-item greennature-slider-item greennature-item" style="margin-bottom: 0px;">
                                <!-- MasterSlider -->
                                <div id="P_slider_1" class="master-slider-parent ms-parent-id-1">

                                    <!-- MasterSlider Main -->
                                    <div id="slider_1" class="master-slider ms-skin-default">

                                        <div class="ms-slide" data-delay="7" data-fill-mode="fill">
                                            <img src="../plugins/masterslider/public/assets/css/blank.gif" alt="" title="" data-src="../upload/nn.jpg" />

                                           
                                            <div class="ms-layer  msp-cn-1-3" style="" data-effect="t(true,150,n,n,n,n,n,n,n,n,n,n,n,n,n)" data-duration="437" data-delay="625" data-ease="easeOutQuint" data-offset-x="0" data-offset-y="105" data-origin="ml" data-position="normal">
                                            Children</div>

                                            <div class="ms-layer  msp-cn-1-2" style="" data-effect="t(true,150,n,n,n,n,n,n,n,n,n,n,n,n,n)" data-duration="425" data-delay="325" data-ease="easeOutQuint" data-offset-x="0" data-offset-y="-5" data-origin="ml" data-position="normal">
                                                We care</div>

                                            <div class="ms-layer  msp-cn-1-1" style="" data-effect="t(true,150,n,n,n,n,n,n,n,n,n,n,n,n,n)" data-duration="350" data-ease="easeOutQuint" data-offset-x="0" data-offset-y="-100" data-origin="ml" data-position="normal">
                                            about your</div>

                                        </div>
                                        <div class="ms-slide" data-delay="7" data-fill-mode="fill">
                                            <img src="../plugins/masterslider/public/assets/css/blank.gif" alt="" title="" data-src="../upload/zz.jpg" />

                                            

                                            <div class="ms-layer  msp-cn-1-9" style="" data-effect="t(true,150,n,n,n,n,n,n,n,n,n,n,n,n,n)" data-duration="437" data-delay="625" data-ease="easeOutQuint" data-offset-x="0" data-offset-y="139" data-origin="ml" data-position="normal">
                                                Save Child</div>

                                            <div class="ms-layer  msp-cn-1-7" style="" data-effect="t(true,150,n,n,n,n,n,n,n,n,n,n,n,n,n)" data-duration="437" data-delay="625" data-ease="easeOutQuint" data-offset-x="383" data-offset-y="139" data-origin="ml" data-position="normal">
                                              ren </div>

                                            <div class="ms-layer  msp-cn-1-5" style="" data-effect="t(true,150,n,n,n,n,n,n,n,n,n,n,n,n,n)" data-duration="350" data-ease="easeOutQuint" data-offset-x="0" data-offset-y="52" data-origin="ml" data-position="normal">
                                                Help Us</div>

                                        </div>
                                        <div class="ms-slide" data-delay="7" data-fill-mode="fill">
                                            <img src="../plugins/masterslider/public/assets/css/blank.gif" alt="" title="" data-src="../upload/ll.jpg" />

                                            <div class="ms-layer  msp-cn-1-10" style="" data-effect="t(true,n,n,-500,n,n,n,n,n,n,n,n,n,n,n)" data-duration="425" data-delay="425" data-ease="easeOutQuint" data-offset-x="0" data-offset-y="82" data-origin="mc" data-position="normal">
                                                The Better Place</div>

                                            <div class="ms-layer  msp-cn-1-10" style="" data-effect="t(true,n,n,500,n,n,n,n,n,n,n,n,n,n,n)" data-duration="437" data-ease="easeOutQuint" data-offset-x="0" data-offset-y="-15" data-origin="mc" data-position="normal">
                                                Make This World</div>

                                        </div>

                                    </div>
                                    <!-- END MasterSlider Main -->

                                </div>
                                <!-- END MasterSlider -->


                            </div>
                            <div class="clear"></div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </section>
                    <section id="content-section-2">
                        <div class="greennature-color-wrapper  gdlr-show-all greennature-skin-brown-column-service" style="background-color: #2d2418;  border-top: 5px solid #3f3221; padding-top: 0px; padding-bottom: 0px; ">
                            <div class="container">
                                <div class="four columns">
                                    <div class="greennature-ux column-service-ux">
                                        <div class="greennature-item greennature-column-service-item greennature-type-2" style="margin-bottom: 0px;">
                                            <div class="column-service-image"><img src="../upload/icon-service-1.png" alt="" width="80" height="80" /></div>
                                            <div class="column-service-content-wrapper">
                                                <h3 class="column-service-title">Confidence and reassurance</h3>
                                                <div class="column-service-content greennature-skin-content">
                                                    <p>We are always keen to provide the best we have to gain your confidence, and provide services that guarantee you confidentiality and privacy.</p>
                                                </div></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="four columns">
                                    <div class="greennature-ux column-service-ux">
                                        <div class="greennature-item greennature-column-service-item greennature-type-2-bg" style="margin-bottom: 0px">
                                            <div class="column-service-image"><img src="../upload/icon-service-2.png" alt="" width="80" height="80" /></div>
                                            <div class="column-service-content-wrapper">
                                                <h3 class="column-service-title">any time</h3>
                                                <div class="column-service-content greennature-skin-content">
                                                    <p>We are available at all times to serve you, and to provide you with the best services.</p>
                                                </div></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="four columns">
                                    <div class="greennature-ux column-service-ux">
                                        <div class="greennature-item greennature-column-service-item greennature-type-2" style="margin-bottom: 0px;">
                                            <div class="column-service-image"><img src="../upload/icon-service-3.png" alt="" width="80" height="80" /></div>
                                            <div class="column-service-content-wrapper">
                                                <h3 class="column-service-title">They are near you
                                                    </h3>
                                                <div class="column-service-content greennature-skin-content">
                                                    <p>We provide you with the possibility of finding nurseries near your area,
                                                        With insights into the prices and services provided by each nursery</p>
                                                </div></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </section>
                    <section id="content-section-3">
                        <div class="greennature-parallax-wrapper greennature-background-image gdlr-show-all no-skin" id="greennature-parallax-wrapper-1" data-bgspeed="0.11" style="background-image: url('../upload/kk.jpg'); padding-top: 90px; padding-bottom: 65px;  ">
                            <div class="container">
                                <div class="six columns">
                                    <div class="greennature-item greennature-action-ads-item" style="background: url('../upload/donation-bg-1.jpg'); ">
                                        <h3 class="action-ads-title" style="color: #facc2e;">Register your child </h3>
                                        <div class="action-ads-caption greennature-skin-info">We help you save your time</div>
                                        <div class="action-ads-divider" style="background: #facc2e;"></div>
                                        <div class="action-ads-content">
                                            <p>Register your child in any nursery you want and from your home without the need to search for a long time, as you can watch the users ’evaluation of the services provided by each nursery before you register your child in it.</p>
                                          
                                           </div>
                                    </div>
                                </div>
                                <div class="six columns">
                                    <div class="greennature-item greennature-action-ads-item" style="background: url('../upload/donation-bg-2.jpg'); ">
                                        <h3 class="action-ads-title" style="color: #5dc269;">Manage your nursery</h3>
                                        <div class="action-ads-caption greennature-skin-info">We help you manage your nursery easily</div>
                                        <div class="action-ads-divider" style="background: #5dc269;"></div>
                                        <div class="action-ads-content">
                                            <p>We provide you with many features that help you manage your nursery, you can see all the children registered in your nursery, manage payments, and many other features.</p>
                                            </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </section>
                    
                    <section id="content-section-5">
                        <div class="greennature-color-wrapper  gdlr-show-all greennature-skin-service-half greennature-half-bg-wrapper" style="background-color: #f5f5f5; padding-bottom: 20px; ">
                            <div class="greennature-half-bg greennature-bg-solid" style="background-image: url(../upload/kids.jpg);"></div>
                            <div class="container">
                                <div class="six columns">
                                    <div class="greennature-item greennature-content-item"></div>
                                </div>
                                <div class="six columns">
                                    <div class="greennature-item greennature-icon-with-list-item">
                                        <div class="list-with-icon-ux greennature-ux">
                                            <div class="list-with-icon greennature-left">
                                                <div class="list-with-icon-image"><img src="../upload/icon-1.png" alt="" width="80" height="80" /></div>
                                                <div class="list-with-icon-content">
                                                    <div class="list-with-icon-title greennature-skin-title" id="features">Providing job opportunities for babysitter</div>
                                                    <div class="list-with-icon-caption">
                                                        <p>Each babysitter registered in the system can see all the nurseries that need a babysitter, or record their details easily, or can be contacted by phone number in order to work at home.</p>
                                                    </div>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                        <div class="list-with-icon-ux greennature-ux">
                                            <div class="list-with-icon greennature-left">
                                                <div class="list-with-icon-image"><img src="../upload/icon-2.png" alt="" width="80" height="80" /></div>
                                                <div class="list-with-icon-content">
                                                    <div class="list-with-icon-title greennature-skin-title">Save time and wasted effort in looking for a nursery</div>
                                                    <div class="list-with-icon-caption">
                                                        <p>You can search for the nursery according to the price or the region in which you live, and register your child in any nursery you want, with the ability to see the evaluation of previous users of that nursery's services.</p>
                                                    </div>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                        <div class="list-with-icon-ux greennature-ux">
                                            <div class="list-with-icon greennature-left">
                                                <div class="list-with-icon-image"><img src="../upload/icon-3.png" alt="" width="80" height="80" /></div>
                                                <div class="list-with-icon-content">
                                                    <div class="list-with-icon-title greennature-skin-title">Facilitate the process of managing your nursery</div>
                                                    <div class="list-with-icon-caption">
                                                        <p>A nursery manager can easily manage his nursery, while providing access to all of the babysitters and children enrolled in his nursery.</p>
                                                    </div>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </section>
                    
                    <section id="content-section-7">
                        <div class="greennature-parallax-wrapper greennature-background-image gdlr-show-all greennature-skin-newsletter" id="greennature-parallax-wrapper-2" data-bgspeed="0" style="background-image: url('../upload/newsletter-bg.jpg'); padding-top: 145px; padding-bottom: 60px; ">
                            <div class="container">
                                <div class="greennature-title-item" style="margin-bottom: 45px;">
                                    <div class="greennature-item-title-wrapper greennature-item  greennature-center greennature-large ">
                                        <div class="greennature-item-title-container container">
                                            <div class="greennature-item-title-head">
                                                <h3 class="greennature-item-title greennature-skin-title greennature-skin-border">Subscribe To Newsletter</h3>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="greennature-subscribe-item greennature-item">
                                    <div class="greennature-newsletter-subscribe">

                                        <div class="newsletter newsletter-subscription">
                                            <form method="post" action="#" onsubmit="return newsletter_check(this)">
                                                <input class="newsletter-email" type="email" name="ne" size="30" required placeholder="Please fill your email" />
                                                <input class="newsletter-submit greennature-button" type="submit" value="Subscribe!" />
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </section>
                    
                    <section id="content-section-9">
                        <div class="greennature-parallax-wrapper greennature-background-image gdlr-show-all greennature-skin-dark-skin" id="greennature-parallax-wrapper-3" data-bgspeed="0.15" style="background-image: url('../upload/service-bg-2.jpg'); padding-top: 135px; padding-bottom: 80px; ">
                            <div class="container">
                                <div class="three columns">
                                    <div class="greennature-skill-item-wrapper greennature-skin-content greennature-item greennature-style-2" style="margin-bottom: 70px;"><img src="../upload/icon-4.png" alt="" width="80" height="80" />
                                        <div class="greennature-skill-item-title" style="color: #5dc269;">1,000,000 Nursery</div>
                                        <div class="greennature-skill-item-caption" style="color: #ffffff;">spread in the Kingdom</div>
                                    </div>
                                </div>
                                <div class="three columns">
                                    <div class="greennature-skill-item-wrapper greennature-skin-content greennature-item greennature-style-2" style="margin-bottom: 70px;"><img src="../upload/icon-5.png" alt="" width="80" height="80" />
                                        <div class="greennature-skill-item-title" style="color: #5dc269;">1.7 million</div>
                                        <div class="greennature-skill-item-caption" style="color: #ffffff;">Visit the site</div>
                                    </div>
                                </div>
                                <div class="three columns">
                                    <div class="greennature-skill-item-wrapper greennature-skin-content greennature-item greennature-style-2" style="margin-bottom: 70px;"><img src="../upload/icon-1.png" alt="" width="80" height="80" />
                                        <div class="greennature-skill-item-title" style="color: #5dc269;">7636 beneficiaries</div>
                                        <div class="greennature-skill-item-caption" style="color: #ffffff;">From mothers and fathers</div>
                                    </div>
                                </div>
                                <div class="three columns">
                                    <div class="greennature-skill-item-wrapper greennature-skin-content greennature-item greennature-style-2" style="margin-bottom: 70px;"><img src="../upload/icon-2.png" alt="" width="80" height="80" />
                                        <div class="greennature-skill-item-title" style="color: #5dc269;">2000 babysitters</div>
                                        <div class="greennature-skill-item-caption" style="color: #ffffff;">Are rehabilitated</div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="clear"></div>
                                <div class="greennature-item greennature-divider-item" style="margin-bottom: 60px;">
                                    <div class="greennature-divider thick"></div>
                                </div>
                                <div class="clear"></div>
                                <div class="greennature-stunning-item-ux greennature-ux">
                                    <div class="greennature-item greennature-stunning-item greennature-stunning-center">
                                        <h2 class="stunning-item-title">The only way to make this happened is to take action!</h2>
                                        <div class="stunning-item-caption greennature-skin-content">
                                            <p>
                                            Register your child with us and enjoy the peace, comfort and safety of your child
                                        </p>
                                        </div>
                                    <!--     <a class="stunning-item-button greennature-button large greennature-lb-payment" href="#" style="background-color: #ecb338; color: #ffffff;">Donate Now!</a><a class="stunning-item-button greennature-button large" href="#">Act Now!</a>
                                     --></div>
                                </div>
                                <div class="clear"></div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </section>
                </div>
                <!-- Below Sidebar Section-->

            </div>
            <!-- greennature-content -->
            <div class="clear"></div>
        </div>
        <!-- content wrapper -->

        <footer class="footer-wrapper">
            <div class="footer-container container">
                <div class="col-md-6 columns" id="footer-widget-1">
                    <div id="text-5" class="widget widget_text greennature-item greennature-widget">
                        <div class="textwidget">
                            <p><img src="../upload/logo.png" style="width: 170px;" alt="" /></p>
                            <p>Your way to find nurseries, request a home babysitter, manage your own nursery, register now and enjoy the services we provide you.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 columns" id="footer-widget-2">
                    <div id="text-9" class="widget widget_text greennature-item greennature-widget">
                        <h3 class="greennature-widget-title">Contact Info</h3>
                        <div class="clear"></div>
                        <div class="textwidget"><span class="clear"></span><span class="greennature-space" style="margin-top: -6px; display: block;"></span> Address: Jeddah - Sari street - kingdom of saudi arabia

                            <span class="clear"></span><span class="greennature-space" style="margin-top: 10px; display: block;"></span>

                            <i class="greennature-icon fa fa-phone" style="vertical-align: middle; color: #fff; font-size: 16px; "></i>  +966590376356

                            <span class="clear"></span><span class="greennature-space" style="margin-top: 10px; display: block;"></span>

                            <i class="greennature-icon fa fa-mobile" style="vertical-align: middle; color: #fff; font-size: 20px; "></i>  +966590376356

                            <span class="clear"></span><span class="greennature-space" style="margin-top: 10px; display: block;"></span>

                            <i class="greennature-icon fa fa-envelope-o" style="vertical-align: middle; color: #fff; font-size: 16px; "></i> Babynursest1@gmail.com</div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>

            <div class="copyright-wrapper">
                <div class="copyright-container container">
                    <div class="copyright-left">
                    </div>
                    <div class="copyright-right">
                  
                    <div class="clear"></div>
                </div>
            </div>
        </footer>
    </div>
    <!-- body-wrapper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <script type='text/javascript' src='../js/jquery/jquery.js'></script>
    <script type='text/javascript' src='../js/jquery/jquery-migrate.min.js'></script>
    <script>
        var ms_grabbing_curosr = 'plugins/masterslider/public/assets/css/common/grabbing.html',
            ms_grab_curosr = 'plugins/masterslider/public/assets/css/common/grab.html';
    </script>
    <script type='text/javascript' src='../plugins/superfish/js/superfish.js'></script>
    <script type='text/javascript' src='../js/hoverIntent.min.js'></script>
    <script type='text/javascript' src='../plugins/dl-menu/modernizr.custom.js'></script>
    <script type='text/javascript' src='../plugins/dl-menu/jquery.dlmenu.js'></script>
    <script type='text/javascript' src='../plugins/jquery.easing.js'></script>
    <script type='text/javascript' src='../plugins/fancybox/jquery.fancybox.pack.js'></script>
    <script type='text/javascript' src='../plugins/fancybox/helpers/jquery.fancybox-media.js'></script>
    <script type='text/javascript' src='../plugins/fancybox/helpers/jquery.fancybox-thumbs.js'></script>
    <script type='text/javascript' src='../plugins/flexslider/jquery.flexslider.js'></script>
    <script type='text/javascript' src='../plugins/jquery.isotope.min.js'></script>
    <script type='text/javascript' src='../js/plugins.js'></script>
    <script type='text/javascript' src='../plugins/masterslider/public/assets/js/masterslider.min.js'></script>
    <script type='text/javascript' src='../plugins/jquery.transit.min.js'></script>
    <script type='text/javascript' src='../plugins/gdlr-portfolio/gdlr-portfolio-script.js'></script>




    <script>
    (function ( $ ) {
        "use strict";

        $(function () {
            var masterslider_d1da = new MasterSlider();

            // slider controls
			masterslider_d1da.control('arrows'     ,{ autohide:true, overVideo:true  });
			masterslider_d1da.control('bullets'    ,{ autohide:false, overVideo:true, dir:'h', align:'bottom', space:6 , margin:25  });
            // slider setup
            masterslider_d1da.setup("slider_1", {
				width           : 1140,
				height          : 800,
				minHeight       : 0,
				space           : 0,
				start           : 1,
				grabCursor      : false,
				swipe           : true,
				mouse           : false,
				keyboard        : true,
				layout          : "fullwidth",
				wheel           : false,
				autoplay        : false,
                instantStartLayers:false,
				mobileBGVideo:false,
				loop            : true,
				shuffle         : false,
				preload         : 0,
				heightLimit     : true,
				autoHeight      : false,
				smoothHeight    : true,
				endPause        : false,
				overPause       : true,
				fillMode        : "fill",
				centerControls  : true,
				startOnAppear   : false,
				layersMode      : "center",
				autofillTarget  : "",
				hideLayers      : false,
				fullscreenMargin: 0,
				speed           : 20,
				dir             : "h",
				parallaxMode    : 'swipe',
				view            : "basic"
            });
            

            
            $("head").append( "<link rel='stylesheet' id='ms-fonts'  href='http://fonts.googleapis.com/css?family=Montserrat:regular,700%7CCrimson+Text:regular' type='text/css' media='all' />" );

            window.masterslider_instances = window.masterslider_instances || {};
            window.masterslider_instances["5_d1da"] = masterslider_d1da;
         });
        
    })(jQuery);
    </script> 
</body>

<!--  16:08 GMT -->
</html>