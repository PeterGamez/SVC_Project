<?php

use App\Models\Whitelist;

$site['social'] = true; // กำหนดให้เว็บไซต์ใช้งาน Open Graph ได้
$site['cdn'] = array('jquery', 'datatables'); // กำหนดให้เว็บไซต์ใช้งาน CDN ที่กำหนดได้
$site['name'] = config('site.name');
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
                <tbody>
                    <?php
                    $result = Whitelist::find()->get();
                    for ($i = 0; $i < count($result); $i++) {
                        echo '<tr>';
                        echo '<th scope="row"><a href="' . url('whitelist.' . $result[$i]['tag']) . '">' . $result[$i]['tag'] . '</a></th>';
                        echo '<td>' . $result[$i]['name'] . '</td>';
                        echo '<td>' . $result[$i]['id_firstname'] . ' ' . $result[$i]['id_lastname'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
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
            scrollX: true,
            scrollY: false,
            order: [
                [0, 'desc']
            ],
            columnDefs: [{
                targets: -1,
                searchable: false,
                orderable: false
            }, ],
            language: {
                url: "<?= resource('datatables/th.json', true) ?>"
            }
        })
    </script>
</body>