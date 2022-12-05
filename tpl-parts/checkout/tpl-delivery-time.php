<?php $hoursRange = hoursRange();
$current = new DateTime('now + 30 minutes');
$disabledTime = array();
if (isset($restaurant)):?>
    <?php if (have_rows('disabled_time_items', $restaurant->ID)):
        while (have_rows('disabled_time_items', $restaurant->ID)):the_row();
            $disabledTime[] = get_sub_field('time');
        endwhile;
    endif; ?>
<?php endif; ?>
<ul class="time-picker">
    <?php foreach ($hoursRange as $key => $time):
        $formatedTime = $time['formated']; ?>
        <li>
            <input type="radio" name="delivery_time" id="time_<?php echo $key ?>" value="<?php echo $formatedTime ?>"
                   <?php if ($time['object'] < $current || (!empty($disabledTime) && in_array($formatedTime, $disabledTime))): ?>disabled<?php endif;
            ?>>
            <label for="time_<?php echo $key ?>"><?php echo $formatedTime ?></label>
        </li>
    <?php endforeach; ?>
    <li class="is-wide"><input type="radio" name="delivery_time" id="time_soon"
                               value="<?php _e('As soon as possible', 'tatsu_theme') ?>" checked><label
                for="time_soon"><?php _e('As soon as possible', 'tatsu_theme') ?></label></li>
</ul>