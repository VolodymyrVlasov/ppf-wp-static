<?php
if (function_exists('ppf_add_head_tag')) {
    ppf_add_head_tag('<link rel="shortcut icon" href="{{domain}}/static/icons/favicon.png" type="image/x-icon">');
}

add_filter(
    'document_title_parts',
    static function ($parts) {
        if (is_404()) {
            $parts['title'] = 'Сторінки не існує | PaperFox';
        }

        return $parts;
    },
    50
);

get_header();
?>

<main id="primary" class="site-main">
    @@include('../partials/404.html')
</main>

<?php
get_footer();
