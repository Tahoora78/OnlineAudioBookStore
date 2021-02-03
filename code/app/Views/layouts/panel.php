<?php

$session = session();


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="description" content="EduChamp : Education HTML Template" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>/theme/panel/images/favicon.png" />
	<title>پنل کاربری - <?php $this->renderSection('title') ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/theme/panel/css/assets.css">
	<link rel="stylesheet" type="text/css"
		href="<?php echo base_url(); ?>/theme/panel/vendors/calendar/fullcalendar.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/theme/panel/css/typography.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/theme/panel/css/shortcodes/shortcodes.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/theme/panel/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/theme/panel/css/dashboard.css">
	<link class="skin" rel="stylesheet" type="text/css"
		href="ass<?php echo base_url(); ?>/theme/panelets/css/color/color-1.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/theme/vendors/toastr/toastr.min.css">

</head>

<body class="ttr-opened-sidebar ttr-pinned-sidebar">

	<header class="ttr-header">
		<div class="ttr-header-wrapper">

			<div class="ttr-toggle-sidebar ttr-material-button">
				<i class="ti-close ttr-open-icon"></i>
				<i class="ti-menu ttr-close-icon"></i>
			</div>

			<div class="ttr-logo-box">
				<div>
					<a href="index.html" class="ttr-logo">
						<img alt="" class="ttr-logo-mobile"
							src="<?php echo base_url(); ?>/theme/panel/images/logo-mobile.png" width="30"
							height="30">
						<img alt="" class="ttr-logo-desktop"
							src="<?php echo base_url(); ?>/theme/panel/images/logo-white.png" width="160"
							height="27">
					</a>
				</div>
			</div>

			<div class="ttr-header-right ttr-with-seperator">
				<ul class="ttr-header-navigation">
					<li>
						<a href="<?php echo base_url(); ?>" class="ttr-material-button ttr-submenu-toggle"><span
								class="ttr-user-avatar"><img alt=""
									src="<?php echo base_url(); ?>/theme/panel/images/testimonials/pic3.jpg"
									width="32" height="32"></span></a>
						<div class="ttr-header-submenu">
							<ul>
								<li><a href="<?php echo base_url(); ?>">صفحه اصلی</a></li>
								<li><a href="<?php echo base_url('panel/logout'); ?>"> خروج </a></li>
							</ul>
						</div>
					</li>
				</ul>
			</div>

		</div>
	</header>


	<div class="ttr-sidebar">

		<div class="ttr-sidebar-wrapper content-scroll">

			<div class="ttr-sidebar-logo">
				<a href="<?php echo base_url('panel'); ?>"><?php echo $session->get('login_user_name') ?></a>
			</div>

			<nav class="ttr-sidebar-navi">
				<ul>
					<li>
						<a href="index.html" class="icon-book-open">
							<span class="ttr-icon"><i class="ti-book"></i></span>
							<span class="ttr-label">خرید های من</span>
						</a>
					</li>
					<li>
						<a href="#" class="ttr-material-button">
							<span class="ttr-icon"><i class="ti-marker-alt"></i></span>
							<span class="ttr-label">نویسنده</span>
							<span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
						</a>
						<ul>
							<li>
								<a href="<?php echo base_url('panel/author') ?>" class="ttr-material-button"><span
										class="ttr-label">کتاب های من</span></a>
							</li>
							<li>
								<a href="<?php echo base_url('panel/author/create') ?>" class="ttr-material-button"><span
										class="ttr-label">ایجاد کتاب</span></a>
							</li>
							<li>
								<a href="<?php echo base_url('panel/author/income') ?>" class="ttr-material-button"><span
										class="ttr-label">درآمد من</span></a>
							</li>
						</ul>
					</li>
					<li>
						<a href="<?php echo base_url('panel/logout'); ?>" class="ttr-material-button">
							<span class="ttr-icon"><i class="ti-power-off"></i></span>
							<span class="ttr-label">خروج</span>
						</a>
					</li>
				</ul>
				<!-- sidebar menu end -->
			</nav>
			<!-- sidebar menu end -->
		</div>
	</div>


	<main class="ttr-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 m-b30">
					<?php $this->renderSection('content') ?>
				</div>
			</div>
		</div>
	</main>
	<div class="ttr-overlay"></div>

	<script src="<?php echo base_url(); ?>/theme/panel/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>/theme/panel/vendors/bootstrap/js/popper.min.js"></script>
	<script src="<?php echo base_url(); ?>/theme/panel/vendors/bootstrap/js/bootstrap.min.js"></script>
	<script src='<?php echo base_url(); ?>/theme/panel/vendors/scroll/scrollbar.min.js'></script>
	<script src="<?php echo base_url(); ?>/theme/panel/vendors/chart/chart.min.js"></script>
	<script src="<?php echo base_url(); ?>/theme/panel/js/admin.js"></script>
	<script src="<?php echo base_url(); ?>/theme/vendors/toastr/toastr.min.js"></script>
     <script src="<?php echo base_url(); ?>/theme/vendors/main.js"></script>

     <?php if($session->has('pm')){ ?>
     <script>
          pm('<?php echo $session->get('pm')[0]; ?>', '<?php echo $session->get('pm')[1]; ?>');
     </script>
     <?php $session -> remove('pm'); }  ?>

	<?php $this->renderSection('js') ?>
	
</body>

</html>