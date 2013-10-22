<?php if (Yii::app()->user->hasFlash('login_yet')){ ?>
    <?php echo '<meta http-equiv="refresh" content="5;URL= '.Yii::app()->user->returnUrl.'">'; ?>
    <div id="content">
        <div id="content3">
            <p id="reg_ok"><?php echo Yii::app()->user->getFlash('login_yet'); ?></p>
        </div>
    </div>
<?php } else { ?>
    <div id="content">
        <div id="content3">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'auth-form',
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
            </td>
            </tr>
            <tr>
            <td>
                <?php echo $form->label($model, 'passwd'); ?>
            </td>
            <td>
                <?php echo $form->passwordField($model, 'passwd') ?>
            </td>
            </tr>
            <tr>
            <td colspan="2">
                <?php echo CHtml::submitButton('Продолжить', $htmlOptions = array(
                'id' => 'send'
                )); ?>
            </td>
            </tr>
            <tr>
            <td colspan="2">
                <span id="in5"><a href="/">Забыли пароль?</a></span>
            </td>
            </tr>
            <tr id="last-tr">
            <td colspan="2">
                <span id="in6"><a href="<?php echo Yii::app()->createUrl('user/registration'); ?>">Зарегистрироваться</a></span>
            </td>
            </tr>
        </table>
        <?php $this->endWidget(); ?>
        </div>
    </div>
<?php } ?>