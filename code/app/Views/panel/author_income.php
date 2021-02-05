<?php $this->extend('layouts/panel') ?>

<?php $this->section('title') ?>
درآمد من - نویسنده
<?php $this->endSection() ?>



<?php $this->section('content') ?>

<div class="row">
     <!-- Your Profile Views Chart -->
     <div class="col-lg-8 m-b30">
          <div class="widget-box">
               <div class="wc-title">
                    <h4>درآمد من - نویسنده</h4>
               </div>
               <div class="widget-inner">
                    <canvas id="income" width="100" height="45"></canvas>
               </div>
          </div>
     </div>
     <!-- Your Profile Views Chart END-->
     <div class="col-lg-4 m-b30">
          <div class="col-12">
               <div class="widget-card widget-bg1">
                    <div class="wc-item">
                         <h4 class="wc-title">
                              درآمد کل
                         </h4>
                         <span class="wc-des">
                              تومان
                         </span>
                         <span class="wc-stats">
                              <span class="counter"><?php echo number_format($price_all); ?></span>
                         </span>
                    </div>
               </div>
          </div>
          <div class="col-12">
               <div class="widget-card widget-bg2">
                    <div class="wc-item">
                         <h4 class="wc-title">
                             
                              تعداد فروش
                         </h4>
                         <span class="wc-des">
                              عدد
                         </span>
                         <span class="wc-stats ">
                              <span class="counter">
                              <?php echo $orders_all ? number_format($orders_all) : 0; ?>
                              </span>
                         </span>
                    </div>
               </div>
          </div>
          <div class="col-12">
               <div class="widget-card widget-bg3">
                    <div class="wc-item">
                         <h4 class="wc-title">
                         بازدید کل
                         </h4>
                         <span class="wc-des">
                              بازدید
                         </span>
                         <span class="wc-stats counter">
                         <?php echo $views_all ? number_format($views_all) : 0; ?>
                         </span>
                    </div>
               </div>
          </div>
          <div class="col-12">
               <div class="widget-card widget-bg4">
                    <div class="wc-item">
                         <h4 class="wc-title">
                              زمان کل کتاب صوتی
                         </h4>
                         <span class="wc-des">
                             دقیقه
                         </span>
                         <span class="wc-stats counter">
                         <?php echo $time_all ? number_format($time_all) : 0; ?>
                         </span>
                    </div>
               </div>
          </div>
     </div>
</div>

<?php $this->endSection() ?>



<?php $this->section('js') ?>
<script>

var ctx = document.getElementById('income').getContext('2d');
var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo implode(",", $chrt_x); ?>],
        datasets: [{
               label: 'درآمد',
               backgroundColor: 'rgba(0,0,0,0.05)',
               borderColor: '#4c1864',
               borderWidth: "3",
               data: [196,132,215,362,210,252],
               pointRadius: 4,
               pointHoverRadius:4,
               pointHitRadius: 10,
               pointBackgroundColor: "#fff",
               pointHoverBackgroundColor: "#fff",
               pointBorderWidth: "3",
               data: [<?php echo implode(",", $chrt_y); ?>]
        }]
    },

    // Configuration options go here
    options: {}
});
</script>

<?php $this->endSection() ?>
