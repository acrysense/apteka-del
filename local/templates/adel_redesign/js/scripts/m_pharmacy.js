m_Pharmacy={
    pharmList:null,
    regions:[],
    cities:[],

    get_near_pharmacies: function (lat, lng, check_remains, func) {

        var not_order=c_Pharmacy.not_order;
        var is_main=c_Pharmacy.is_main;

        $.get( "/ajax/pharmacies.php", {
            validation: 1,
            lat: lat,
            lng: lng,
            request: 'near',
            check_remains: check_remains,
            not_order: not_order,
            is_main: is_main
        }).done(function( data ) {
            data=JSON.parse(data);


            m_Pharmacy.pharmList=data.pharmacies;
            func(data, 'near');
        });
    },

    get_list_pharmacies: function (check_remains, func) {
        var not_order=c_Pharmacy.not_order;
        var is_main=c_Pharmacy.is_main;
        $.get( "/ajax/pharmacies.php", {
            validation: 1,
            request: 'list',
            check_remains: check_remains,
            not_order: not_order,
            is_main: is_main
        }).done(function( data ) {
            data=JSON.parse(data);

            m_Pharmacy.pharmList=data.pharmacies;
            func(data, 'list');
        });
    },

    init_geo:function(geoObject){
        m_Pharmacy.regions=geoObject.regions;
        m_Pharmacy.cities=geoObject.cities;
    },

    filter:function (params) {
        var pharmacies=[];


        var social=params.social;
        var child=params.child;
        var area=params.area;
        var city=params.city;


        if(m_Pharmacy.pharmList) {
            for (var i = 0; i < m_Pharmacy.pharmList.length; i++) {
                pharmacy = m_Pharmacy.pharmList[i];


                if (area > 0) {
                    if (pharmacy.region != area) {
                        continue;
                    }
                }

                if (city > 0) {
                    if (pharmacy.city != city) {
                        continue;
                    }
                }

                if (social) {
                    if (pharmacy.social != true) {
                        continue;
                    }
                }

                if (child) {
                    if (pharmacy.child != true) {
                        continue;
                    }
                }

                pharmacies.push(pharmacy);


            }
        }


        return pharmacies;
    },

    get_cities:function(region, func){
        $.get( "/ajax/pharmacies.php", {
            validation: 1,
            request: 'cities',
            region: region
        }).done(function( data ) {
            data=JSON.parse(data);
            func(data);
        });
    },

    calc_center:function (pharmacies) {
        var max_lng=0;
        var min_lng=999;
        var max_lat=0;
        var min_lat=999;






        for(var i=0; i<pharmacies.length; i++){
            var pharmacy=pharmacies[i];
            if(max_lng<pharmacy.lng){
                max_lng=parseFloat(pharmacy.lng);
            }

            if(min_lng>pharmacy.lng){
                min_lng=parseFloat(pharmacy.lng);
            }

            if(max_lat<pharmacy.lat){
                max_lat=parseFloat(pharmacy.lat);
            }

            if(min_lat>pharmacy.lat){
                min_lat=parseFloat(pharmacy.lat);
            }
        }



        return {
            lat: parseFloat(Math.abs(min_lat+max_lat)/2),
            lng: parseFloat(Math.abs(min_lng+max_lng)/2)
        };
    }
}