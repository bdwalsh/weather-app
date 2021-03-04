<?php
function display_widget() {
  
  $cities = get_option( 'weather-settings_city' );
  $cities_array = explode(',', $cities);  

  if( is_front_page() ) {
?>
    <section>
      <div class="wrap">
        <h5>Weather Forecast</h5>
        <div class ="city-select" id="city-select">
          <label for="cities">Choose a City:</label>

          <select name="cities" id="cities">
            <?php  foreach ($cities_array as $city) { ?>
              <option value="<?php echo esc_attr( $city ); ?>" default><?php echo esc_html( $city ); ?></option>
            <?php } ?>
          </select>
        </div> 

        <div class="weather-panels" id="weather-panels-container">
        <i class="fas fa-spinner spin"></i> 
        </div>
      </div> 

    </section>

    <?php

  }

}

add_action('wp', 'display_widget');
?>