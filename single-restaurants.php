<?php get_header(); ?>
    <main class="main">

        <div class="wrap">
            <div class="page-restaurant-grid">
                <div class="restaurant-content">
                    <h1 class="section-title"><?php _e('About Tatsu Restaurant', 'tatsu_theme') ?></h1>
                    <div class="font-rules">
                        <h3><?php the_title() ?></h3>
                        <p><?php the_content() ?></p>
                        <p><br></p>
                        <p><br></p>
                        <p><br></p>
                        <div class="desktop-gallery">
                            <?php if ($gallery = get_field('gallery')): ?>
                                <div class="owl-carousel ">
                                    <?php foreach ($gallery as $image): ?>
                                        <div><img src="<?php echo esc_url($image['url']); ?>"/></div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="owl-carousel-counter">
                                    <span class="owl-carousel-current"><?php _e('1', 'tatsu') ?></span><span><?php _e('/');
                                        echo count($gallery); ?></span>
                                </div>
                            <?php else: ?>
                                <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="restaurant-order">
                    <div id="quandoo-booking-widget">
                    </div>
                    <script defer src="https://booking-widget.quandoo.com/index.js"
                            data-merchant-id="<?php the_field('booking_merchant_id') ?>" data-theme="dark"></script>
                    <div class="mobile-gallery">
                        <?php if ($gallery = get_field('gallery')): ?>
                            <div class="owl-carousel ">
                                <?php foreach ($gallery as $image): ?>
                                    <div><img src="<?php echo esc_url($image['url']); ?>"/></div>
                                <?php endforeach; ?>
                            </div>
                            <div class="owl-carousel-counter">
                                <span class="owl-carousel-current"><?php _e('1', 'tatsu') ?></span><span><?php _e('/');
                                    echo count($gallery); ?></span>
                            </div>
                        <?php else: ?>
                            <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="">
                        <?php endif; ?>
                    </div>
                </div>
                <ul class="restaurant-info">
                    <?php $addressRaw = false; ?>
                    <?php if ($address = get_field('address')): ?>
                        <?php $addressRaw .= $address . ' ' . get_field('house'); ?>
                    <?php endif; ?>
                    <?php if ($postcode = get_field('postcode')): ?>
                        <?php $addressRaw .= ' / ' . $postcode . ' ' . get_field('suffix'); ?>
                    <?php endif; ?>
                    <?php if ($state = get_field('state')): ?>
                        <?php $addressRaw .= ' / ' . $state; ?>
                    <?php endif; ?>
                    <?php if ($city = get_field('city')): ?>
                        <?php $addressRaw .= ' / ' . $city; ?>
                    <?php endif; ?>
                    <?php if ($addressRaw): ?>
                        <li>
                            <h4><?php _e('Address', 'tatsu_theme') ?></h4>
                            <address><?php echo $addressRaw ?></address>
                        </li>
                    <?php endif; ?>

                    <?php if (have_rows('opening')): ?>
                        <li>
                            <h4><?php _e('Opening days', 'tatsu_theme') ?></h4>
                            <ul class="">
                                <?php while (have_rows('opening')):the_row(); ?>
                                    <li><?php the_sub_field('day') ?>:
                                        <span><?php the_sub_field('start') ?> - <?php the_sub_field('end') ?></span>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if (have_rows('contacts')): ?>
                        <li>
                            <h4><?php _e('Contact', 'tatsu_theme') ?></h4>
                            <ul>
                                <?php while (have_rows('contacts')): the_row() ?>
                                    <?php if ($phone = get_sub_field('phone')): ?>
                                        <li>
                                            <a href="tel:<?php echo preg_replace("/\s+/", "", $phone) ?>"><?php echo $phone ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if ($email = get_sub_field('email')): ?>
                                        <li><a href="mailto:<?php echo $email ?>"><?php echo $email ?></a></li>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if (have_rows('prices')): ?>
                        <li>
                            <h4><?php _e('Prices', 'tatsu_theme') ?></h4>
                            <ul>
                                <?php while (have_rows('prices')): the_row() ?>
                                    <li><?php the_sub_field('row') ?></li>
                                <?php endwhile; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

    </main>
<?php get_footer(); ?>