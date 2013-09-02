jQuery(function ($) {
	/*  Настройки Слайдера: */
	var mainConfig = new Array();
	/* Для каждого слайдера (div-а с классом slider-wrap) необходимо создать новый элемент
	   массива mainConfig[X], где X - порядковый номер слайдера на странице (по коду,
	   начиная с нуля).
	   Если элементов массива больше чем слайдеров, скрипт работает исправно, ошибок не возникает.
	   По умолчанию уже создано 5 элементов (для 5 слайдеров).
	*/
	 mainConfig[0] = {
		hwSlideSpeed: 1000, // Скорость анимации смены слайда.
		hwTimeOut: 4000, // Задержка автоматической прокрутки.
		hwNeedLinks: false, // true - если нужны ссылки вперёд-назад, false - если не нужны.
		hwNeedBullets: true, // true - если нужны кнопки перехода на каждый слайд, иначе - false
		hwAutoRotate: true // true - автоматическая прокрутка включена, false - выключена.
	};
	var activeSlide = new Array();
	var slideCount = new Array();
	// timerid = new Array();
	//var neddRotatr = new Array();
	var slideTime = 0;
		
	/* Для каждого .slider-wrap  */
	$('.slider-wrap').each(function(index) {
		var mainThis = $(this)
		slideCount[index] = $(".slide", mainThis).size();
		activeSlide[index] = 0;
		$('.slide', mainThis)
			.css({"position" : "absolute", "top":'0', "left": '0'})
			.hide()
			.eq(0)
			.show();
		 
		/* Добавляем ссылки Назад - Вперёд, если они нужны */
		if(mainConfig[index].hwNeedLinks){
			var linkArrow = '<a class="prewbutton" href="#"></a><a class="nextbutton" href="#"></a>';   
			$('.slider', mainThis).prepend(linkArrow);
		};
		 
		/* Добавляем ссылки на слайды (буллеты), если они нужны */
		if(mainConfig[index].hwNeedBullets){
		var $adderDiv = '';
			$('.slide', mainThis).each(function(num) {
				$adderDiv += '<div class = "control-slide">' + num + '</div>';
			});
			$(mainThis).append('<div class = "podl_ban">' + $adderDiv +'</div>');
			$(".control-slide:first", mainThis).addClass("control-slide_now"); 
		};
		
		//Определяем позицию и ширину подложки буллетов в зависимости от количества слайдов
		var width = slideCount[index]*20;
		var pos = 690-slideCount[index]*20;
		var controlSlide=controlSlide+=22;
		$('.podl_ban').css({
			'width': width,
			'left': pos,
			'display': 'block',
		});
		 
		/* Обработчики ссылок */
		$('.nextbutton', mainThis).click(function(){
			clearTimeout(slideTime);
			animSlide(index, "next");
			return false;
		});
		$('.prewbutton', mainThis).click(function(){
			clearTimeout(slideTime);
			animSlide(index, "prew");
			return false;
		});
		$('.control-slide', mainThis).click(function(){
			clearTimeout(slideTime);
			var goToNum = parseFloat($(this).text());
			animSlide(index, goToNum);
		}); 
		
		//Включаем автоматическую прокрутку, если она нужна
		if(mainConfig[index].hwAutoRotate)
			slideTime = setTimeout(function(){animSlide(index, 'next')}, mainConfig[index].hwTimeOut);
	});
	/* Для каждого .slider-wrap - конец */
			 
		/* Функция прокрутки */
		var animSlide = function(id, arrow){
			clearTimeout(slideTime);
			var $containerNum = $('.slider-wrap').eq(id).find(".slide");
			var activeVar = activeSlide[id];
			var countVar = slideCount[id];
			/* Запускаем анимацию только если выбран другой слайд (не показывающийся в данный момент). */
			if(activeVar != arrow){ 
				$containerNum.eq(activeVar).show().css('z-index','5');
				//Скрываем текущий слайд
				$containerNum.eq(activeVar).fadeOut(mainConfig[id].hwSlideSpeed);
				$('.slider-wrap').eq(id).find(".control-slide").eq(activeVar).removeClass("control-slide_now");
				if(arrow == "next"){
						if(activeVar == (countVar-1)){activeVar=0;}
						else{activeVar++}
				}
				else if(arrow == "prew"){
						if(activeVar == 0){activeVar=countVar-1;}   
						else{activeVar-=1}
				}
				else{
						activeVar = arrow;
				};
				//Показываем следующий слайд
				$containerNum.eq(activeVar).fadeIn(mainConfig[id].hwSlideSpeed, function(){
					if(mainConfig[id].hwAutoRotate) slideTime = setTimeout(function(){
						animSlide(id, 'next')}, mainConfig[id].hwTimeOut);
					});
				}
				//Изменяем носер активного слайда
				activeSlide[id] = activeVar;
				$('.slider-wrap').eq(id).find(".control-slide").eq(activeVar).addClass("control-slide_now");
			};
			/* Функция прокрутки - Конец */
});