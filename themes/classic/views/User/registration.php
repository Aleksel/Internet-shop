<div id="content">
    <div id="content3">
        <div id="in1">Регистрация</div>
        <?php echo CHtml::beginForm(); ?>
        <?php echo CHtml::errorSummary($form); ?>
        <div class="in3">
            <span>E-mail</span>
            <?php echo CHtml::activeEmailField($form, 'email', $htmlOptions = array(
                    'size' => '65'
                    )); ?>
        </div>
        <div class="in3">
            <span>Пароль</span>
            <?php echo CHtml::activePasswordField($form, 'passwd', $htmlOptions = array(
                    'size' => '35'
                )); ?>
        </div>
        <div class="hint">Пароль должен содержать не менее 6 символов</div>
        <div class="in4">
            <span>Подтверждение пароля</span>
            <?php echo CHtml::activePasswordField($form, 'passwd2', $htmlOptions = array(
                    'size' => '35'
                 )); ?>
        </div>
        <div class="hint">Введите пароль еще раз</div>
        <div class="in4">
            <span>Имя</span>
            <?php echo CHtml::activeTextField($form, 'name', $htmlOptions = array(
                    'size' => '65'
                )); ?>
        </div>
        <div class="in9">
            <span>Фамилия</span>
            <?php echo CHtml::activeTextField($form, 'surname', $htmlOptions = array(
                    'size' => '65',
                    'class' => 'passw2'
                )); ?>
        </div><br>
        <div class="in4">
            <span>Ввидите код</span>
            <?php echo CHtml::activeTextField($form, 'verifyCode', $htmlOptions = array(
                    'size' => '10',
                    'class' => 'passw2'
                )); ?>
        </div>
        <div class="in4">
            <?php $this->widget('CCaptcha', array('buttonLabel' => '<span id="refresh"></span>', 'id' => 'img')); ?>
        </div>
        <?php echo CHtml::submitButton('Продолжить', $htmlOptions = array(
                'id' => 'send'
            )); ?>
        <?php echo CHtml::endForm(); ?>
        <div id="in5"><a href="/">Забыли пароль?</a></div>
        <div id="in6"><a href="/">Зарегистрироваться</a></div>
    </div>
</div>