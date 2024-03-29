<?php
$site['social'] = true; // กำหนดให้เว็บไซต์ใช้งาน Open Graph ได้
$site['cdn'] = array('tawk'); // กำหนดให้เว็บไซต์ใช้งาน CDN ที่กำหนดได้
$site['name'] = config('site.name');
$site['desc'] = config('site.description');
$site['bot'] = '';
?>

<?= views('template/front/header') ?>

<body>
    <?= visitor_views('layouts/navbar') ?>
    <div class="body container">
        <div class="d-flex justify-content-center">
            <div class="card border-0" style="width:70rem;" data-aos="fade-up" data-aos-delay="100">
                <div class="card-body">
                    <div id="carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="5000">
                                <img src="<?= config('site.cdn.path') ?>/images/home/1.webp" class="d-block w-100" alt="image1">
                            </div>
                            <div class="carousel-item" data-bs-interval="5000">
                                <img src="<?= config('site.cdn.path') ?>/images/home/2.webp" class="d-block w-100" alt="image2">
                            </div>
                            <div class="carousel-item" data-bs-interval="5000">
                                <img src="<?= config('site.cdn.path') ?>/images/home/3.webp" class="d-block w-100" alt="image3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= views('template/front/footer') ?>
    <?= views('template/front/cdn_footer') ?>
</body>