var Initialized = false;
var MapInit = function(x,y,marker)
{
    if( !Initialized )
    {
        var styles = [{
            "stylers": [
                {"hue": "#0090ff"},
                {"saturation": -80}
            ]
        }];
        var myLatlng = new google.maps.LatLng(x,y);
        var mapOptions = {
            zoom: 16,
            center: myLatlng,
            //disableDefaultUI: true,
            zoomControl: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
            animation: google.maps.Animation.DROP,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'bestfromgoogle']
            }
        }
        var map = new google.maps.Map(document.getElementById('map-container'), mapOptions);
        var styledMapOptions = {
            name: "ZigZagLab"
        };
        var zigMapType = new google.maps.StyledMapType(styles, styledMapOptions);

        map.mapTypes.set('bestfromgoogle', zigMapType);
        map.setMapTypeId('bestfromgoogle');

        var companyImage = new google.maps.MarkerImage(marker,
            null,
            null,
            null,
            new google.maps.Size(50,60)
        );

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'ZigZagLab',
            icon: companyImage
        });
        var infowindow = new google.maps.InfoWindow({
            content:"<a href=\"google.ir\" style=\" padding-right: 15px; color: #000; font-size: 14px; font-weight: 500; font-family: IranSans; \">کاشان</a>"
        });

        infowindow.open(map,marker);

        Initialized = true;
    }
};
// MapInit();