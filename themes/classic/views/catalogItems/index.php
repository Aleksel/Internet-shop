<?php $this->pageTitle = 'ddd'; if (count($items)) : ?>
    <div class="nav_top">
        <div class="l">Сортировать по:
	    <?php echo $sort->link('title', 'названию<span></span>') ?>
	    <?php echo $sort->link('prise', 'цене<span></span>') ?>
	    <?php echo $sort->link('avg_review', 'отзывам<span></span>') ?>
        </div>
        <div class="comper"><a class="desc" href="/">сравнить</a></div>
    </div>
    <hr />
    <span  class="pageTitler"></span>
    <?php
	$this->widget('CLinkPager', array(
	    'header' => 'Страница:', // пейджер без заголовка
	    'cssFile' => '',
	    'firstPageLabel' => '',
	    'prevPageLabel' => '',
	    'nextPageLabel' => '',
	    'lastPageLabel' => '',
	    'pages' => $pages, // модель пагинации переданная во View
	)); ?>
    <?php foreach ($items as $item) : ?>
	<div class = "item">
	    <div class = "item_img">
		<a href = "/">
		    <img src = "<?php if (file_exists(substr($item->urlpic, 1, strlen($item->urlpic))))
			    echo Yii::app()->request->baseUrl . $item->urlpic;
			else
			    echo Yii::app()->request->baseUrl . '/themes/classic/pic/item/noImage.png';
			?>" height = "120" width = "140">
		</a>
	    </div>
	    <div class = "item_right">
		<div class = "item_prise"><?php echo $item->prise; ?> руб.</div>
		<img src="/themes/classic/pic/star/<?php if ($item['avg_review'])
		    echo $item['avg_review'];
		else
		    echo 0; ?>.png" height="20" width="90"><span>
		<?php if ($item['count_review'])
		    echo $item['count_review'];
		else
		     echo 0; ?></span>
		<div class="button">
		    <input type="button" value="добавить в корзину" />
		</div>
	    </div>
	    <div class="item_title">
		<a href="/"><?php echo $item->title; ?></a>
	    </div>
	    <div class="item_charact"><?php echo $item->features; ?></div>
	    <div class="comp"><label><input type="checkbox" value="123" /> добавить к сравнению<label></div>
	</div>
    <?php endforeach; ?>
    <span  class="pageTitler"></span>
    <?php $this->widget('CLinkPager', array(
			'header' => 'Страница:', // пейджер без заголовка
			'cssFile' => '',
			'firstPageLabel' => '',
			'prevPageLabel' => '',
			'nextPageLabel' => '',
			'lastPageLabel' => '',
			'pages' => $pages, // модель пагинации переданная во View
	    )); ?>
    <hr />
    <div class="nav_top">
	<div class="l">Сортировать по:
	    <?php echo $sort->link('title', 'названию<span></span>') ?>
	    <?php echo $sort->link('prise', 'цене<span></span>') ?>
	    <?php echo $sort->link('avg_review', 'отзывам<span></span>') ?>
    	</div>
    <div class="comper"><a class="desc" href="/">сравнить</a></div>
    </div>
<?php endif; ?>