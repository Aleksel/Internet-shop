<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>
<div id="content3">
	<h2>Error <?php echo $code; ?></h2>

	<div class="error_pages">
			<?php echo CHtml::encode($message); ?>
	</div>
</div>
