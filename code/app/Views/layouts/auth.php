<?php
    $session = session();
?>
<!DOCTYPE html>
<html lang="en">


<head>

     <meta charset="utf-8">
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
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/theme/vendors/toastr/toastr.min.css">
</head>

<body id="bg">
     <div class="page-wraper">
          <div id="loading-icon-bx"></div>
          <div class="account-form">
               <div class="account-head"
                    style="background-image:url(<?php echo base_url(); ?>/theme/site/images/background/bg2.jpg);">
                    <a href="index.html"><img src="<?php echo base_url(); ?>/theme/site/images/logo-white.png"
                              alt=""></a>
               </div>
               <div class="account-form-inner">
                    <div class="account-container">
                         <?php $this->renderSection('content') ?>
                    </div>
               </div>
          </div>
     </div>
     <!-- External JavaScripts -->
     <script src="<?php echo base_url(); ?>/theme/site/js/jquery.min.js"></script>
     <script src="<?php echo base_url(); ?>/theme/site/vendors/bootstrap/js/popper.min.js"></script>
     <script src="<?php echo base_url(); ?>/theme/site/vendors/bootstrap/js/bootstrap.min.js"></script>
     <script src="<?php echo base_url(); ?>/theme/site/vendors/bootstrap-select/bootstrap-select.min.js"></script>
     <script src="<?php echo base_url(); ?>/theme/site/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js">
     </script>
     <script src="<?php echo base_url(); ?>/theme/site/vendors/magnific-popup/magnific-popup.js"></script>
     <script src="<?php echo base_url(); ?>/theme/site/vendors/counter/waypoints-min.js"></script>
     <script src="<?php echo base_url(); ?>/theme/site/vendors/counter/counterup.min.js"></script>
     <script src="<?php echo base_url(); ?>/theme/site/vendors/imagesloaded/imagesloaded.js"></script>
     <script src="<?php echo base_url(); ?>/theme/site/vendors/masonry/masonry.js"></script>
     <script src="<?php echo base_url(); ?>/theme/site/vendors/masonry/filter.js"></script>
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