<?php
defined('ABSPATH') || exit;
?>

<section class="ppf-no-content container col big_gap">
    <h1 class="text_32__bold"><?php esc_html_e('Нічого не знайдено', 'paperfox'); ?></h1>
    <p class="text_16"><?php esc_html_e('На жаль, за вашим запитом контент відсутній. Спробуйте змінити критерії або поверніться на головну.', 'paperfox'); ?></p>
    <?php get_search_form(); ?>
</section>
