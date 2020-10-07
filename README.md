# Анкетирование

Это реализация тестового задания, которое я выполнял при первом устройстве на работу в студию веб-программистом.  
В 2016 я выполнял его без какого либо опыта. Просто вооружившись гуглом.  
Справедливости ради нужно сказать, что на тот момент у меня за плечами было 10 лет эникейства, но ни с одним ЯП я ни разу не сталкивался.  
Знать не знал о stackoverflow, и думал что Java и JavaScript это примерно одно и тоже.   
Так я его и делал без JS...  

Я выполнил его как смог, поколупавшись неделю.   
Меня взяли на обучение, отметив, что для уровня абсолютного нуля исполнение неплохое.  
Ту реализацию я сохранил. Иногда заглядываю, посмеиваюсь. Добавлю ссылку на репо когда доделаю этот вариант.  

Прошло 3.5 года. Я стал ведущим программистом той студии.  
Мне пришлось проводить собеседования и проверять исполнение этого же тестового задания. Оценивать код других программистов.  
И каково же было мое удивление когда люди с опытом, программисты работавшие в студиях и на фрилансе уже не по одному году 
присылали на проверку работы немногим лучше, чем те, что я написал с нулевым опытом.

Когда это произошло несколько раз к ряду я задумался. "А чему же я научился за 4 года? Что я могу?".  
И решил снова выполнить это же задание. С применением всего опыта и знаний накопленных за это время.  

Одно из основных требований задания - не использовать готовые фреймворки и библиотеки. Ни в php, ни в JS.  
Поэтому здесь не используется ни composer, ни yarn.  
Да, некоторые вещи скопированы с мануалов, как функция для реализации автозагрузки по PSR-4.  
Или идея фасадов взята из пакета Illuminate. Идея и немного кода :)  
Но никакой бездумной копипасты здесь нет.  

Задание состоит в том, чтобы сделать сайт, на котором пользователь может заполнить условную "анкету" с определенным набором полей,
а некоторый условный "админ" может просмотреть список заполненных "анкет". С фильтрацией, сортировкой и пагинацией.  
Таким образом исследуются навыки работы с html-формами, загрузкой файлов на сервер, обработки и валидации входящих данных, 
взаимодействия с базой данных и множество других общих аспектов программирования.  

В этот раз я решил посмотреть на "анкету" как на профиль пользователя.  
На "заполнение" как на регистрацию.  
На "список" как на часть панели администрирования.  
Название, как дань памяти, я решил оставить "Анкетирование" :)  
Посмотрим, что из этого выйдет.  
