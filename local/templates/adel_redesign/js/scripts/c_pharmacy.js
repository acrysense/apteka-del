c_Pharmacy={
    lat: null,
    lng: null,
    mode: 'near',
    check_remains:0,
    near:function () {
        v_Pharmacy.resetControlls();

        c_Pharmacy.lat=parseFloat(CookieUtil.getCookie('geo_lat'));
        c_Pharmacy.lng=parseFloat(CookieUtil.getCookie('geo_lng'));


        if(!c_Pharmacy.lat && !c_Pharmacy.lng) {
            navigator.geolocation.getCurrentPosition(function (position) {




                console.info('position located');
                c_Pharmacy.lat = position.coords.latitude;
                c_Pharmacy.lng = position.coords.longitude;

                CookieUtil.setCookie('geo_lng', c_Pharmacy.lng, {expires: 3600 * 3, path: '/'})
                CookieUtil.setCookie('geo_lat', c_Pharmacy.lat, {expires: 3600 * 3, path: '/'})

                m_Pharmacy.get_near_pharmacies(
                    c_Pharmacy.lat, c_Pharmacy.lng, c_Pharmacy.check_remains,
                    c_Pharmacy.filter
                );




                },
                function () {
                    if(parseInt(CookieUtil.getCookie('alert_geo'))!=1){
                        alert('Невозможно определить местоположение');
                        CookieUtil.setCookie('alert_geo', 1, {expires: 86400 * 3, path: '/'})


                    }


                    setTimeout(function () {
                        $("#locationCheckBox").click();
                    }, 500);
                }
                );



        }
        else{
            m_Pharmacy.get_near_pharmacies(
                c_Pharmacy.lat, c_Pharmacy.lng, c_Pharmacy.check_remains,
                c_Pharmacy.filter
            );
        }


        c_Pharmacy.mode='near';




    },

    list:function(){

        v_Pharmacy.resetControlls();

        m_Pharmacy.get_list_pharmacies(
            c_Pharmacy.check_remains,
            c_Pharmacy.filter
        );
        c_Pharmacy.mode='list';
    },

    // preparePharmacies:function(pharmacies){
    //     v_Pharmacy.add_pharmacies_to_map(pharmacies);
    // },

    init: function (params) {
        if(params.check_remains==1){
            c_Pharmacy.check_remains=1;
        }

        if(params.is_main){
            console.info('is main');
            c_Pharmacy.is_main=1;
        }

        if(params.not_order==1){
            c_Pharmacy.not_order=1;
        }
        else{
            c_Pharmacy.not_order=0;
        }


        c_Pharmacy.near();
        c_Pharmacy.check_click();
        c_Pharmacy.check_change();
    },


    check_click:function () {
        $("input, a, button").click(function () {
            var el_id=$(this).attr('id');

            switch (el_id){
                // case 'discountCheckBox':
                // case 'kidszoneCheckBox':
                //     c_Pharmacy.filter();
                //
                //     break;

                case 'locationCheckBox':
                    console.info('click?')
                    var mode_near=$("#locationCheckBox").prop('checked')==false;




                    if(mode_near){
                        $("#select_elements").hide();
                        c_Pharmacy.near();
                    }
                    else{
                        $("#select_elements").show();
                        c_Pharmacy.list();
                    }

                    break;
            }
        });
    },

    check_change:function(){
        $("input, select").change(function () {

            var el_id=$(this).attr('id');

            switch (el_id) {
                case 'discountCheckBox':
                case 'kidszoneCheckBox':

                    c_Pharmacy.filter();
                    break;

                case 'selectRegionPharm':
                    var region_id=$(this).val();

                    m_Pharmacy.get_cities(region_id, function (data) {
                        console.info('data', data);
                        v_Pharmacy.fill_cities_list(data);
                        c_Pharmacy.filter();
                    });

                    break;

                case 'selectCity':
                    c_Pharmacy.filter();
                    break;



            }
        });
    },

    filter:function () {
        var paramsFilter=v_Pharmacy.get_filter_params(c_Pharmacy.mode);

        var pharmacies=m_Pharmacy.filter(paramsFilter);

        var paramsMap={};

        paramsMap.lat=0;
        paramsMap.lng=0;






        paramsMap.pharmacies=pharmacies;



        if(c_Pharmacy.mode=='near'){
            paramsMap.lat=c_Pharmacy.lat;
            paramsMap.lng=c_Pharmacy.lng;
        }



        v_Pharmacy.init_map(paramsMap, c_Pharmacy.mode);
        // google.maps.event.addListener(window.map, 'resize');

       setTimeout(function () {

       }, 3000);
    }



}