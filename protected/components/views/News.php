<div id="news1">
    <?php for ($i = 0; $i < $kol_news; $i++): ?>
    <h3><?php echo $news[$i]['title']; ?></h3>
        <p>
            <?php 
                    if (strlen($news[$i]['news'])>$count_char[0]['param']) 
                        echo (strip_tags(substr($news[$i]['news'],0,(strpos($news[$i]['news'], ' ',$count_char))).'...')); 
                    else 
                        echo (strip_tags(substr($news[$i]['news'],0)).'...');
                    ?>
        </p>
        <h4><?php echo '['.date('d.m.Y',$news[$i]['data']).']'; ?></h4>
        <a href="<?php echo Yii::app()->request->baseUrl.$news[$i]['url']; ?>"><span>читать далее</span></a>
    <?php endfor; ?>
</div>
