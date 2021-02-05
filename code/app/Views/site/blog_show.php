<?php $this->extend('layouts/site') ?>



<?php $this->section('title') ?>
بلاگ - <?php echo $blog['title']; ?>
<?php $this->endSection() ?>



<?php $this->section('content') ?>


<div class="page-content bg-white">
     <div class="content-block">
          <div class="section-area section-sp1">
               <div class="container">
                    <div class="row">
                         <div class="col-12">
                              <div class="recent-news blog-lg">
                                   <div class="action-box blog-lg">
                                        <img src="<?php echo base_url('/upload/blog/'.$blog['thumbnail']); ?>" alt="">
                                   </div>
                                   <div class="info-bx">
                                        <h5 class="post-title"><?php echo $blog['title']; ?></h5>
                                        <div class="ttr-divider bg-gray"><i class="icon-dot c-square"></i></div>

                                        <?php echo $blog['description']; ?>

                                        <div class="ttr-divider bg-gray"><i class="icon-dot c-square"></i></div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<?php $this->endSection() ?>
