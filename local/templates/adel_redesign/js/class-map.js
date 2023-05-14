/**
 * Карта объектов аптек
 */
(function(w){
	var PMap = function(center){
		this.src = 'https://api-maps.yandex.ru/2.1/?lang=ru_RU'
		this.center = center;

		this.main = document.querySelector('.s-pharmacy');
		this.mapContainer = this.main.querySelector('.p-map-frame');
		this.filterPharmacy = this.main.querySelectorAll('[data-pharmacy]');
		this.filterStock = this.main.querySelectorAll('[data-stock]');
		this.filterArea = this.main.querySelectorAll('[data-area]');
		this.showMap = this.main.querySelector('.js-map');
		this.search = this.main.querySelector('.input-search');
		this.list = this.main.querySelector('.pharmacy-ls');
		this.clear = this.main.querySelector('.js-clear');
		this.btnSel = this.main.querySelectorAll('.btn-select__btn');
		this.btnShowPhone = this.main.querySelectorAll('.js-show-phone');
		this.icons = ['adel', 'dleki'];
		this.iconImageSize = [30,30];
		this.iconImageOffset = [-15,-30];
		this.objects = places;
		this.filterPharmacyData = '';
		this.filterStockData = '';
		this.filterAreaData = '';
		this.newObjects = {};
		this.map = {};
		this.mapObject = {};

		this.listFilter(this.objects);
		this.addListeners();

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

	p.listHtml = function (item) {
		const icon = item.type
		const {...i} = item.properties

		this.works = [];
		for (const item of i.workTime) {
			this.works.push(`<li>${item}</li>`);
		}

		this.tooltip = '';
		if(i.tooltipText) {
			this.tooltip = '<button class="tooltip ml-10">' +
				`<div class="tooltip__modal"><p class="cl-${i.stockColor} fs-14 fw-bold">${i.tooltipStatus}</p>${i.tooltipText}</div>` +
				'</button>';
		}

		this.itemHtml = '<div class="flex border-bottom border-gray py-15 mb_py-10 items-center mb_px-20 item-pharmacy">' +
			'<div class="mb_flex-grow-1 w-330 mb_w-auto mb_pr-15">' +
			'<div class="flex items-center fs-16 fw-medium fh-2 pharm_name">' +
			`<img src="local/templates/adel_redesign/images/svg/${icon}.svg" alt="" class="mr-10">${i.hintContent}</div>` +
			`<div class="mt-5 cl-gray fs-14 fw-medium ml-25 mb_mb-5 mb_ml-0 pharm_address">${i.location}</div>` +
			'<a href="#" class="fs-14 fw-medium hidden mb_visible js-show-phone">Телефоны и график работы</a>' +
			'</div>' +
			'<div class="flex flex-grow-1 justify-center item-pharmacy__contact ">' +
			'<div class="flex items-center mb_mt-10 ds_flex-column mb_items-start">' +
			'<div class="relative btn-info mx-20 lp_mx-10 mb_mx-0 mb_pr-20">' +
			`<button class="btn-info__btn">${i.workTime[0]}</button>` +
			`<ul class="btn-info__list">${this.works.join('')}</ul></div>` +
			`<div class="relative btn-info mx-20 lp_mx-10 mb_mx-0 cl-black-3 opacity-5"><a class="cl-black-3" href="tel:${i.phones[0]}">${i.phones[0]}</a></div>` +
			'</div></div>' +
			'<div class="flex items-center lp_flex-column mb_items-end">' +
			`<div class="fs-16 fw-medium fh-2 min-w-250 ds_min-w-200 flex flex-row-rev items-center justify-end lp_mb-10 mb_fs-14 mb_min-w-none">${this.tooltip}` +
			`<div class="flex items-center item-pharmacy__stock"><i class="circle-19 mr-10 bg-${i.stockColor} mb_circle-13"></i>${i.stockText}</div></div>` +
			`<a href="#" data-ext-id=${i.ext} data-bitrix-id=${i.bitrix} class="btn btn-border-green-sm btn-border-green mb_hidden">ЗАБРАТЬ ЗДЕСЬ</a>` +
			`<a href="#" data-ext-id=${i.ext} data-bitrix-id=${i.bitrix} class="btn btn-border-green hidden mb_visible">Выбрать</a>` +
			'</div>' +
			'</div>';
		return this.itemHtml;
	}

	p.listArr = function (arr) {
		var self = this;
		this.list.innerHTML = '';
		if(arr.length > 0) {
			arr.forEach(item => {
				this.list.innerHTML += self.listHtml(item);
			});
		} else {
			this.list.innerHTML = '<div class="fs-16 fw-medium">Нет аптек для вашего населенного пункта. Измените город пожалуйста.</div>';
		}

	}

	p.listFilter = function (array) {
		this.listArr(array.features)
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

	p.filterBtnActive = function (el){
		$(el).addClass('is-active').siblings().removeClass('is-active')
	}

	p.mapUpdate = function (obj) {
		if(!this.mapContainer.classList.contains('loaded')) return;
		this.objectManager.removeAll();
		this.updateObjectManager(obj)
	}

	p.filter = function (){
		const filter = {
			type: this.filterPharmacyData,
			stock: this.filterStockData,
			area: this.filterAreaData
		}
		console.log(filter)
		this.newObjects.type = "FeatureCollection"
		this.newObjects.features = this.objects.features.filter(obj => {
			if (filter.type && filter.stock && filter.area) {
				// all
				return obj.type === filter.type && obj.stock === filter.stock && obj.area === filter.area
			} else if (filter.type && !filter.stock && !filter.area) {
				// type
				return obj.type === filter.type
			} else if (filter.type && filter.stock && !filter.area) {
				// type && stock
				return obj.type === filter.type && obj.stock === filter.stock
			} else if (filter.type && !filter.stock && filter.area) {
				// type && area
				return obj.type === filter.type && obj.area === filter.area
			} else if (!filter.type && filter.stock && !filter.area) {
				// stock
				return obj.stock === filter.stock
			} else if (!filter.type && filter.stock && filter.area) {
				// stock && area
				return obj.stock === filter.stock && obj.area === filter.area
			} else if (!filter.type && !filter.stock && filter.area) {
				// area
				return obj.area === filter.area
			} else if (!filter.type && !filter.stock && !filter.area) {
				// nothing
				return true
			}
		});
		this.listFilter(this.newObjects)
		this.mapUpdate(this.newObjects);
	}

	p.filterSearch = function (value) {
		this.newObjects.type = "FeatureCollection"
		this.newObjects.features = this.objects.features.filter(obj => {
			const {hintContent, location} = obj.properties
			const num = hintContent.toLowerCase()
			const loc = location.toLowerCase()

			if (num.indexOf(value) >= 0 || loc.indexOf(value) >= 0) {
				return true
			}
			return false
		})
		this.listFilter(this.newObjects)
		this.mapUpdate(this.newObjects);
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

	p.addListeners = function (){
		var self = this;

		this.filterPharmacy.forEach(item => {
			item.addEventListener('click', function () {
				if(!$(this).hasClass('is-active')){
					self.filterBtnActive(this)
					self.filterPharmacyData = this.dataset.pharmacy
				} else {
					$(this).removeClass('is-active')
					self.filterPharmacyData = ''
				}
				self.filter()
			})
		})

		this.filterStock.forEach(item => {
			item.addEventListener('click', function () {
				self.filterBtnActive(this)
				if (this.dataset.stock === 'all') {
					self.filterStockData = ''
				} else {
					self.filterStockData = this.dataset.stock
				}
				self.filter()
			})
		})

		this.filterArea.forEach(item => {
			item.addEventListener('click', function () {
				if(!$(this).hasClass('is-active')){
					self.filterBtnActive(this)
					self.filterAreaData = this.dataset.area
				} else {
					$(this).removeClass('is-active')
					self.filterAreaData = ''
				}
				self.filter()
			})
		})

		this.showMap.addEventListener('click', function (e) {
			e.preventDefault();

			if(!$(this).hasClass('is-active')){
				$('.pharmacy-map').show();
				$('.pharmacy-ls').hide();
				$(this).addClass('is-active')

				if(self.mapContainer.classList.contains('loaded')) return;

				self.addYamapsScript();

			} else {
				$('.pharmacy-map').hide();
				$('.pharmacy-ls').show();
				$(this).removeClass('is-active');
			}

		})

		this.search.addEventListener('input', function () {
			const value = $(this).val().toLowerCase();
			self.filterSearch(value)
		})

		this.clear.addEventListener('click', function () {
			self.listFilter(self.objects)
			self.mapUpdate(self.objects)
			$('.btn-tab').removeClass('is-active')
		})

		this.btnSel.forEach(item => {
			item.addEventListener('click', function () {
				this.classList.toggle('is-active')
			})
		})

		window.onclick = function(event) {
			if (!event.target.matches('.btn-select__btn')) {
				$('.btn-select__btn').removeClass('is-active')
			}
		}

	}

	w.PMap = PMap;
})(window);