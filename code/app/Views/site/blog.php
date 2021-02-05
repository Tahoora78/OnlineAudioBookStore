<?php $this->extend('layouts/site') ?>



<?php $this->section('title') ?>
بلاگ
<?php $this->endSection() ?>



<?php $this->section('content') ?>


<div class="page-content bg-white">

     <div class="page-banner ovbl-dark">
          <div class="container">
               <div class="page-banner-entry">
                    <h1 class="text-white">بلاگ</h1>
               </div>
          </div>
     </div>

     <div class="content-block">
          <div class="section-area section-sp1">
               <div class="container">
                    <div class="ttr-blog-grid-3 row" id="masonry">
                         <?php foreach($blog as $rows){ ?>                         
                         <div class="post action-card col-lg-4 col-md-6 col-sm-12 col-xs-12 m-b40">
                              <div class="recent-news">
                                   <div class="action-box">
                                        <img src="<?php echo base_url('/upload/blog/'.$rows['thumbnail']); ?>" alt="">
                                   </div>
                                   <div class="info-bx">
                                        <h5 class="post-title"><a href="<?php echo base_url('blog/show/'.$rows['id']) ?>"><?php echo $rows['title']; ?></a></h5>
                                        <div class="post-extra">
                                             <a href="<?php echo base_url('blog/show/'.$rows['id']) ?>" class="btn-link">بیشتر بخوانید</a>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <?php } ?>
                    </div>
               </div>
          </div>
     </div>
</div>


<?php $this->endSection() ?>
