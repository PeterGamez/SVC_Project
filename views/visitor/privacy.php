<?php
$site['social'] = true; // กำหนดให้เว็บไซต์ใช้งาน Open Graph ได้
$site['cdn'] = array('tawk'); // กำหนดให้เว็บไซต์ใช้งาน CDN ที่กำหนดได้
$site['name'] = 'ความเป็นส่วนตัว - ' . config('site.name');
$site['desc'] = config('site.description');
$site['bot'] = '';
?>

<?= views('template/front/header') ?>

<body>
    <?= visitor_views('layouts/navbar') ?>
    <div class="body container">
        <h1>ความเป็นส่วนตัว</h1>
        <p></p>เราจะเก็บรวบรวมข้อมูลส่วนบุคคลซึ่งเป็นข้อมูลที่ทำให้สามารถระบุตัวตนของท่านได้ ไม่ว่าทางตรงหรือทางอ้อม ได้แก่ ข้อมูลที่ท่านให้ไว้โดยตรงจากการลงทะเบียนผ่านระบบLogin การลงทะเบียนเข้าร่วมเว็บไซต์ต่างๆ ของบริษัท คุกกี้ ข้อมูลการทำรายการ และประสบการณ์การใช้งานผ่านหน้าเว็บไซต์ ผู้ที่ได้รับมอบหมาย หรือช่องทางอื่นใด เช่น
        <ul>
            <li>
                <p>ข้อมูลส่วนตัว เช่น ชื่อ นามสกุล อายุ วันเดือนปีเกิด เลขประจำตัวประชาชน เลขหนังสือเดินทาง</p>
            </li>
            <li>
                <p>ข้อมูลการติดต่อ เช่น ที่อยู่อาศัย หมายเลขโทรศัพท์ อีเมล</p>
            </li>
        </ul>
        
        <h2>วัตถุประสงค์ในการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูล</h2>
        <p>เราจะเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณเพื่อวัตถุประสงค์ดังต่อไปนี้</p>
        <ul>
            <li>
                <p>เพื่อสร้างและจัดการบัญชีผู้ใช้งาน</p>
            </li>
            <li>
                <p>เพื่อปฏิบัติตามกฎหมายและกฎระเบียบของหน่วยงานราชการ</p>
            </li>
            <li>
                <p>เพื่อเป็นการป้องกัน หรือลดความเสี่ยงที่อาจเกิดจากการกระทำการทุจริต ภัยคุกคามทางไซเบอร์ การกะทำผิดกฎหมายต่างๆ</p>
            </li>
            <li>
                <p>เพื่อการทำโครงงานเพื่อการศึกษา</p>
            </li>
            <li>
                <p> เพื่อรวบรวมข้อเสนอแนะ</p>
            </li>
        </ul>
        <p>เราจะนำข้อมูลของท่านมาใช้เพื่อการพัฒนาและปรับปรุงเว็บไซต์/แพลตฟอร์มออนไลน์ และช่องทางโซเชียลมีเดียอื่นๆ ในเครือ ตลอดจนการวิเคราะห์และประมวลผลข้อมูลส่วนบุคคล เพื่อให้ตอบโจทย์การใช้งานของผู้ใช้งาน ด้วยวิธีการทางอิเล็กทรอนิกส์แก่ท่านให้มีประสิทธิภาพมากยิ่งขึ้น</p>

        <h2>ข้อมูลของท่านอาจถูกนำไปเปิดเผยให้กับใครบ้าง</h2>
        <p>ทางเราอาจมีการเปิดเผยข้อมูลส่วนบุคคลของคุณให้แก่ผู้อื่นภายใต้การยินยอมของคุณ หรือภายใต้หลักเกณฑ์ตามที่กฎหมายอนุญาตให้เปิดเผยได้ ซึ่งได้แก่</p>
        <ul>
            <li>
                <p>ทีมงานของผู้ให้บริการเว็บไซต์</p>
            </li>
            <li>
                <p>เจ้าหน้าที่พนักงานตามกฎหมาย</p>
            </li>
        </ul>

        <h2>ระยะเวลาจัดเก็บข้อมูลส่วนบุคคล</h2>
        <p>เราจะเก็บรักษาข้อมูลส่วนบุคคลของคุณไว้ตามระยะเวลาที่จำเป็นในระหว่างที่คุณมีความสัมพันธ์อยู่กับเราหรือตลอดระยะเวลาที่จำเป็นเพื่อให้บรรลุวัตถุประสงค์ที่เกี่ยวข้องกับนโยบายฉบับนี้ ซึ่งอาจจำเป็นต้องเก็บรักษาไว้ต่อไปภายหลังจากนั้น หากมีกฎหมายกำหนดไว้ เราจะลบ ทำลาย หรือทำให้เป็นข้อมูลที่ไม่สามารถระบุตัวตนของคุณได้ เมื่อหมดความจำเป็นหรือสิ้นสุดระยะเวลาดังกล่าว</p>

    </div>
    <?= views('template/front/footer') ?>
    <?= views('template/front/cdn_footer') ?>
</body>