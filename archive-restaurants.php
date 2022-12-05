<?php get_header()?>

<main class="main">
    <section class="page-section">
        <div class="wrap">
            <h1 class="section-title"><?php _e('Select a restaurant','tatsu_theme')?></h1>
            <div class="restaurants-grid">
                <?php if ( have_posts()):?>
                    <?php while ( have_posts()): the_post();?>
                        <div class="restaurants-grid__card">
                            <h4 class="restaurants-grid__card-title">
                                <a href="<?php the_permalink()?>"><?php the_title()?></a>
                            </h4>
                            <div class="restaurants-grid__card-excerpt">
                                <p><?php the_excerpt()?></p>
                            </div>
                            <?php $addressRaw = false;?>
                            <?php if($address = get_field('address')):?>
                                <?php $addressRaw .= $address.' '.get_field('house');?>
                            <?php endif;?>
                            <?php if($postcode = get_field('postcode')):?>
                                <?php $addressRaw .= ' / '.$postcode.' '.get_field('suffix');?>
                            <?php endif;?>
                            <?php if($state = get_field('state')):?>
                                <?php $addressRaw .= ' / '.$state;?>
                            <?php endif;?>
                            <?php if($city = get_field('city')):?>
                                <?php $addressRaw .= ' / '.$city;?>
                            <?php endif;?>
                            <address class="restaurants-grid__card-address"><?php echo $addressRaw?></address>
                            <?php echo file_get_contents(THEME_DIR_URI.'/dist/img/icons/long-arrow-dark.svg')?>
                        </div>
                    <?php endwhile;?>
                <?php endif;?>
            </div>
        </div>
    </section>

</main>
<?php get_footer()?>
