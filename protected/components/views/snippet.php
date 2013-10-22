<?php if (isset($snippet[0]['title'])): ?>
    <div id="content">
        <div id="content3">
            <div id="leftRowBottom">
                <a <?php if ($snippet[0]['url']) echo 'href="' . Yii::app()->request->baseUrl . $snippet[0]['url'] . '"'; ?>><h1><?php echo $snippet[0]['title']; ?></h1></a>
                <p><?php echo $snippet[0]['text']; ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>