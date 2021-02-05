<?php $this->extend('layouts/panel') ?>

<?php $this->section('title') ?>
ویرایش بلاگ
<?php $this->endSection() ?>



<?php $this->section('content') ?>

<div class="widget-box">

     <div class="wc-title">
          <h4>ویرایش بلاگ</h4>
     </div>

     <div class="row">
          <!-- Your Profile Views Chart -->
          <div class="col-lg-12 m-b30">
               <div class="widget-box">
                    <div class="email-wrapper">

                         <div class="mail-list-container">
                              <form class="mail-compose" action="<?php echo base_url('panel/blog/update/'.$blog['id']); ?>"
                                   method="post" enctype="multipart/form-data">
                                   <div class="form-group col-12">
                                        <input class="form-control" type="text" name="title" value="<?php echo $blog['title']; ?>" required placeholder="عنوان بلاگ">
                                   </div>
                                   <div class="form-group col-12 text-left">
                                        <a href="<?php echo base_url('blog/show/'.$blog['id']); ?>" target="_blank"><?php echo base_url('blog/show/'.$blog['id']); ?></a>
                                   </div>
                                   <div class="form-group col-12">
                                        <h6>آپلود تصویر شاخص :</h6>
                                        <input type="file" name="thumbnail" accept="image/*">
                                   </div>
                                   <div class="form-group col-12">
                                        <textarea name="description" id="editor1" rows="10" cols="80" required><?php echo $blog['description']; ?>
                                        </textarea>
                                   </div>
                                   <div class="form-group col-12">
                                        <button type="submit" class="btn btn-lg">ویرایش</button>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
          <!-- Your Profile Views Chart END-->
     </div>

</div>

<?php $this->endSection() ?>


<?php $this->section('js') ?>
<script src="<?php echo base_url(); ?>/theme/panel/vendors/ckeditor/ckeditor.js"></script>
<script>
     CKEDITOR.replace('editor1', {
          language: 'fa',
     });
</script>
<?php $this->endSection() ?>