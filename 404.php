<?php get_header(); ?>

    <div class="figure">
        <div class="mj">
            <div class="head">
                <div class="nose"></div>
                <div class="hair">
                    <div class="ponytail"></div>
                    <div class="frontpony"></div>
                </div>
            </div>
            <div class="body">
                <div class="jacket">
                    <div class="hand"></div>
                </div>
            </div>
            <div class="leg">
                <div class="foot"></div>
            </div>
            <div class="leg lft">
                <div class="foot"></div>
            </div>
        </div>
        <div class="error-no"><span>4</span>
            <div class="moon"></div>
            <span>4</span>
        </div>

        <div class="error-info">
            <p><?php _e( 'К сожалению, что-то случилось, страница отсутствует!', 'wescle' ); ?></p>
            <a class="btn btn-main" href="<?php echo home_url(); ?>"><?php _e( 'Вернуться на главную', 'wescle' ); ?></a>
        </div>
    </div>

<?php get_footer(); ?>