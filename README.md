# Test_Sotbi
Тестовое задание:
Вывод списка объектов через Яндекс.Карты

Файл create.php в корневой директории, создающий:
  1) тип инфоблока, 
  2) инфоблок, со следующими полями:
        ● Название объекта (Назавние элемента)
        ● Телефон (Свойство)
        ● Email (Свойство)
        ● Координаты (Свойство)
        ● Город (Свойство)
   3) 6 элементов со случайными координатами в диапазоне (по широте 50-60, по долготе 30-40). 

Страница /ymaps/index.php содержит компонет.

Шаблон компонента содержит список объектов и карту. 
  При нажатии нажатии на объект карта перемещается на точку. 
  Нажатие точки на карте открывает окно с названием, номером и почтой.

За отсутствием макета оформлял минимально.

Использовал API YandexMaps JS 2.1 
 Более позднии версии требуют ключ, а страница создания ключа 404.
 
