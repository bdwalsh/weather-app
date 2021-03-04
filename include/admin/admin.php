<div class="wrap">
<h1>Weather Plugin</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'weather-settings' ); ?>
    <?php do_settings_sections( 'weather-settings' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">City List</th>
        <span>Add a comma separated list of cities for selection eg. (Vancouver, Toronto, Montreal)</span>
        <td><input type="text" name="weather-settings_city" value="<?php echo esc_attr( get_option('weather-settings_city') ); ?>" /></td>
        </tr>

    </table>
    
    <?php submit_button(); ?>

</form>
</div>