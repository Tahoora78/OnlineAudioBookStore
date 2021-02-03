<?php
    $session = session();
?>
<!DOCTYPE html>
<html lang="en">


<head>
     <meta charset="utf-8">
     <meta name="robots" content="index, follow">
     <meta name="keywords" content="Web Design, Education, Institute, Study" />
     <meta name="author" content="ThemeTrades" />
     <meta name="description"
          content="EduChamp is a Fully Creative Mobile Responsive HTML Template. It is designed specifically for University, College, School, Training centre or other educational institute." />
     <link rel="icon" href="<?php echo base_url(); ?>/theme/site/images/favicon.ico" type="image/x-icon" />
     <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>/theme/site/images/favicon.png" />
     <title><?php $this->renderSection('title') ?></title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/theme/site/css/assets.css">
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/theme/site/css/typography.css">
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/theme/site/css/shortcodes/shortcodes.css">
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/theme/site/css/style.css">
     <link class="skin" rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>/theme/site/css/color/color-1.css">
     <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>/theme/site/vendors/revolution/css/layers.css">
     <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>/theme/site/vendors/revolution/css/settings.css">
     <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>/theme/site/vendors/revolution/css/navigation.css">
     <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>/theme/vendors/toastr/toastr.min.css">

     
</head>

<body id="bg">
     <div class="page-wraper">
          <div id="loading-icon-bx"></div>

          <header class="header rs-nav">
               <div class="top-bar">
                    <div class="container">
                         <div class="row d-flex justify-content-between">
                              <div class="topbar-left">
                                   <ul>
                                        <li><a><i class="fa fa-book"></i>فروشگاه آنلاین تخصصی خرید و بررسی کتاب های
                                                  صوتی</a></li>
                                   </ul>
                              </div>
                              <div class="topbar-right">
                                   <ul>
                                        <?php if($session->has('login_user_id')){ ?>
                                        <li><a href="<?php echo base_url('panel'); ?>">پنل کاربری</a></li>
                                        <li><a href="<?php echo base_url('panel/logout'); ?>">خروج</a></li>
                                        <?php }else{ ?>
                                        <li><a href="<?php echo base_url('login'); ?>">ورود</a></li>
                                        <li><a href="<?php echo base_url('register'); ?>">ثبت‌ نام</a></li>
                                        <?php } ?>
                                   </ul>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="sticky-header navbar-expand-lg">
                    <div class="menu-bar clearfix">
                         <div class="container clearfix">
                              <div class="menu-logo">
                                   <a href="index.html"><img src="<?php echo base_url(); ?>/theme/site/images/logo.png"
                                             alt=""></a>
                              </div>
                              <button class="navbar-toggler collapsed menuicon justify-content-end" type="button"
                                   data-toggle="collapse" data-target="#menuDropdown" aria-controls="menuDropdown"
                                   aria-expanded="false" aria-label="Toggle navigation">
                                   <span></span>
                                   <span></span>
                                   <span></span>
                              </button>
                              <div class="secondary-menu">
                                   <div class="secondary-inner">
                                        <ul>
                                             <li><a href="https://instagram.com/fidibobooks" target="_blank"
                                                       class="btn-link"><i class="fa fa-instagram"></i></a></li>
                                             <li><a href="https://twitter.com/Fidibobooks" target="_blank"
                                                       class="btn-link"><i class="fa fa-twitter"></i></a></li>
                                        </ul>
                                   </div>
                              </div>
                              <!-- Navigation Menu ==== -->
                              <div class="menu-links navbar-collapse collapse justify-content-start" id="menuDropdown">
                                   <div class="menu-logo">
                                        <a href="index.html"><img src="assets/images/logo.png" alt=""></a>
                                   </div>
                                   <ul class="nav navbar-nav">
                                        <li><a href="<?php echo base_url(); ?>">صفحه اصلی</a>
                                        </li>
                                        <li><a href="<?php echo base_url('rules'); ?>">قوانین</a>
                                        </li>
                                   </ul>
                                   <div class="nav-social-link">
                                        <a href="https://instagram.com/fidibobooks" target="_blank"><i
                                                  class="fa fa-instagram"></i></a>
                                        <a href="https://twitter.com/Fidibobooks" target="_blank"><i
                                                  class="fa fa-twitter"></i></a>
                                   </div>
                              </div>
                              <!-- Navigation Menu END ==== -->
                         </div>
                    </div>
               </div>
          </header>

          <div class="page-content bg-white">
               <?php $this->renderSection('content') ?>
          </div>

          <footer>
               <div class="footer-top">
                    <div class="container">
                         <div class="d-flex align-items-stretch">
                              <div class="pt-logo mr-auto">
                                   <a href="<?php echo base_url(); ?>"><img
                                             src="<?php echo base_url(); ?>/theme/site/images/logo-white.png"
                                             alt="" /></a>
                              </div>
                              <div class="pt-social-link">
                                   <ul class="list-inline m-a0">
                                        <li><a href="https://instagram.com/fidibobooks" target="_blank"
                                                  class="btn-link"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="https://twitter.com/Fidibobooks" target="_blank"
                                                  class="btn-twitter"><i class="fa fa-twitter"></i></a></li>
                                   </ul>
                              </div>
                              <div class="pt-btn-join">
                                   <a href="<?php echo base_url('register'); ?>" class="btn ">ثبت نام کنید</a>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="footer-bottom">
                    <div class="container">
                         <div class="row">
                              <div class="col-lg-12 col-md-12 col-sm-12 text-center"> © 2021 تمامی حقوق محفوظ است</div>
                         </div>
                    </div>
               </div>
          </footer>

          <button class="back-to-top fa fa-chevron-up"></button>
     </div>

     <script src="<?php echo base_url(); ?>/theme/site/js/jquery.min.js"></script>
     <script src="<?php echo base_url(); ?>/theme/site/vendors/bootstrap/js/popper.min.js"></script>
     <script src="<?php echo base_url(); ?>/theme/site/vendors/bootstrap/js/bootstrap.min.js"></script>
     <script src="<?php echo base_url(); ?>/theme/site/vendors/bootstrap-select/bootstrap-select.min.js"></script>
     <script src="<?php echo base_url(); ?>/theme/site/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js">
     </script>
     <script src="<?php echo base_url(); ?>/theme/site/vendors/counter/waypoints-min.js"></script>
     <script src="<?php echo base_url(); ?>/theme/site/vendors/counter/counterup.min.js"></script>
     <script src="<?php echo base_url(); ?>/theme/site/vendors/imagesloaded/imagesloaded.js"></script>
     <script src="<?php echo base_url(); ?>/theme/site/vendors/owl-carousel/owl.carousel.js"></script>
     <script src="<?php echo base_url(); ?>/theme/site/js/functions.js"></script>
     <script src="<?php echo base_url(); ?>/theme/vendors/toastr/toastr.min.js"></script>
     <script src="<?php echo base_url(); ?>/theme/vendors/main.js"></script>

     <?php if($session->has('pm')){ ?>
     <script>
          pm('<?php echo $session->get('pm')[0]; ?>', '<?php echo $session->get('pm')[1]; ?>');
     </script>
     <?php $session -> remove('pm'); }  ?>

</body>


</html>