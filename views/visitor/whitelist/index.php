<?php

$site['social'] = true; // กำหนดให้เว็บไซต์ใช้งาน Open Graph ได้
$site['cdn'] = array('jquery', 'datatables', 'tawk'); // กำหนดให้เว็บไซต์ใช้งาน CDN ที่กำหนดได้
$site['name'] = 'Whitelist - ' . config('site.name');
$site['desc'] = config('site.description');
$site['bot'] = '';
?>

<?= views('template/front/header') ?>

<body>
    <?= visitor_views('layouts/navbar') ?>
    <div class="body container">
        <div data-aos="fade-up">
            <table id="table_whitelist" class="table table-striped table-hover align-middle nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ชื่อกิจการ</th>
                        <th scope="col">เจ้าของกิจการ</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>ชื่อกิจการ</th>
                        <th>เจ้าของกิจการ</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <?= views('template/front/footer') ?>
    <?= views('template/front/cdn_footer') ?>
    <script>
        $('#table_whitelist').DataTable({
            ajax: '<?= url('api.v1.whitelist.list') ?>',
            deferRender: true,
            columnDefs: [{
                    targets: 0,
                    render: (data, type, row) => `<a href="<?= url('whitelist') ?>/${data}">${data}</a>`,
                },
                {
                    targets: 1,
                    render: (data, type, row) => `${data}`,
                },
                {
                    targets: 2,
                    render: (data, type, row) => `${data}`,
                },
            ],
            scrollX: true,
            scrollY: false,
            order: [
                [0, 'desc']
            ],
            language: {
                url: "<?= config('site.cdn.path') ?>/json/datatables-th.json"
            }
        })
    </script>
</body>