<?php
// завжди підключаємо setup.php першим
require_once get_template_directory() . '/inc/setup.php';

// решта файлів
foreach (glob(get_template_directory() . '/inc/*.php') as $file) {
  if (basename($file) === 'setup.php')
    continue;
  require_once $file;
}



