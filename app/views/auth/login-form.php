<?php /* TODO: implement Ardent, also for small-login-form */ ?>
<div class="row">
<?= Form::open( array('url' => 'giris', 'class' => 'well span4 offset4'))."\n" ?>
	<fieldset>
		<legend style="font-size: 14px; font-weight: bold">E-posta adresinizi ve şifrenizi yazınız</legend>
		<?= Notification::container('login')->showAll() //NOTIFICATION_SPAN) ?>
		<p>
			<?= Form::text('email', Input::old('email'), array('autofocus' => 'autofocus', 'placeholder' => 'E-posta', 'required' => 'required'))."\n" ?>
			<br>
			<?= Form::password('password', array('placeholder' => 'Şifre', 'required' => 'required'))."\n" ?>
		</p>
		<p>
			<?= Form::submit('     Giriş     ', array('name' => 'login_sbmt', 'class' => 'btn btn-primary'))."\n" ?>
			&nbsp;
			<?= link_to('kayit', 'Kaydol')."\n" ?>
		</p>
		<p>
			<?= link_to('sifre-sifirla', 'Şifremi unuttum!')."\n" ?>
		</p>
	</fieldset>
<?= Form::close()."\n" ?>
</div>