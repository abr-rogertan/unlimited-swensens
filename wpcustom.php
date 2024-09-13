<?php
/**
 * Plugin Name:       WPForms Custom
 * Plugin URI:        http://teochewthunder.com
 * Description:       In-house customization for WPForms.
 * Requires at least: 5.2
 * Requires PHP:      5.6
 * Author:            Roger Tan
 * Author URI:        http://teochewthunder.com
 * Version:           1.5.0
 * Text Domain:       wpforms-custom
 * Domain Path:       languages
 */

function wpf_dev_cond_time() {
	/*
	$curl = curl_init();

	curl_setopt_array($curl, [
	  CURLOPT_URL => "https://prod-45.southeastasia.logic.azure.com/workflows/1ca9554516b44916b3456a0fc98be37c/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=7a1fX8yZhW9LkF6q2gv0DGUCeBYuutF3wOalRWXmKXE",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 10,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET"
	]);

	$response = curl_exec($curl);
	$err = curl_error($curl);
	$info = curl_getinfo($curl);

	curl_close($curl);	*/

	$response = get_post_meta(1, 'date_json', true);
   ?>
<script type="text/javascript">
        var d = new Date();
		var mxd = new Date();
	
		// if no response from API...
		// disable all dates
		var maxDate = mxd;
		var disabledDates = [new Date(2024, 0, 1)]; //placeholder value
		var almostfullDates = [];
		var halffullDates = [];
		var fullDates = [];
	
		var resStr = '<?php echo str_replace("'", "-", $response); ?>';
		var obj = JSON.parse(resStr);
		
		if (obj.body) {		
			maxDate = mxd.setDate(d.getDate() + 90);
			
			var processed = [];
			
			for (var i = 0; i < obj.body.length; i++) {
				var currentDate = obj.body[i].Date;
				if (processed.indexOf(currentDate) == -1) {
					processed.push(currentDate);
					var slots = obj.body.filter((x) => { return x.Date == currentDate; });
					console.log(currentDate, slots.length )
					var arr = currentDate.split("/");
					if (slots.length > 20) {
						disabledDates.push(new Date(parseInt(arr[2]), parseInt(arr[1]) - 1, parseInt(arr[0])));
						fullDates.push(["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"][parseInt(arr[1]) - 1] + " " + parseInt(arr[0]) + ", " + arr[2]);
					}
					
					if (slots.length > 14 && slots.length <= 18) {
						almostfullDates.push(["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"][parseInt(arr[1]) - 1] + " " + parseInt(arr[0]) + ", " + arr[2]);
					}
					
					if (slots.length > 8 && slots.length <= 14) {
						halffullDates.push(["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"][parseInt(arr[1]) - 1] + " " + parseInt(arr[0]) + ", " + arr[2]);
					}
				}
			}
			
			console.log(disabledDates);
		} else {
			maxDate = mxd.setDate(d.getDate() -1);
			alert("We are experiencing a huge number of reservation requests and have disabled the dates temporarily to avoid overbooking. Please try again at a later time.");
		}		
	
        window.wpforms_datepicker = {
            minDate: d.setDate(d.getDate()),
            //minDate: d.setDate(13),
			maxDate: maxDate,
			showMonths: 2,
			disable: disabledDates,
			onDayCreate: function(dObj, dStr, fp, dayElem) {
				console.log(jQuery(dayElem).attr("aria-label"));
				
				if (almostfullDates.indexOf(jQuery(dayElem).attr("aria-label")) !== -1) {
				  dayElem.className += " almostfullDates";
				}
				
				if (halffullDates.indexOf(jQuery(dayElem).attr("aria-label")) !== -1) {
				  dayElem.className += " halffullDates";
				}
				
				if (fullDates.indexOf(jQuery(dayElem).attr("aria-label")) !== -1) {
				  dayElem.className += " fullDates";
				}
			},
			onValueUpdate: function(selectedDates, dateStr, instance) {	
				jQuery("#wpforms-37-field_6-time").val("");
				
				jQuery("#wpforms-37-field_6-time").on("click", (d)=> { 
					jQuery("li.ui-timepicker-am").show();
					jQuery("li.ui-timepicker-pm").show();
					
					var obj = JSON.parse('<?php echo str_replace("'", "-", $response); ?>');

					if (obj.body) {		
						console.log("using actual...");
						var disabledTimes = obj.body.filter((x)=> { return x.Date == dateStr;});
					} else {
						console.log("using backup... ");
						
						var disabledTimes = [
							{"Date":dateStr,"Time":"9:00 AM"},
							{"Date":dateStr,"Time":"9:30 AM"},
							{"Date":dateStr,"Time":"10:00 AM"},
							{"Date":dateStr,"Time":"10:30 AM"},
							{"Date":dateStr,"Time":"11:00 AM"},
							{"Date":dateStr,"Time":"11:30 AM"},
							{"Date":dateStr,"Time":"12:00 PM"},
							{"Date":dateStr,"Time":"12:30 PM"},	
							{"Date":dateStr,"Time":"1:00 PM"},
							{"Date":dateStr,"Time":"1:30 PM"},
							{"Date":dateStr,"Time":"2:00 PM"},
							{"Date":dateStr,"Time":"2:30 PM"},	
							{"Date":dateStr,"Time":"3:00 PM"},
							{"Date":dateStr,"Time":"3:30 PM"},
							{"Date":dateStr,"Time":"4:00 PM"},
							{"Date":dateStr,"Time":"4:30 PM"},	
							{"Date":dateStr,"Time":"5:00 PM"},
							{"Date":dateStr,"Time":"5:30 PM"},
							{"Date":dateStr,"Time":"6:00 PM"},
							{"Date":dateStr,"Time":"6:30 PM"},	
							{"Date":dateStr,"Time":"7:00 PM"},
							{"Date":dateStr,"Time":"7:30 PM"},
							{"Date":dateStr,"Time":"8:00 PM"},
							{"Date":dateStr,"Time":"8:30 PM"},	
							{"Date":dateStr,"Time":"9:00 PM"},
							{"Date":dateStr,"Time":"9:30 PM"}						
						];
					}
					
					//check for today, add all prior timeslots to current time to disabled list.
					var d = new Date();
					var todayDateStr = (d.getDate() < 10 ? "0" + d.getDate() : d.getDate()) + "/" + ((d.getMonth() + 1) < 10 ? "0" + (d.getMonth() + 1) : (d.getMonth() + 1)) + "/" + d.getFullYear();

					if (dateStr == todayDateStr) {
						var hr = d.getHours();
						
						for (i = 9; i <= hr; i++) {
							if (i == 12) {
								disabledTimes.push({"Date":todayDateStr,"Time": "12:00 PM"});
								disabledTimes.push({"Date":todayDateStr,"Time": "12:30 PM"});
							}
							
							if (i < 12) {
								disabledTimes.push({"Date":todayDateStr,"Time": i + ":00 AM"});
								disabledTimes.push({"Date":todayDateStr,"Time": i + ":30 AM"});
							} else {
								disabledTimes.push({"Date":todayDateStr,"Time": (i - 12) + ":00 PM"});
								disabledTimes.push({"Date":todayDateStr,"Time": (i - 12) + ":30 PM"});
							}
						}
					}
					
console.log(disabledTimes)
					for (var i = 0; i < disabledTimes.length; i++) {
						if (disabledTimes[i].Time.indexOf("AM") != -1) {
							jQuery("li.ui-timepicker-am:contains('" + disabledTimes[i].Time + "')").hide();	
						}

						if (disabledTimes[i].Time.indexOf("PM") != -1) {
							jQuery("li.ui-timepicker-pm:contains('" + disabledTimes[i].Time + "')").hide();	
							
							//check for ambiguity
							if (disabledTimes[i].Time == "2:00 PM") {
								var timeslots = disabledTimes.filter((x) => { return (x.Time == "12:00 PM")});
								if (timeslots.length == 0) jQuery("li.ui-timepicker-pm:contains('12:00 PM')").show();	
							}
							
							if (disabledTimes[i].Time == "2:30 PM") {
								var timeslots = disabledTimes.filter((x) => { return (x.Time == "12:30 PM")});
								if (timeslots.length == 0) jQuery("li.ui-timepicker-pm:contains('12:30 PM')").show();	
							}
						}
					}
				});
			}
        }
	
		jQuery("#wpforms-37-field_6-time").on("input", (d)=> { jQuery("#wpforms-37-field_6-time").val(""); });
	
		//new Date(2024, 2, 1) is 1 March 2024
/*	
        window.wpforms_timepicker = {

            disableTimeRanges: [
                [ '12pm', '1pm' ]
            ]
 
        };*/
 </script>
<?php
}
add_action( 'wpforms_wp_footer_end', 'wpf_dev_cond_time', 20 );
 
function wp_plugin_activation() {
    if ( ! wp_next_scheduled( 'evm_get_date_json' ) ) {
        wp_schedule_event( time(), 'every_minute', 'evm_get_date_json' );
    }
}

register_activation_hook( __FILE__, 'wp_plugin_activation' );

function wp_plugin_deactivation() {
    wp_clear_scheduled_hook( 'evm_get_date_json' );
}

register_deactivation_hook( __FILE__, 'wp_plugin_deactivation' );

function wc_get_date_json() {
	$curl = curl_init();

	curl_setopt_array($curl, [
	  CURLOPT_URL => "https://prod-45.southeastasia.logic.azure.com/workflows/1ca9554516b44916b3456a0fc98be37c/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=7a1fX8yZhW9LkF6q2gv0DGUCeBYuutF3wOalRWXmKXE",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 15,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET"
	]);

	$response = curl_exec($curl);
	$err = curl_error($curl);
	$info = curl_getinfo($curl);

	curl_close($curl);	
	
	if (strpos($response, "error") === false) update_post_meta(1, "date_json", $response);
}

add_action( 'evm_get_date_json', 'wc_get_date_json' );
