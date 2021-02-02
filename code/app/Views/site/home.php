<?php $this->extend('layouts/site') ?>

<?php $this->section('title') ?>
فروشگاه آنلاین کتاب صوتی
<?php $this->endSection() ?>

<?php $this->section('content') ?>


<div class="section-area section-sp1 ovpr-dark bg-fix online-cours"
     style="background-image:url(<?php echo base_url(); ?>/theme/site/images/background/bg1.jpg);">
     <div class="container">
          <div class="row">
               <div class="col-md-12 text-center text-white">
                    <h2 class="py-5">فروشگاه آنلاین کتاب صوتی</h2>
                    <form class="cours-search">
                         <div class="input-group">
                              <input type="text" class="form-control" placeholder="لطفا نام کتاب خود را بنویسید ...">
                              <div class="input-group-append">
                                   <button class="btn" type="submit">جستجو</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div>
          <div class="mw800 m-auto">
               <div class="row">
                    <div class="col-md-4 col-sm-6">
                         <div class="cours-search-bx m-b30">
                              <div class="icon-box">
                                   <h3><i class="ti-book"></i><span class="counter">5</span></h3>
                              </div>
                              <span class="cours-search-text">کتاب</span>
                         </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                         <div class="cours-search-bx m-b30">
                              <div class="icon-box">
                                   <h3><i class="ti-headphone"></i><span class="counter">30</span></h3>
                              </div>
                              <span class="cours-search-text">دقیقه فایل صوتی</span>
                         </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                         <div class="cours-search-bx m-b30">
                              <div class="icon-box">
                                   <h3><i class="ti-user"></i><span class="counter">20</span></h3>
                              </div>
                              <span class="cours-search-text">نظرات خریداران</span>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<div class="content-block">
     <div class="section-area section-sp2 popular-courses-bx">
          <div class="container">
               <div class="row">

               </div>
          </div>
     </div>
</div>

<?php $this->endSection() ?>