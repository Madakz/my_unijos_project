<?php
// Author: Daniel Hagquist
// Date: 8/16/2016

// Get user location via IP address using 3rd party geoPlugin class
require_once("geoplugin.class.php");
$geoplugin = new geoPlugin();
$geoplugin->locate();
$city = $geoplugin->city;
$state = $geoplugin->region;
$country = $geoplugin->countryName;
$longitude = $geoplugin->longitude;
$latitude = $geoplugin->latitude;

// Parse weather data from Dark Sky Forecast API via JSON
$key = "89ad93bbc5fa1872b77b9e59c36fe3f7"; // Replace this string with your Dark Sky Forecast API key
$url = "https://api.darksky.net/forecast/" . $key . "/" . $latitude . "," . $longitude;
$json = file_get_contents($url);
$data = json_decode($json);

// print_r($data);
// die();

// Converts degrees to compass direction for computing wind direction
function degToCompass($num) {
    $val = $num / 22.5 + 0.5;
    $arr = array("N","NNE","NE","ENE","E","ESE", "SE", "SSE","S","SSW","SW","WSW","W","WNW","NW","NNW");
    return $arr[$val % 16];
}
?>

<!-- Output weather widget -->
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/weather.css">
</head>
<body>

<div id="weather">

  <div id="currenttemp">
    <?php echo round($data->currently->temperature) ?>&deg;
  </div>
  
  <div id="highlow">
    <b>H:</b> <?php echo round($data->daily->data[0]->temperatureMax) ?>&deg;<br>
	<b>L:</b> <?php echo round($data->daily->data[0]->temperatureMin) ?>&deg;
  </div>
  
  <div id="hourly">
	<a href="javascript:;" id="myBtn"><b>Hourly</b></a>
		<div id="myModal" class="modal">
		  <div class="modal-content">
			  <span class="close">x</span>
			  <hourlytitle>Hourly Forecast</hourlytitle><br>
			  <table>
				<tr>
				<td><b>Time</b></td>
				<td><b>Temp</b></td>
				<td colspan="2"><b>Chance Rain</b></td>
				<?php
				for ($i = 1; $i <= 24; $i++) {
					echo '<tr><td>';
					echo date('gA',$data->hourly->data[$i]->time);
					echo '</td><td>';
					echo round($data->hourly->data[$i]->temperature) . "&deg;";
					echo '</td><td>';
					echo (($data->hourly->data[$i]->precipProbability) * 100) . "%";
					echo '</td><td align="right">';
					echo '<img src="icons/' . $data->hourly->data[$i]->icon . '.gif" title="' . $data->hourly->data[$i]->summary . '">';
					echo '</td></tr>';
				} ?>
		      </table>
		  </div>
		</div>
		<!-- Javasrcipt for popup modal window for hourly forecast -->
		<script>
		var modal = document.getElementById("myModal");
		var btn = document.getElementById("myBtn");
		var span = document.getElementsByClassName("close")[0];
		btn.onclick = function() {
			modal.style.display = "block";
		}
		span.onclick = function() {
			modal.style.display = "none";
		}
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
		</script>
    </div>
  
  <div id="icon">
    <a href="http://forecast.weather.gov/MapClick.php?lat=<?php echo $latitude . '&lon=' . $longitude ?>"
	  target="_blank" title="<?php echo $data->currently->summary ?>">
    <img src="icons/<?php echo $data->currently->icon ?>.gif">
	</a>
  </div>

  <div id="date">
    <?php echo date("D F j, Y", $data->currently->time) ?><br>
	<citystate><?php echo $city . ", " . $state ?></citystate><br>
	<country><?php echo $country ?></country>
  </div>
  
  <div id = "details">
    <table>
	<tr>
	<td class="details">
	  Humidity: <?php echo ($data->currently->humidity * 100) ?>%<br>
	  Feels like: <?php echo round($data->currently->apparentTemperature) ?>&deg;<br>
	  Chance of rain: <?php echo $data->currently->precipProbability ?>%
	</td>
	<td class="details">
	  Pressure: <?php echo number_format((float)($data->currently->pressure * 0.001 * 29.53), 2, '.', '') ?> in.<br>
	  Dewpoint: <?php echo $data->currently->dewPoint ?>&deg;<br>
	  Wind: <?php echo $data->currently->windSpeed . " mph " . degToCompass($data->currently->windBearing); ?>
	</td>
	<td class="details">
	  Sunset: <?php echo date("g:i A", $data->daily->data[0]->sunsetTime) ?><br>
	  Cloud cover: <?php echo $data->currently->cloudCover ?>%<br>
	  Ozone: <?php echo $data->currently->ozone ?> DU
	</td>
	</table>
  </div>

  <div id="forecast">
    <table>
	  <tr>
	  <td>
	  <?php
	  for ($i = 1; $i <= 7; $i++) {
	    echo '<td>';
	    echo date("D", $data->daily->data[$i]->time) . "<br />";
	    echo '<img src="icons/' . $data->daily->data[$i]->icon . '.gif'.'".gif title="' . $data->daily->data[$i]->summary .'"><br>';
	    echo round($data->daily->data[$i]->temperatureMax) . "&deg;/";
	    echo round($data->daily->data[$i]->temperatureMin) . "&deg;";
	    echo '</td>';
	  } ?>
	  </tr>
	</table>
  </div>
</div>
</body>
</html>
