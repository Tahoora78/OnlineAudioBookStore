<?php $this->extend('layouts/panel') ?>

<?php $this->section('title') ?>
خرید های من
<?php $this->endSection() ?>

<?php $this->section('content') ?>

<div class="widget-box">
     <div class="wc-title">
          <h4>خرید های من</h4>
     </div>
     <div class="widget-inner">
          <div class="row">

               <?php foreach($book as $rows){ ?>
               <div class="col-md-2 col-lg-2 col-sm-6 m-b30">
                    <div class="cours-bx">
                         <a href="<?php echo base_url('book/show/'.$rows['id']) ?>" target="_blank">
                              <div class="action-box">
                                   <img src="<?php echo base_url('/upload/cover/'.$rows['cover']); ?>" alt="">
                              </div>
                              <div class="info-bx text-center">
                                   <span><?php echo $rows['title']; ?></span>
                              </div>
                         </a>
                    </div>
               </div>
               <?php } ?>

          </div>
     </div>
</div>

<?php $this->endSection() ?>