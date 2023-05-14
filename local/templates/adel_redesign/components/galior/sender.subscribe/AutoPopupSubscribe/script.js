;(function ( $, window, document, undefined) {

    var AutoPopupSubscribe = function( options ){

        // Идентификаторы и классы элементов формы
        this.body                   = $('body');
        this.window                 = $(window);
        this.document               = $(document);
        this.url                    = options['URL'];
        this.idPopup                = '#auto-popup-subscribe';
        this.idForm                 = options['FORM_ID'];
        this.classFieldEmail        = options['FIELD_EMAIL_ID'];
        this.idBtnSend              = options['BTN_SEND_ID'];
        this.classBtnClosePopup     = '.closeIcon';
        this.timePopupShow          = 3000;

        this.init();
    };

    AutoPopupSubscribe.prototype = {

        init: function () {

            var self = this;

            self.document.ready(function () {

                var url = false;
                var infoUser = BX.getCookie('GALIOR_SENDER_SUBSCRIBE_USER');
                var curUrl = window.location.pathname;

                if(self.url !== undefined || self.url !== ''){
                    if(self.url === curUrl)
                        url = true;
                }

                if((infoUser === undefined || infoUser !== 'N') && url){

                    setTimeout(function() { self.showPopup() }, self.timePopupShow);

                    if($.fn.validate) {
                        $(self.idForm).validate();
                    }

                    self.body.on('click', self.classBtnClosePopup, function(event){

                        var dataId = this.getAttribute('data-id');

                        if(dataId === self.idPopup.slice(1)){
                            self.setCookie();
                            self.hidePopup();
                            event.preventDefault();
                        }

                    });


                    self.body.on('click', self.idBtnSend, function (event) {

                        if($.fn.validate){

                            var validator = $(self.idForm).validate();
                            var validEmail = validator.element(self.classFieldEmail);

                            if(validEmail){
                                self.setCookie();
                            }
                            else{
                                event.preventDefault();
                            }
                        }
                    });

                }

            });

            return this;
        },

        showPopup : function () {
            var self = this;
            OpenWin(self.idPopup.slice(1));
        },

        hidePopup : function () {
            var self = this;
            CloseWin(self.idPopup.slice(1));
        },

        setCookie : function () {
            var self = this;
            BX.setCookie('GALIOR_SENDER_SUBSCRIBE_USER', 'N', {expires: 86400 * 365 * 15, path: '/'});
        },

        validateEmail : function(email) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

    };

    window.AutoPopupSubscribe = AutoPopupSubscribe;

})( $, window, document, undefined );