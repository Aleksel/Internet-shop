<div id="content">
    <div id="content3">
        <div id="in1">Вход</div>
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
                        'size' => '65'
                     )); ?>
            </div>
        <?php echo CHtml::submitButton('Продолжить', $htmlOptions = array(
                'id' => 'send'
            )); ?>
        <?php echo CHtml::endForm(); ?>
        <div id="in5"><a href="/">Забыли пароль?</a></div>
        <div id="in6"><a href="/">Зарегистрироваться</a></div>
    </div>
</div>