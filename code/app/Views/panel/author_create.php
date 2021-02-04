<?php $this->extend('layouts/panel') ?>

<?php $this->section('title') ?>
ایجاد کتاب - نویسنده
<?php $this->endSection() ?>



<?php $this->section('content') ?>

<div class="widget-box">

     <div class="wc-title">
          <h4>ایجاد کتاب - نویسنده</h4>
     </div>

     <div class="row">
          <!-- Your Profile Views Chart -->
          <div class="col-lg-12 m-b30">
               <div class="widget-box">
                    <div class="email-wrapper">

                         <div class="mail-list-container">
                              <form class="mail-compose" action="<?php echo base_url('panel/author/store'); ?>"
                                   method="post" enctype="multipart/form-data">
                                   <div class="row">
                                        <div class="form-group col-6">
                                             <input class="form-control" type="text" name="title" required placeholder="عنوان کتاب">
                                        </div>
                                        <div class="form-group col-6">
                                             <input class="form-control" type="text" name="publishers" required placeholder="انتشارات">
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="form-group col-6">
                                             <input class="form-control" type="text" name="price" required placeholder="قیمت (تومان)">
                                        </div>
                                        <div class="form-group col-6">
                                             <input class="form-control" type="tel" name="time" required placeholder="زمان فایل صوتی کتاب (دقیقه)">
                                        </div>
                                   </div>
                                   <div class="form-group col-12">
                                        <textarea name="description" id="editor1" rows="10" cols="80" required>
                                        </textarea>
                                   </div>
                                   <div class="row">
                                        <div class="form-group col-6">
                                             <h6>آپلود کاور کتاب :</h6>
                                             <input type="file" name="cover" required accept="image/*">
                                        </div>
                                        <div class="form-group col-6">
                                             <h6>آپلود فایل صوتی :</h6>
                                             <input type="file" name="audio" required accept="audio/*">
                                        </div>
                                   </div>
                                   <div class="form-group col-12">
                                        <button type="submit" class="btn btn-lg">ارسال</button>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
          <!-- Your Profile Views Chart END-->
     </div>

</div>

