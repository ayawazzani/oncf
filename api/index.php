<?php

// 1. إعداد مسارات التخزين المؤقت لتناسب بيئة Vercel
$storagePath = '/tmp/storage/framework';
$folders = ['/views', '/sessions', '/cache'];

foreach ($folders as $folder) {
    if (!is_dir($storagePath . $folder)) {
        mkdir($storagePath . $folder, 0755, true);
    }
}

// 2. إخبار Laravel باستخدام المسارات الجديدة
putenv("VIEW_COMPILED_PATH=$storagePath/views");
putenv("SESSION_DRIVER=file");
putenv("SESSION_PATH=$storagePath/sessions");

// استكمال تشغيل Laravel كما هو موجود لديك سابقاً
require __DIR__ . '/../public/index.php';