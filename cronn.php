<?php

while (true) {
    // شغّل الملف الرئيسي كل فترة (مثلاً كل 60 ثانية)
    file_get_contents("https://hrbymybotsh.duckdns.org/mybots/cron.php");

    // انتظر 60 ثانية قبل تكرار التشغيل
    sleep(5);
}
