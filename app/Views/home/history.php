<?= $this->extend('layout/main_template'); ?>
<?= $this->section('main'); ?>
<!-- Section 1 -->
<div class="bg-info  text-dark">
    <div class="container col-xxl-8 px-4 py-5  ">
        <div class="row text-center">
            <div class="col-md-6 mx-auto">
                <h1 class="fw-bold mb-3 display-3"><?= $historyInfo->title_a; ?></h1>
                <p class=" fs-5"><?= $historyInfo->subtitle_a; ?></p>
            </div>

        </div>
    </div>
</div>
<!-- Section 2 -->
<div class="bg-white text-dark">
    <div class="container col-xxl-8 px-4 py-md-5 py-2  ">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="mx-auto col-10 col-sm-8 col-lg-6">
                <img src="<?= $historyInfo->image_a; ?>" class="rounded d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="400" loading="lazy">
            </div>
            <div class="col-lg-6 text-md-start text-center">
                <h2 class="fw-bold lh-1 mb-3"><?= $historyInfo->title_b; ?></h2>
                <p class="lead"><?= $historyInfo->subtitle_b; ?></p>
            </div>
        </div>
    </div>
</div>
<!-- Section 3 -->
<div class="bg-secondary text-white">
    <div class="container col-xxl-8 px-4 py-md-5 py-2  ">
        <div class="row flex-lg-row align-items-center g-5 py-5">
            <div class="mx-auto col-10 col-sm-8 col-lg-6">
                <img src="<?= $historyInfo->image_b; ?>" class="rounded d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="400" loading="lazy">
            </div>
            <div class="col-lg-6 text-md-start text-center">
                <h2 class=" fw-bold lh-1 mb-3"><?= $historyInfo->title_c; ?></h2>
                <p class="lead"><?= $historyInfo->subtitle_c; ?></p>
            </div>
        </div>
    </div>
</div>
<!-- Section 4 -->
<div class="bg-white text-dark">
    <div class="container col-xxl-8 px-4 py-5  ">
        <div class="row text-center">
            <h3 class="fs-1 fw-bold display-5"><?= $historyInfo->title_d; ?></h3>
            <p class="col-md-6 mx-auto"><?= $historyInfo->subtitle_d; ?></p>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>