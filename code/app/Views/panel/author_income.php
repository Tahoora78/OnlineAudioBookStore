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
                    <canvas id="chart" width="100" height="45"></canvas>
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
                              <span class="counter">200000</span>
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
                                   120
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
                              772
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
                              350
                         </span>
                    </div>
               </div>
          </div>
     </div>
</div>

<?php $this->endSection() ?>