window.UrlUtil={
    getParam: function(param){
        var params=this.getParams();

        return params[param];
    },
    /////////////////////////////////////////////////////
    getParams: function(){
        var parts=location.search.substr(1).split("&");



        var resultParams={};
        for(var i=0; i<parts.length; i++){



            var arr=parts[i].split('=');

            if(arr[1]===undefined){
                continue;
            }

            resultParams[arr[0]]=arr[1];
        }
        return resultParams;
    },
    /////////////////////////////////////////////////////
    setUrl: function(params, deletePars){
        console.info('check set');
        var existsParams=[];

        if(deletePars==undefined){
            deletePars=[];
        }

        var curLoc;

        var existsParams=this.getParams();

        var keys=Object.keys(params);//make unique values in url


        for(var i=0; i<deletePars.length; i++){
            var key=deletePars[i];

            if(existsParams[key]!=undefined){
                delete existsParams[key];
            }
        }

        if(keys.length>0){
            curLoc='?';

            var keys_exist=Object.keys(existsParams);


            for(var i=0; i<keys_exist.length; i++){
                if(typeof(params[keys_exist[i]])=='undefined'){//add nonexistent params
                    curLoc+=keys_exist[i]+"="+existsParams[keys_exist[i]]+"&";
                }
            }

            for(var i=0; i<keys.length; i++){
                curLoc+=keys[i]+"="+params[keys[i]];
                if(i<keys.length-1){
                    curLoc+="&";
                }
            }

            try {
                history.pushState(null, null, curLoc);
                return;
            } catch(e) {}


            location.hash = '#' + curLoc;
        }

    },
    /////////////////////////////////////////////////////
    format: function(params){



        var keys=Object.keys(params);
        var newParams={};
        var delPars=[];

        for(var i=0; i<keys.length; i++){
            var key=keys[i];

            if(key==undefined){
                continue;
            }

            if(params[key]==undefined){
                delPars.push(key);
                continue;
            }

            if(typeof(params[key])=='object'){
                if(params[key].length==0){
                    delPars.push(key);
                    continue;
                }
            }
            else{
                if((typeof(params[key])=='string')){

                    if(params[key].length==0){
                        continue;
                    }

                    if(key.length==0){
                        continue;
                    }
                }
            }
            newParams[key]=params[key];
        }

        UrlUtil.setUrl(newParams, delPars);
    }

};
