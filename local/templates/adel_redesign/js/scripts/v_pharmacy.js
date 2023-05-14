v_Pharmacy={

    markers:[],
    windows:[],

    init: function(){
        // v_Pharmacy.init_map(50.809126, 4.232317);

    },
    resetControlls:function(){
      $("#selectRegionPharm").val(0).trigger('refresh').change();
      $("#selectCity").val(0).trigger('refresh')
    },
    init_map:function (params, mode) {

        v_Pharmacy.remove_markers();


        var lat=parseFloat(params.lat);
        var lng=parseFloat(params.lng);
        var center;
        var pharmacies=params.pharmacies;

        if(pharmacies){
            $("#maps-canvas").show();
            $("#maps-error").hide();


            var bounds  = new google.maps.LatLngBounds();
            var zoom=12;
        }
        else{
            $("#maps-canvas").hide();
            $("#maps-error").show();

        }



        if(pharmacies){

            console.info(pharmacies)



            if(lat<1){
                center=m_Pharmacy.calc_center(pharmacies)
                lat=center.lat;
                lng=center.lng;

                zoom=6;
            }


            window.map = new google.maps.Map(document.getElementById('maps-canvas'), {
                zoom: zoom,
                center: {lat: lat, lng: lng},
                mapTypeControl: false,
                fullscreenControl: false
            });

            console.info('mode', mode);


            if(mode!='list') {

                //marker of client position:
                var icon_pos = {
                    url: window.templatePath + '/img/geo-location.svg', // url
                    scaledSize: new google.maps.Size(40, 40), // scaled size
                    origin: new google.maps.Point(0, 0), // origin
                    anchor: new google.maps.Point(20, 40) // anchor
                };

                var marker_pos = new google.maps.Marker({
                    position: {lat: lat, lng: lng},
                    map: window.map,
                    icon: icon_pos,
                    title: 'You here'
                });

                v_Pharmacy.markers.push(marker_pos);



            }
            else{
                console.info(marker_pos);
            }



            //////////////////

            //var latlng=new google.maps.LatLng(lat, lng);

        }
        else{
        }





        if(pharmacies.length>0) {

            console.info(pharmacies, '!!!!');

            for (var i = 0; i < pharmacies.length; i++) {

                var latlng=new google.maps.LatLng(pharmacies[i].lat, pharmacies[i].lng);

                v_Pharmacy.add_pharmacy_to_map(pharmacies[i])

                bounds.extend(
                    latlng
                );
            }

            console.info(bounds);

            //window.map.initialZoom = true;
            window.map.fitBounds(bounds);
            if(mode=='near'){
                setTimeout(function () {
                    window.map.setZoom(12);

                }, 500)
            }
        }
        else{
            console.info('aaaa');
            if(mode=='near'){
                window.map.setCenter({lat:c_Pharmacy.lat, lng:c_Pharmacy.lng});
            }
            else{
                window.map.setCenter({lat:53.833331, lng:27.898675});
            }
        }





    },





    add_pharmacy_to_map: function (pharmacy) {

        var lat=parseFloat(pharmacy.lat);
        var lng=parseFloat(pharmacy.lng);

        var name=pharmacy.name;
        var address=pharmacy.address;

        var distance=pharmacy.distance;

        var icon = {
            url: window.templatePath+'/img/apteka-marker.svg', // url
            scaledSize: new google.maps.Size(40, 40), // scaled size
            origin: new google.maps.Point(0, 0), // origin
            anchor: new google.maps.Point(20, 40) // anchor
        };

        var icon_alt = {
            scaledSize: new google.maps.Size(40, 40), // scaled size
            origin: new google.maps.Point(0, 0), // origin
            anchor: new google.maps.Point(20, 40) // anchor
        };

        var marker;



        if(c_Pharmacy.not_order==1){
            marker= new google.maps.Marker({
                position: {lat: lat, lng: lng},
                map: window.map,
                title: name,
                icon:icon

            });
        }
        else{

            if(pharmacy.brand!='ADEL'){
                marker= new google.maps.Marker({
                    position: {lat: lat, lng: lng},
                    map: window.map,
                    title: name,
                    icon:icon_alt

                });
            }
            else{
                marker= new google.maps.Marker({
                    position: {lat: lat, lng: lng},
                    map: window.map,
                    title: name,
                    icon:icon

                });

            }
        }










        v_Pharmacy.markers.push(marker);


        var contentString =
            '<div class="wrapper-info"><div class="name">'+name+'</div><div class="street">'
            +address+'</div>';
        if(distance){

            contentString+='<div class="distance">'
                +distance+'</div>';
        }

        contentString+='</div>';

        var infoWindow = new google.maps.InfoWindow({
            content: contentString,
            maxWidth: 280
        });
        v_Pharmacy.windows.push(infoWindow);

        function isInfoWindowOpen(infoWindow) {
            var map = infoWindow.getMap();
            return (map !== null && typeof map !== "undefined");
        }

        marker.addListener('click', function () {
            for(var i=0; i<v_Pharmacy.windows.length; i++){
                v_Pharmacy.windows[i].close();
            }
            if (isInfoWindowOpen(infoWindow)) {
                infoWindow.close();
            } else {
                infoWindow.open(window.map, marker);
            }

        });

        marker.addListener('click', function() {
            $("#apteka_block").show();
            $(".selected_pharmacy").text(pharmacy.name+", "+pharmacy.city_name+", "+pharmacy.address);
            $("#form_farmacy").val(pharmacy.id);

            if(c_Pharmacy.check_remains==1){//check if product enough
                if(pharmacy.enough==0){
                    $("#product_not_enough").show();
                }
                else{
                    $("#product_not_enough").hide();
                }
            }

            $("#btn_submit_step_3").attr('disabled', false);

        });

        return new google.maps.LatLng(marker.position.lat(), marker.position.lng());






    },

    // add_pharmacies_to_map:function (pharmacies) {
    //     v_Pharmacy.remove_markers();
    //     for(var i=0; i<pharmacies.length; i++){
    //         v_Pharmacy.add_pharmacy_to_map(pharmacies[i]);
    //     }
    // },

    remove_markers:function () {
        for(var i=0; i<v_Pharmacy.markers; i++){
            v_Pharmacy.markers[i].setMap(null);
        }
        v_Pharmacy.markers.length=0;
    },

    get_filter_params:function (mode='near') {
        if(mode=='near'){
            return {
                social:$('#discountCheckBox').prop('checked'),
                child:$('#kidszoneCheckBox').prop('checked')
            };
        }
        else{
            return {
                social:$('#discountCheckBox').prop('checked'),
                child:$('#kidszoneCheckBox').prop('checked'),
                area: parseFloat($("#selectRegionPharm").val()),
                city: parseFloat($("#selectCity").val())
            };
        }
    },

    fill_cities_list:function (data) {
        $("#selectCity").html('<option value="0" data-order="0" selected>Город</option>');
        for(var i=0; i<data.length; i++){
            var el_option=document.createElement('option');
            $(el_option).val(data[i].ID).text(data[i].NAME).appendTo($("#selectCity"));
        }

        $("#selectCity").val(0)

        $('#selectCity').trigger('refresh');
    }


}