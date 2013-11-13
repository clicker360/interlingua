google.load("maps", "3",  {other_params:"sensor=false"});
/**
 * mappedcontactformpro.js 
 * main javascript file of mapped contact form pro
 * a professional google maps contact form from autobahn81.com
 */

/**
 * Namespace. A helper for reating namespaces in javascript.
 */
var Namespace =
{
    Register : function(_Name)
    {
        var chk = false;
        var cob = "";
        var spc = _Name.split(".");
        for(var i = 0; i<spc.length; i++)
        {
            if(cob!=""){cob+=".";}
            cob+=spc[i];
            chk = this.Exists(cob);
            if(!chk){this.Create(cob);}
        }
        if(chk){ throw "Namespace: " + _Name + " is already defined."; }
    },

    Create : function(_Src)
    {
        eval("window." + _Src + " = new Object();");
    },

    Exists : function(_Src)
    {
        eval("var NE = false; try{if(" + _Src + "){NE = true;}else{NE = false;}}catch(err){NE=false;}");
        return NE;
    }
}

/**
  * add the travel map pro namespace
  */
Namespace.Register("mappedContactForm"); 

/**
 * helper to store the markers to make them available from html
 */
mappedContactForm.markers = new Array();

/**
 * initalizes the map with markers and polyline on onload
 */
mappedContactForm.initialize = function(){
	// map options
    var myOptions = {
        zoom: mappedContactForm.mapZoom,
        center: new google.maps.LatLng(mappedContactForm.mapCenter[0], mappedContactForm.mapCenter[1]),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
	// map options end
	
	// init map with options
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    // init infowindow
    var infowindow = new google.maps.InfoWindow();

	//helper function for handling multiple infowindows
    function myInfoWindow(mymarker) {
        infowindow.close();
        infowindow.setPosition(mymarker.getPosition());
        infowindow.setContent(mymarker.infoContent);
        infowindow.open(map);
		mappedContactForm.validate();
    }

    // helper function to close opend infowindows
    closeinfowindow = function() {
        infowindow.close();
    };

	// close opened infowindows by click on the map
    google.maps.event.addListener(map, 'click', closeinfowindow);
	
	//iterate over all locations
    for (var i = 0; i < mappedContactForm.locations.length; i++) {
        var stop = mappedContactForm.locations[i];//get stop from locations array
        var myLatLng = new google.maps.LatLng(stop[1], stop[2]);//get lat and lng from stop
		
		//add marker for stop
        var marker = new google.maps.Marker({
            position: myLatLng,
            shadow: mappedContactForm.shadowImage(),
            icon: mappedContactForm.markerImage(stop[3]),//get image for this marker
            shape: mappedContactForm.markerShape(),
            title: stop[0],
            zIndex: i
        });
		//add marker for stop end
        marker.infoContent = mappedContactForm.infoWindowHtml(stop[0], stop[4]);//add info window content to marker
        marker.setMap(map); //draw marker on the map
						
		//add mouseover listener to marker
        google.maps.event.addListener(marker, mappedContactForm.listener,
        function() {
            myInfoWindow(this);
        });
		//open info when only on marker is on the map
		if (mappedContactForm.locations.length == 1){
		  google.maps.event.trigger(marker, mappedContactForm.listener); 			
		}
		mappedContactForm.markers.push(marker);
    }
	//iterate over all locations end
}

/*
 * Image for marker
 * return start marker if location is the first stop
 * return end marker if the location is the last stop
 */
mappedContactForm.markerImage = function(picture){
	return new google.maps.MarkerImage(
		mappedContactForm.pluginsUrl + '/mcfplib/buildings/' + picture +  '.png',
    	// This marker is 36 pixels wide by 38 pixels tall.
    	new google.maps.Size(36, 38),
    	// The origin for this image is 0,0.
    	new google.maps.Point(0, 0),
    	// The anchor for this image is the base of the flagpole at 18,38.
    	new google.maps.Point(18, 38)
    );
}

/*
 * Image for marker shadow
 */
mappedContactForm.shadowImage = function(){
	return new google.maps.MarkerImage(mappedContactForm.pluginsUrl + '/mcfplib/buildings/shadow.png',
    	new google.maps.Size(36, 38),
    	new google.maps.Point(0, 0),
    	new google.maps.Point(0, 38)
	);
}

/* 
 * Image map region definition used for drag/click.
 */
mappedContactForm.markerShape = function(){
    var shape = {
        coord: [1, 1, 1, 20, 18, 20, 18, 1],
        type: 'poly'
    };	
}

mappedContactForm.textareaFormField = function(name, placeholder){
	var messageFormString = '';
	if ( jQuery.browser.mozilla ) {
	  messageFormString = ' <input name="' + name + '" type="text" id="' + name + '" placeholder="' + placeholder + '" /> ';
	} else {
	  messageFormString = ' <textarea name="' + name + '" cols="30" rows="3"  id="' + name + '" placeholder="' + placeholder + '" spellcheck="true" ></textarea>'
	}
	return messageFormString;
}

/**
 * Helper to male markers linkable
 */
mappedContactForm.openInfoWindow = function(marker){
	google.maps.event.trigger(marker, mappedContactForm.listener);
}

google.setOnLoadCallback(mappedContactForm.initialize);