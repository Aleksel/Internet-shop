<?php if (Yii::app()->user->hasFlash('reg_ok')){ ?>
    <?php echo '<meta http-equiv="refresh" content="5;URL= '.Yii::app()->user->returnUrl.'">'; ?>
    <div id="content">
        <div id="content3">
            <p id="reg_ok"><?php echo Yii::app()->user->getFlash('reg_ok'); ?></p>
        </div>
    </div>
<?php } else { ?>
    <div id="content">
        <div id="content3">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'enableAjaxValidation' => true,
        )); ?>
        <?php echo $form->errorSummary($model); ?>
        <table class="table-form">
            <tr>
            <td colspan="2">
                <span id="in1">Регистрация</span>
            </td>
            </tr>
            <tr>
            <td>
                <?php echo $form->label($model, 'email', array('class' => 'required')); ?>
            </td>
            <td>
                <?php echo $form->textField($model, 'email') ?>
                <?php echo $form->error($model, 'email'); ?>
            </td>
            </tr>
            <tr>
            <td>
                <?php echo $form->label($model, 'passwd'); ?>
            </td>
            <td>
                <?php echo $form->passwordField($model, 'passwd') ?>
                <?php echo $form->error($model, 'passwd'); ?>
            </td>
            </tr>
            <tr>
            <td>
                <?php echo $form->label($model, 'passwd2'); ?>
            </td>
            <td>
                <?php echo $form->passwordField($model, 'passwd2') ?>
                <?php echo $form->error($model, 'passwd2'); ?>
            </td>
            </tr>
            <tr>
            <td>
                <?php echo $form->label($model, 'name'); ?>
            </td>
            <td>
                <?php echo $form->textField($model, 'name') ?>
                <?php echo $form->error($model, 'name'); ?>
            </td>
            </tr>
            <tr>
            <td>
                <?php echo $form->label($model, 'surname'); ?>
            </td>
            <td>
                <?php echo $form->textField($model, 'surname') ?>
                <?php echo $form->error($model, 'surname'); ?>
            </td>
            </tr>
            <tr>
            <td>
                <span>Ввидите код</span>
            </td>
            <td>
                <?php echo CHtml::activeTextField($model, 'verifyCode', array(
                'size' => '10',
                'class' => 'passw2'
                )); ?>
                <?php echo $form->error($model, 'verifyCode'); ?>
            </td>
            </tr>
            <tr>
            <td colspan="2">
                <?php $this->widget('CCaptcha', array('buttonLabel' => '<span id="refresh"></span>', 'id' => 'img')); ?>
            </td>
            </tr>
            <tr>
            <td colspan="2">
                <?php echo CHtml::submitButton('Продолжить', $htmlOptions = array(
                'id' => 'send'
                )); ?>
            </td>
            </tr>
        </table>
        <?php $this->endWidget(); ?>
        </div>
    </div>
<?php } ?>