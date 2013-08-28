<?= Form::open( array('url' => 'giris', 'class' => 'well'))."\n" ?>
	<fieldset>
		<legend style="font-size: 14px; font-weight: bold">Kullanıcı Girişi</legend>
		<?= Notification::container('login')->showAll() //NOTIFICATION_SPAN) ?>
		<p>
			<?= Form::text('email', Input::old('email'), array('autofocus' => 'autofocus', 'placeholder' => 'E-posta', 'class' => 'input-small', 'required' => 'required'))."\n" ?>
			<br>
			<?= Form::password('password', array('placeholder' => 'Şifre', 'class' => 'input-small', 'required' => 'required'))."\n" ?>
		</p>
		<p>
			<?= Form::submit('Giriş', array('name' => 'login_sbmt', 'class' => 'btn btn-primary'))."\n" ?>
			&nbsp;
			<?= link_to('kayit', 'Kaydol')."\n" ?>
		</p>
		<p>
			<?= ''//link_to_route('auth.reset-password', 'Şifremi unuttum!')."\n" ?>
		</p>
	</fieldset>
<?= Form::close()."\n" ?>