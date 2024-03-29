<?php

use App\Models\Bank;
use App\Models\BlacklistCategory;

$site['cdn'] = ['bs-file', 'searchinput'];
?>

<?= views('template/back/header') ?>

<body>
    <div id="wrapper">
        <?= member_views('layouts.sidebar') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?= member_views('layouts.topbar') ?>
                <div class="container-fluid">
                    <div class="d-flex justify-content-center">
                        <div class="card card-40 mb-4 shadow">
                            <div class="card-body">
                                <div class="modal-header justify-content-center">
                                    <h5 class="modal-title">รายงานผู้ขาย</h5>
                                </div>
                                <form method="POST" action="<?= url() ?>" enctype="multipart/form-data" onsubmit="return checkBlacklistForm()">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>ชื่อกิจการ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" id="search-input" required maxlength="50">
                                            <div class="autocomplete-list" id="autocomplete-list"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>สาเหตุการขึ้นบัญชีดำ <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="reason" rows="3" required maxlength="255"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>ลิงก์เว็บไซต์ <span class="text-danger">*</span></label>
                                            <input type="url" class="form-control" name="website" required maxlength="60">
                                        </div>
                                        <div class="form-group">
                                            <label>ประเภท <span class="text-danger">*</span></label>
                                            <select class="form-control" name="blacklist_category_id" required>
                                                <?php
                                                $blacklist_category = BlacklistCategory::find()->get();
                                                for ($i = 0; $i < count($blacklist_category); $i++) {
                                                    echo '<option value="' . $blacklist_category[$i]['id'] . '">' . $blacklist_category[$i]['name'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>ชื่อจริงผู้ขาย <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="id_firstname" required maxlength="50">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>นามสกุลผู้ขาย <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="id_lastname" required maxlength="50">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>เลขบัตรประชาชน</label>
                                            <input type="text" class="form-control" name="id_number" id="id_number" pattern="\d+" minlength="13" maxlength="13">
                                        </div>
                                        <div class="form-group">
                                            <label>รูปบัตรประชาชน</label>
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="id_image">เลือกไฟล์</label>
                                                <input type="file" class="custom-file-input" id="id_image" name="id_image" accept="image/png, image/jpeg">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>ประเภทบัญชีธนาคาร <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="bank_id" required>
                                                        <?php
                                                        $bank = Bank::find()->get();
                                                        for ($i = 0; $i < count($bank); $i++) {
                                                            echo '<option value="' . $bank[$i]['id'] . '">' . $bank[$i]['name'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>เลขที่บัญชี <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="bank_number" required pattern="\d+" minlength="10" maxlength="12">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>สินค้า <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="item_name" required maxlength="50">
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>ยอดเงิน <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="item_balance" required pattern="\d+" maxlength="5">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>เวลาโอน <span class="text-danger">*</span></label>
                                                    <input type="datetime-local" class="form-control" name="item_date" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>หลักฐานการฉ้อโกง <span class="text-danger">*</span></label>
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="blacklist_image">เลือกไฟล์</label>
                                                <input type="file" class="custom-file-input" id="blacklist_image" name="blacklist_image[]" multiple accept="image/png, image/jpeg" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-between">
                                            <a href="<?= url_back() ?>" class="btn btn-secondary">ย้อนกลับ</a>
                                            <button type="submit" class="btn btn-success">บันทึก</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?= views('template/back/footer') ?>
            </div>
        </div>
    </div>
    <?= views('template/back/cdn_footer') ?>
    <script>
        $(document).ready(function() {
            $('#search-input').on('input', function() {
                const query = $(this).val();
                if (query.length >= 5) {
                    $.ajax({
                        url: '<?= url('api/v1/blacklist/search') ?>',
                        method: 'POST',
                        data: JSON.stringify({
                            query: query
                        }),
                        success: function(response) {
                            const result = response.data;

                            const autocompleteList = $('#autocomplete-list');
                            autocompleteList.empty();
                            if (result.length == 0) {
                                autocompleteList.empty();
                                autocompleteList.css('border', 'none');
                            } else {
                                result.forEach(function(data) {
                                    const item = $('<div class="autocomplete-item">' + data + '</div>');
                                    autocompleteList.css('border', '1px solid #ccc');
                                    item.on('click', function() {
                                        $('#search-input').val(data);
                                        autocompleteList.empty();
                                        autocompleteList.css('border', 'none');
                                    });
                                    autocompleteList.append(item);
                                });
                            }
                        },
                        error: function() {
                            console.log('Failed to fetch data from the API.');
                        }
                    });
                } else {
                    $('#autocomplete-list').empty();
                    const autocompleteList = $('#autocomplete-list');
                    autocompleteList.css('border', 'none');
                }
            });

            function checkBlacklistForm() {
                const id = $('#id_number').val();
                if (id) {
                    if (isNaN(id)) return false;
                    if (id.substring(0, 1) == 0) return false;
                    if (id.length != 13) return false;
                    for (i = 0, sum = 0; i < 12; i++)
                        sum += parseFloat(id.charAt(i)) * (13 - i);
                    if ((11 - sum % 11) % 10 != parseFloat(id.charAt(12))) return false;
                    return true;
                } else {
                    return true
                }
            }
        });
    </script>
</body>