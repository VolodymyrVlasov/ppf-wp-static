<?php
/**
 * Template part with contacts 
 * <?php wc_get_template('template-parts/ppf-contact-section.php'); ?>
 */

?>
<section class="section bg_gray">
    <div class="container col big_gap">
        <h3 class="text_32">
            <?php if (isset($args['contact_section_title'])) {
                echo $args['contact_section_title'];
            } else {
                echo "Потрібна консультація?";
            } ?>
        </h3>
        <div class="row big_gap width_100">
            <a class="contact_widget_card cards_4" href="tel:{{phone}}">
                <span class="contact_widget_card__phone">Phone</span>
                <p>Зателефонуй нам</p>
                <u>{{phone}}</u>
            </a>
            <a class="contact_widget_card cards_4" rel="noopener noreferrer nofollow" target="_blank"
                href="{{telegram}}">
                <span class="contact_widget_card__telegram">Telegram</span>
                <p>Напишіть у чат</p>
                <u>{{telegram_public_name}}</u>
            </a>
            <a class="contact_widget_card cards_4" href="mailto:{{email}}">
                <span class="contact_widget_card__email">Email</span>
                <p>Напишіть на пошту</p>
                <u>{{email}}</u>
            </a>
            <a class="contact_widget_card cards_4" href="viber://add?number={{viber}}">
                <span class="contact_widget_card__viber">Viber</span>
                <p>Напишіть у чат</p>
                <u>+{{viber}}</u>
            </a>
        </div>
    </div>
</section>