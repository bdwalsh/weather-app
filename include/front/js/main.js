jQuery( function ( $ ) {
	let cityInput = document.getElementById( 'cities' );
	callWeatherAPI( cityInput.value );

	document.querySelector( '#cities' ).addEventListener( 'change',function() {
    callWeatherAPI( cityInput.value );
	});

	/**
	 * AJAX call for the open weather API
	 * 
	 * @param string city - city to get the weather for
	 */
	function callWeatherAPI( city ) { 	
		
		$.ajax({
			type: 'POST',
			url: 'http://api.openweathermap.org/data/2.5/forecast?q=' + city + '&units=metric&APPID=6891818ef5e052d042071a258ec1a721',
			success: function ( data ) {
				
				populateWidget( data )
			},
			error:  function ( xhr ) {
        alert( "API call error " + xhr.status );
      }

		});

	}


	/**
	 * Populate the front-end with weather data
	 * 
	 * @param string data - data returned from the API
	 */
	function populateWidget( data ) {
		
		let weatherData  = formatData( data );
		let weekdays     = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
		let weatherIcons = {
			Rain: 'fa-cloud-rain',
			Snow: 'fa-snowflake',
			Clear: 'fa-sun',
			Clouds: 'fa-cloud'
		};

		let container    = document.getElementById ('weather-panels-container');
		let cards        = document.createElement('div');

		weatherData.weatherItems.forEach(element => {

			let weatherCard = document.createElement( 'div' );
			let titleEl     = document.createElement( 'h4' );
			let weatherDiv  = document.createElement( 'div' );
			let tempDiv     = document.createElement( 'span' );
			let humidityDiv = document.createElement( 'span' );
			let windDiv     = document.createElement( 'span' );

			weatherCard.classList.add( 'weather-card' );
			titleEl.classList.add( 'weather-card__title' );
			titleEl.classList.add( 'weather-card__title--' + element.weather );
			weatherDiv.classList.add( 'weather-card__weather' );
			tempDiv.classList.add( 'weather-card__temp' );
			humidityDiv.classList.add( 'weather-card__humidity' );
			windDiv.classList.add( 'weather-card__wind' );

			let date = new Date( element.date );
			let day = date.getDay();

			titleEl.append( weekdays[day] );
			weatherDiv.append( element.weather );
			tempDiv.append( 'Low: ' + element.minTemp + ' °C ' + 'High: ' + element.maxTemp + ' °C' );
			humidityDiv.append( 'Humidity: ' + element.humidity );
			windDiv.append( 'Wind: ' + element.wind );

			weatherCard.appendChild( titleEl );	

			for ( const property in 	weatherIcons ) {
				
				if( property === element.weather ) {
					let icon = document.createElement('i');
					icon.classList.add( 'fas' );
					icon.classList.add( weatherIcons[property] );
					weatherCard.appendChild( icon );
				}
			}
			weatherCard.appendChild( weatherDiv );
			weatherCard.appendChild( tempDiv );
			weatherCard.appendChild( humidityDiv );
			weatherCard.appendChild( windDiv );


			cards.appendChild( weatherCard );

		});
		container.innerHTML = cards.innerHTML;
	}

	
	/**
	 * Format JSON data from the weather API
	 * 
	 * @param string data - JSON data to be formatted
	 */
  function formatData( data ) {
    
    let formattedDate  = '';
    let formattedArray = {'weatherItems': [], 'city': data.city.name};

    for ( let i = 0; i < data.list.length; i++)  {
      let dateSplit = data.list[i].dt_txt.split( " " );
      let dayArray  = [];

      if ( dateSplit[0] !== formattedDate ) {
        dayArray['date']     = data.list[i].dt_txt;
        dayArray['weather']  = data.list[i].weather[0].main;
        dayArray['minTemp']  = data.list[i].main.temp_min;
        dayArray['maxTemp']  = data.list[i].main.temp_max;
        dayArray['humidity'] = data.list[i].main.humidity;
        dayArray['wind']     = data.list[i].wind.speed;
				formattedArray.weatherItems.push( dayArray );
        formattedDate = dateSplit[0];
      }
    }

    return formattedArray;
  }

});



