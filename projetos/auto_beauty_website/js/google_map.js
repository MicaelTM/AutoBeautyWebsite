var google;

var myCenter = new google.maps.LatLng(34.068859137628465, -118.25173151196323);
function initialize(){
    var mapProp = {
        center:myCenter,
        zoom:12,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    
    var map = new google.maps.Map(document.getElementById("map"),mapProp);
    
    var marker = new google.maps.Marker({
        position:myCenter
    });
    
    marker.setMap(map);
}
google.maps.event.addDomListener(window, 'load', initialize);