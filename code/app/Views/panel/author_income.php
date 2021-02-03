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
    
</div>

<?php $this->endSection() ?>