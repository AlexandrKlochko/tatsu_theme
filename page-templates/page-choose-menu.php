<?php
/**
 * Template Name: Page Choose Menu
 */
?>
<?php get_header(); ?>
    <main class="main  page-choose " style="<?php get_background_vars(); ?>">
        <div class="wrap">
            <?php if(have_rows('menus')):?>
            <h1 class="section-title tac"><?php _e('Which menu do you want to see?','tatsu_theme')?></h1>

            <div class="choose-plates">
                <?php while(have_rows('menus')): the_row();?>
                    <div class="choose-item">
                        <h3 class="section-subtitle"><?php the_sub_field('title')?></h3>
                        <div class="choose-item__excerpt">
                            <?php the_sub_field('excerpt')?>
                        </div>
                        <?php if($caption = get_sub_field('caption')):?>
                            <div class="choose-item__caption"><a href="<?php echo $caption['url']?>" target="<?php echo $caption['target']?>"><?php echo $caption['title']?></a></div>
                        <?php endif;?>
                        <?php if($link = get_sub_field('link')):?>
                            <a href="<?php echo $link['url']?>" class="choose-item__link" target="<?php echo $link['target']?>">
                                <?php echo $link['title']?>
                                <img src="<?php echo THEME_DIR_URI?>/dist/img/icons/long-arrow-dark.svg" alt="" class="js__img-to-svg">
                            </a>
                        <?php endif;?>
                    </div>
                <?php endwhile;?>
            </div>
            <?php endif;?>
        </div>
    </main>
<?php get_footer('front'); ?>