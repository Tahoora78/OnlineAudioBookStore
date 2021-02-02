<?php $this->extend('layouts/auth') ?>

<?php $this->section('title') ?>
ثبت نام در فروشگاه
<?php $this->endSection() ?>


<?php $this->section('content') ?>

<div class="heading-bx left">
    <h2 class="title-head">ثبت نام در فروشگاه</h2>
</div>

<form class="contact-bx" action="<?php echo base_url('/register/create'); ?>" method="post">
    <div class="row placeani">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="input-group">
                    <label>نام و نام خانوادگی :</label>
                    <input name="name" type="text" required="" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <div class="input-group">
                    <label>نام کاربری :</label>
                    <input name="username" type="text" required="" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <div class="input-group">
                    <label>رمز عبور :</label>
                    <input name="password" type="password" class="form-control" required="">
                </div>
            </div>
        </div>
        <p> من <a href="<?php echo base_url('rules') ?>" target="_blank">قوانین </a> را مطالعه کردم و آن را پذیرفتم.</p>
        <div class="col-lg-12 m-b30">
            <button name="submit" type="submit" value="Submit" class="btn button-md">ثبت نام</button>
        </div>
        <div class="col-lg-12">
            <div class="d-flex">
                <hr>
                <a class="btn flex-fill m-l5 facebook" href="<?php echo base_url(); ?>">صفحه اصلی</a>
                <a class="btn flex-fill m-r5 facebook" href="<?php echo base_url('login'); ?>">ورود</a>
            </div>
        </div>
    </div>
</form>

<?php $this->endSection() ?>