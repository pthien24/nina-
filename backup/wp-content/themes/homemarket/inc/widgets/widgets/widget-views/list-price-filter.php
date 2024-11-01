<?php
/*
 * Homemarket : 
 */

/*
 * @args - $instance
 */
$price_field_name = $this->get_field_name( 'prices' );
?>
<ul class="prices-list-filter">
<?php foreach ( $instance['prices'] as $key => $price ) { ?>
    <li>
        <input type="checkbox" id="<?php echo $price_field_name ?>[<?php echo $key ?>]" name="<?php echo $price_field_name ?>" data-min="<?php echo $price['min'] ?>" data-max="<?php echo $price['max'] ?>"

        <?php
            if ( !empty( $_GET['min_price'] ) && !empty( $_GET['max_price'] ) ) {
            	$min = $_GET['min_price'];
            	$max = $_GET['max_price'];

                if($min == $price['min'] && $max == $price['max']) {
                    echo 'checked="checked"';
                }
            }
        ?>

        >
        <label for="<?php echo $price_field_name ?>[<?php echo $key ?>]">
            <?php echo $price['min'] . ' - ' . $price['max'] ?>
        </label>
    </li>
<?php } ?>
</ul>
