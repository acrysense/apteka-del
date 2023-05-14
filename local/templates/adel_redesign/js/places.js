const places = {
  "type": "FeatureCollection",
  "features": [
    {
      "type": "adel",
      "stock": "in-stock",
      "area": "partisan",
      "id": 0,
      "geometry": {
        "type": "Point",
        "coordinates": [55.744608, 37.620950]
      },
      "properties": {
        "hintContent": "Аптека №5",
        "location": "ул. Шпилевского, 57, пом. 11Н",
        "stockText": "Все в наличии",
        "stockColor": "green",
        "workTime": ["Понедельник: 09:00 - 20:00", "Вторник: 09:00 - 20:00", "Среда: 09:00 - 20:00", "Четверг: 09:00 - 20:00", "Пятница: 09:00 - 20:00", "Суббота: 09:00-18:00", "Воскресенье: выходной"],
        "phones": ["+375 (17) 209-12-12", "+357 (29) 809-32-33"],
        "ext": "0",
        "bitrix": "0",
        "tooltipStatus": "В наличии",
        "tooltipText": "<p>Аква марис (система 30 пакетов-саше с морской солью ) Jadran Galenski Laboratorij D. D.</p><p>БАНЕОЦИН (пор. д наружного прим. в полиэтиленовых банках с полиэтиленовым дозатором 10г №1) Pharmazeutische Fabrik Montavit GmbH-Австрия</p>",
      },
      "options": {"preset": "icon#adel"}
    },
    {
      "type": "dleki",
      "stock": "partial",
      "area": "partisan",
      "id": 1,
      "geometry": {
        "type": "Point",
        "coordinates": [55.766062, 37.623031]
      },
      "properties": {
        "hintContent": "Аптека №8",
        "location": "ул. Матусевича, 90, пом. 5Н; напротив Колледж бизнеса и права",
        "stockText": "В наличии 3 из 4",
        "stockColor": "yellow",
        "workTime": ["Понедельник: 09:00 - 20:00", "Вторник: 09:00 - 20:00", "Среда: 09:00 - 20:00", "Четверг: 09:00 - 20:00", "Пятница: 09:00 - 20:00", "Суббота: 09:00-18:00", "Воскресенье: выходной"],
        "phones": ["+375 (17) 209-12-12", "+357 (29) 809-32-33"],
        "ext": "1",
        "bitrix": "1"
      },
      "options": {"preset": "icon#dleki"}
    },
    {
      "type": "dleki",
      "stock": "in-stock",
      "area": "pervomaisk",
      "id": 2,
      "geometry": {
        "type": "Point",
        "coordinates": [55.763669, 37.697637]
      },
      "properties": {
        "hintContent": "Аптека №12",
        "location": "пр. Партизанский, 37-1н; маг. Домашний",
        "stockText": "Все в наличии",
        "stockColor": "green",
        "workTime": ["Понедельник: 09:00 - 20:00", "Вторник: 09:00 - 20:00", "Среда: 09:00 - 20:00", "Четверг: 09:00 - 20:00", "Пятница: 09:00 - 20:00", "Суббота: 09:00-18:00", "Воскресенье: выходной"],
        "phones": ["+375 (17) 209-12-12", "+357 (29) 809-32-33"],
        "ext": "2",
        "bitrix": "2"
      },
      "options": {"preset": "icon#dleki"}
    },
    {
      "type": "dleki",
      "stock": "on-order",
      "area": "frunzensky",
      "id": 3,
      "geometry": {
        "type": "Point",
        "coordinates": [55.725252, 37.614430]
      },
      "properties": {
        "hintContent": "Аптека №2",
        "location": "пр. Независимости, 168, корп.2, пом. 1Н; ст. м. Уручье",
        "stockText": "Под заказ",
        "stockColor": "gray",
        "workTime": ["Понедельник: 09:00 - 20:00", "Вторник: 09:00 - 20:00", "Среда: 09:00 - 20:00", "Четверг: 09:00 - 20:00", "Пятница: 09:00 - 20:00", "Суббота: 09:00-18:00", "Воскресенье: выходной"],
        "phones": ["+375 (17) 209-12-12", "+357 (29) 809-32-33"],
        "ext": "3",
        "bitrix": "3"
      },
      "options": {"preset": "icon#dleki"}
    },
    {
      "type": "adel",
      "stock": "on-order",
      "area": "frunzensky",
      "id": 4,
      "geometry": {
        "type": "Point",
        "coordinates": [55.771014, 37.486511]
      },
      "properties": {
        "hintContent": "Аптека №18",
        "location": "ул. Бакинская, 20; ост. Воронянского",
        "stockText": "Под заказ",
        "stockColor": "gray",
        "workTime": ["Понедельник: 09:00 - 20:00", "Вторник: 09:00 - 20:00", "Среда: 09:00 - 20:00", "Четверг: 09:00 - 20:00", "Пятница: 09:00 - 20:00", "Суббота: 09:00-18:00", "Воскресенье: выходной"],
        "phones": ["+375 (17) 209-12-12", "+357 (29) 809-32-33"],
        "ext": "4",
        "bitrix": "4"
      },
      "options": {"preset": "icon#adel"}
    },
    // {
    //   "type": "adel",
    //   "stock": "partial",
    //   "id": 5,
    //   "geometry": {
    //     "type": "Point",
    //     "coordinates": [55.720405, 37.692603]
    //   },
    //   "properties": {
    //     "hintContent": "Аптека №20",
    //     "location": "ул. Мирошниченко, 3-10; маг. Виталюр",
    //     "stockText": "В наличии 3 из 4",
    //     "stockColor": "yellow",
    //     "workTime": ["Понедельник: 09:00 - 20:00", "Вторник: 09:00 - 20:00", "Среда: 09:00 - 20:00", "Четверг: 09:00 - 20:00", "Пятница: 09:00 - 20:00", "Суббота: 09:00-18:00", "Воскресенье: выходной"],
    //     "phones": ["+375 (17) 209-12-12", "+357 (29) 809-32-33"],
    //     "ext": "5",
    //     "bitrix": "5"
    //   },
    //   "options": {"preset": "icon#adel"}
    // }
  ]
}