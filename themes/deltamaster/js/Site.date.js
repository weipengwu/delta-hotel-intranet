
Site = {

	get_query_string_param: function (name) {
	    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	        results = regex.exec(location.search);
	    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	},

}

Site.date = { 

	parse_google_time: function(time_string)
	{
		var weekday = new Array(7);
		weekday[0]=  "Sun";
		weekday[1] = "Mon";
		weekday[2] = "Tue";
		weekday[3] = "Wed";
		weekday[4] = "Thu";
		weekday[5] = "Fri";
		weekday[6] = "Sat";

		var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];

		var ISO_8601_re = /^(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2}):(\d{2})(?:\.(\d{3}))?(Z|[\+-]\d{2}(?::\d{2})?)$/,
		    m = time_string.match(ISO_8601_re);

	    console.log(m);

	    time_args = {

	    	year: m[1],
	    	month: m[2] - 1,
	    	day: m[3],
	    	hour: m[4],
	    	minute: m[5],

	    };

		// temp construct
		var myDate = new Date();
		myDate.setUTCFullYear(time_args['year']);
		myDate.setUTCMonth(time_args['month']);
		myDate.setUTCDate(time_args['day']);
		myDate.setUTCHours(time_args['hour']);
		myDate.setUTCMinutes(time_args['minute']);

		time_args['day_of_week'] = myDate.getDay();
		time_args['day_of_week_string'] = weekday[time_args['day_of_week']];
		time_args['month_string']= monthNames[time_args['month']];

		if (time_args['hour'] >= 12)
			time_args['meridian'] = 'pm';
		else
			time_args['meridian'] = 'am';

		if (time_args['hour'] >= 13)
			time_args['hour'] = time_args['hour'] - 12;

		return time_args;
	}

};