<?php
// إنشاء مجلدات التخزين في الذاكرة المؤقتة لـ Vercel
$storagePath = '/tmp/storage/framework';
$folders = ['/views', '/sessions', '/cache'];

foreach ($folders as $folder) {
    if (!is_dir($storagePath . $folder)) {
        mkdir($storagePath . $folder, 0755, true);
    }
}

// إجبار Laravel على استخدام هذه المسارات
putenv("VIEW_COMPILED_PATH=$storagePath/views");
putenv("SESSION_DRIVER=cookie"); // تغيير الجلسات إلى كوكيز
putenv("APP_CONFIG_CACHE=/tmp/config.php");
putenv("APP_ROUTES_CACHE=/tmp/routes.php");

require __DIR__ . '/../public/index.php';