<?php
/**
 * Created by PhpStorm.
 * User: PegionAndLion
 * Date: 15/1/5
 * Time: 下午7:02
 */

$mmc = memcache_init();
if ($mmc == false)
    echo "mc init failed\n";
memcache_delete($mmc,"oMD0Nt4TE65ZYjYaEsltBJrHjKXI");
memcache_delete($mmc,"oMD0Nt9zKQGtfL1V6VtCgNkjr19U");