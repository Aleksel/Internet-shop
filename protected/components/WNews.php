<?php

class WNews extends CWidget {

    function run() {

	$news = News::model()->findAll(array(
	    'order' => 'data DESC',
	));

	//TODO aleksel сделать сохранение в двух полях б.д. подробнее в книге рецептов стр.170
	//Получаем кол-во новостей выводимых на главной странице
	$kol_news_on_main = Settings::model()->findAllByAttributes(array('setting_name' => 'kol_news_on_main'));
	$kol_news_on_main = $kol_news_on_main[0]['param'];

	//Проверяем если в базе новостей меньше чем задано для вывода выводим то кол-во которое в базе
	if (count($news) < $kol_news_on_main)
	    $kol_news_on_main = count($news);

	//Получаем максимальное кол-во символов новостей выводимых на главной странице
	$count_char_in_news = Settings::model()->findAllByAttributes(array('setting_name' => 'count_char_in_news'));
	$count_char_in_news = $count_char_in_news[0]['param'] - 20;

	$this->render('news', array(
	    'news' => $news,
	    'kol_news' => $kol_news_on_main,
	    'count_char' => $count_char_in_news
	));
    }

}

