<!DOCTYPE html>
<html>
    <head>
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/classic/css/common.css" rel="stylesheet" type="text/css" />
        <meta charset="utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>
        <div id="main">
            <div id="header">
                <div id="logo"><a href="/" title="На главную страницу"><span>Побалуйте вашего любимца</span></a></div>
                <div id="entrance">
		    <?php if (Yii::app()->user->id): ?>
			<a id="enter" href="<?php echo Yii::app()->request->baseUrl; ?>/user/settings"><?php echo Yii::app()->user->getName(); ?></a>
			<a id="registration" href="<?php echo Yii::app()->request->baseUrl; ?>/user/logout">Выход</a>
		    <?php else: ?>
			<a id="enter" href="<?php echo Yii::app()->request->baseUrl; ?>/user/login">Вход для пользователей</a>
			<a id="registration" href="<?php echo Yii::app()->request->baseUrl; ?>/user/registration">Регистрация</a>
		    <?php endif; ?>
                </div>
                <form action="#">
                    <div id="search">
                        <input type="text" size="30" id="shearchmain" name="shearch_main" onfocus="if ('Поиск' === this.value)
				    this.value = '';" onblur="if ('' === this.value)
				    this.value = 'Поиск';" value="Поиск">
                        <input type="submit" id="submit" value="" />
                    </div>
                </form>
                <div id="menuGor">
		    <?php
		    $this->widget('zii.widgets.CMenu', array(
			'items' => array(
			    array('label' => 'Главная', 'url' => '/'),
			    array('label' => 'О магазине', 'url' => array('/site/page', 'view' => 'about')),
			    array('label' => 'Условия доставки', 'url' => array('/site/contact')),
			    array('label' => 'Акции', 'url' => array('/site/login')),
			    array('label' => 'Связаться с нами', 'url' => array('/site/logout'))
			),
			'id' => 'menuGorUl',
		    ));
		    ?>
                </div>
                <div id="basket">
                    <div id="iconBasket"></div>
                    <div id="textBasket">
                        <div id="basketCount">Корзина: 0 товаров</div>
                        <div id="goToBasket"><a href="/cart.html">Перейти в корзину</a></div>
                    </div>
                </div>
            </div>
            <div id="contener3">
                <div id="news">
                    <div id="menuVer">
			<?php $this->widget('MainMenu'); ?>
                    </div>
                    <a href="/"><div id="newsTitle"><span>Новости:</span></div></a>
		    <?php $this->widget('application.components.WNews'); ?>
                </div>
		<?php echo $content; ?>
		<?php $this->widget('application.components.Snippet'); ?>
                <div id="footer">
                    <div id="menuCont">
                        <ul id="menuGorFoot">
                            <li><a href="#"><span>Главная</span></a></li>
                            <li><a href="#"><span>О магазине</span></a></li>
                            <li><a href="#"><span>Условия доставки</span></a></li>
                            <li><a href="#"><span>Акции</span></a></li>
                            <li><a href="#"><span>Связаться с нами</span></a></li>
                        </ul>
                    </div>
                    <div id="copyright">Copyright © 2013 Интернет магазин Pet-Like.ru - товары для животных</div>
                </div>
            </div>
        </div>
    </body>
</html>