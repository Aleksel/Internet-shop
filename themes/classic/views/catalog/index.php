<?php foreach ($items as $item): ?>
    <div class = "catalog">
        <a href = "<?php echo Yii::app()->request->baseUrl . $item[url]; ?>">
    	<img src = "<?php echo Yii::app()->request->baseUrl . $item[urlPic]; ?>" height = "134" width = "134">
        </a>
        <div>
    	<a href = "<?php echo Yii::app()->request->baseUrl . $item[url]; ?>"><?php echo $item[title]; ?></a>
        </div>
    </div>
<?php endforeach; ?>