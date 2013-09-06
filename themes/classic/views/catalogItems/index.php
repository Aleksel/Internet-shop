<?php if (count($items)) : ?>
    <div class="nav_top">
        <div class="l">Сортировать по:
	    <?php echo $sort->link('title', 'названию<span></span>') ?>
	    <?php echo $sort->link('prise', 'цене<span></span>') ?>
    	<a class="desc" href="/">отзывам<span></span></a>
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
    ));
    ?>
    <!--
    <div class="item">
        <div class="item_img">
        <a href="/item.html"><img src="/themes/classic/pic/item/cage1.png" height="120" width="140"></a>
        </div>
        <div class="item_right">
        <div class="item_prise">3520 руб.</div>
        <img title="21 оценка" src="/themes/classic/pic/star/4.png" height="20" width="90"><span>21</span>
        <div class="button">
        <input type="button" value="добавить в корзину" />
        </div>
        </div>
        <div class="item_title"><a href="/item.html">Металлическая клетка для содержания  и перевозки. SAVIC DOG RESIDENCE 107</a></div>
        <div class="item_charact">материал: хром; размер: 107 x 71 x 81 cm</div>
        <div class="item_comp"><label><input type="checkbox" value="123" /> добавить к сравнению<label></div>
        </div>
          <div class="item">
        <div class="item_img">
        <a href="/"><img src="/themes/classic/pic/item/cage2.png" height="120" width="140"></a>
        </div>
        <div class="item_right">
        <div class="item_prise">5431 руб.</div>
        <img title="14 оценок" src="/themes/classic/pic/star/4-5.png" height="20" width="90"><span>14</span>
        <div class="button">
        <input type="button" value="добавить в корзину" />
        </div>
        </div>
        <div class="item_title"><a href="/">Металлическая клетка для содержания  и перевозки. SAVIC DOG RESIDENCE 108</a></div>
        <div class="item_charact">материал: хром; размер: 147 x 95 x 94 cm</div>
        <div class="comp"><label><input type="checkbox" value="123" /> добавить к сравнению<label></div>
        </div>
     <div class="item">
        <div class="item_img">
        <a href="/"><img src="/themes/classic/pic/item/cage3.png" height="120" width="140"></a>
        </div>
        <div class="item_right">
        <div class="item_prise">119855 руб.</div>
        <img title="74 оценки" src="/themes/classic/pic/star/3-5.png" height="20" width="90"><span>74</span>
        <div class="button">
        <input type="button" value="добавить в корзину" />
        </div>
        </div>
        <div class="item_title"><a href="/">Металлическая клетка для содержания  и перевозки. SAVIC DOG RESIDENCE 109</a></div>
        <div class="item_charact">материал: хром; размер: 169 x 101 x 99 cm</div>
        <div class="comp"><label><input type="checkbox" value="123" /> добавить к сравнению<label></div>
    	</div>
    -->










    <?php foreach ($items as $item) : ?>



	<div class="item">
	    <div class="item_img">
		<a href="/"><img src="<?php echo Yii::app()->request->baseUrl . $item->urlpic; ?>" height="120" width="140"></a>
	    </div>
	    <div class="item_right">
		<div class="item_prise"><?php echo $item->prise; ?> руб.</div>
		<img title="14 оценок" src="/themes/classic/pic/star/4-5.png" height="20" width="90"><span>14</span>
		<div class="button">
		    <input type="button" value="добавить в корзину" />
		</div>
	    </div>
	    <div class="item_title"><a href="/"><?php echo $item->title; ?></a></div>
	    <div class="item_charact"><?php echo $item->features; ?></div>
	    <div class="comp"><label><input type="checkbox" value="123" /> добавить к сравнению<label></div>
			</div>

		    <?php endforeach; ?>





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
		    ));
		    ?>
    		<hr />
    		<div class="nav_top">
    		    <div class="l">Сортировать по:
			    <?php echo $sort->link('title', 'названию<span></span>') ?>
			    <?php echo $sort->link('prise', 'цене<span></span>') ?>
    			<a class="desc" href="/">отзывам<span></span></a>
    		    </div>
    		    <div class="comper"><a class="desc" href="/">сравнить</a></div>
    		</div>
		<?php endif; ?>