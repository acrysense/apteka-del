/**
 * Карта объектов аптек
 */
(function(w){
	var PMap = function(center){
		this.src = 'https://api-maps.yandex.ru/2.1/?lang=ru_RU'
		this.center = center;

		this.main = document.querySelector('.s-pharmacy');
		this.mapContainer = this.main.querySelector('.p-map-frame');
		this.showMap = this.main.querySelector('.js-map');
		this.btnSel = this.main.querySelectorAll('.btn-select__btn');
		this.btnShowPhone = this.main.querySelectorAll('.js-show-phone');
		this.icons = ['adel', 'dleki'];
		this.iconImageSize = [30,30];
		this.iconImageOffset = [-15,-30];
		this.objects = places;
		this.newObjects = {};
		this.map = {};
		this.mapObject = {};


        $('.pharmacy-map').show();
        $(this).addClass('is-active')
        this.addYamapsScript();
	};

	var p = PMap.prototype;


	console.log(p)

	p.each = function(items, callback){
		[].forEach.call(items, callback);
	}

	p.initMap = function(){
		var self = this;
		this.map = new ymaps
			.load()
			.then(maps => {
                console.log('then')
				self.mapObject = new maps.Map('map', {
					center: self.center,
					zoom: 11,
					controls: []
				})
				self.mapContainer.classList.add('loaded')

				self.addIcon();
				self.initObjectsManager();
				self.customBalloon();

				if($.isEmptyObject(self.newObjects)) {
					self.updateObjectManager(self.objects);
					return;
				}

				self.updateObjectManager(self.newObjects);

			}).catch(error => console.log(error));
	}

	p.addIcon = function () {
		this.icons.forEach(icon => {
			ymaps.option.presetStorage.add(`icon#${icon}`, {
				iconLayout: 'default#image',
				iconImageHref: `./local/templates/adel_redesign/images/svg/${icon}.svg`,
				iconImageSize: this.iconImageSize,
				iconImageOffset: this.iconImageOffset
			});
		})
	}

	p.customBalloon = function () {
		this.customBalloonContentLayout = ymaps.templateLayoutFactory.createClass(
			'<div class="py-15 px-15"><div class="flex">' +
			'<div class="mr-20"><img src="local/templates/adel_redesign/images/svg/adel.svg" alt="" style="min-width: 30px;" width="30"></div>' +
			'<div>' +
			'<div class="fs-14 fw-medium fh-2">{{ properties.hintContent }}</div>' +
			'<div class="flex fs-12 fw-bold items-center">' +
			`<i class='circle-10 mr-10 bg-{{ properties.stockColor }}'></i>` +
			'{{ properties.stockText }}</div>' +
			'<div class="fs-12 cl-gray fw-medium">Остаток в аптеке: 8</div>' +
			'</div></div>' +
			'<div class="cl-gray fs-12 fw-medium fh-2 mt-10 pharm_address">{{ properties.location }}</div>' +
			'<div class="flex flex-wrap mt-20">' +
			'<div class="mr-40 mb-15">' +
			'<div class="fs-12 fw-bold fh-2 mb-5">График работы</div>' +
			'<ul class="fs-12 fw-medium cl-gray fh-5 pl-0 py-0 my-0">' +
			'{% for time in properties.workTime %}' +
			'<li>{{ time }}</li>' +
			'{% endfor %}' +
			'</ul>' +
			'</div>' +
			'<div class="mb-15">' +
			'<div class="fs-12 fw-bold fh-2 mb-5">Телефоны</div>' +
			'<ul class="fs-12 fw-medium cl-gray fh-5 pl-0 py-0 my-0">' +
			'{% for phone in properties.phones %}' +
			'<li>{{ phone }}</li>' +
			'{% endfor %}' +
			'</ul>' +
			'</div>' +
			'</div>' +
			`<div class="flex justify-center"><a href="#" data-ext-id='{{ properties.ext }}' data-bitrix-id={{ properties.bitrix }} class="btn btn-border-green">ЗАБРАТЬ ЗДЕСЬ</a></div></div>`
		);

		this.objectManager.objects.options.set({
			balloonContentLayout: this.customBalloonContentLayout
		});
	}

	p.initObjectsManager = function(){
		this.objectManager = new ymaps.ObjectManager({
			clusterize: true,
			geoObjectOpenBalloonOnClick: true,
			clusterOpenBalloonOnClick: false
		});
		this.mapObject.geoObjects.add(this.objectManager);
	}

	p.updateObjectManager = function (obj) {
		this.objectManager.add(obj)
	}

	p.fetchObj = async function () {
		const response = await fetch(this.json)
		this.objects = await response.json()
		this.listFilter(this.objects)
	}

	p.mapUpdate = function (obj) {
		if(!this.mapContainer.classList.contains('loaded')) return;
		this.objectManager.removeAll();
		this.updateObjectManager(obj)
	}

	p.addYamapsScript = function () {
		const self = this;
		this.init = false

		if (!self.mapContainer.classList.contains("js--loaded")) {
			self.mapContainer.classList.add("js--loaded");
		}

		if (!this.init) {
			if (typeof ymaps === "undefined") {
				let js = document.createElement('script');
				js.src = self.src;
				document.getElementsByTagName('head')[0].appendChild(js);
				js.onload = function() {
					self.initMap()
				};
			}
			this.init = true
		}
	}

	w.PMap = PMap;
})(window);