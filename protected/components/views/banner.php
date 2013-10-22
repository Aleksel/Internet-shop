<?php foreach ($banners as $banner): ?>
    <div class="slide" >
        <img src="<?php echo Yii::app()->request->baseUrl . $banner['url']; ?>" />
    </div>
<?php endforeach; ?>
