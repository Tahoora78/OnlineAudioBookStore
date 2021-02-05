<?php $this->extend('layouts/panel') ?>

<?php $this->section('title') ?>
لیست بلاگ ها
<?php $this->endSection() ?>



<?php $this->section('content') ?>

<div class="widget-box">

     <div class="wc-title">
          <h4>لیست بلاگ ها</h4>
     </div>

     <div class="widget-inner">
          <div class="row">
               <?php foreach($blog as $rows){ ?>
               <div class="col-md-4 col-lg-4 col-sm-6 m-b30">
                    <div class="cours-bx">
                         <a href="<?php echo base_url('panel/blog/edit/'.$rows['id']) ?>">
                              <div class="action-box">
                                   <img src="<?php echo base_url('/upload/blog/'.$rows['thumbnail']); ?>" alt="">
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