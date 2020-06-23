<?php if($auth == 1) : ?>
	 <a href="<?=SITE_URL?>/add/logout=1">Выйти</a>
<?php endif;?>

	<div class="add">
		<?php if (!empty($errors)) : ?>
			<?php foreach ($errors as $error) : ?>
				<div class="alert alert-danger" role="alert">
					<?=$error?>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php if (!empty($messages)) : ?>
			<?php foreach ($messages as $message) : ?>
				<div class="alert alert-success" role="alert">
					<?=$message?>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
		<form method="post" enctype="multipart/form-data" class="auth-form">
			<h1>Авторизация</h1>
			<input type="hidden" name="action" value="authUser">
			<div class="input-group">
				<label for="email">
					E-mail:
				</label>
				<input required type="text" name="email" value="<?= $_POST['email'] ?>">
			</div>
			<div class="input-group">
				<label for="password">
					Пароль:
				</label>
				<input required type="text" name="password" value="<?= $_POST['password'] ?>">
			</div>
			<div id="captcha" class="g-recaptcha hidden" data-sitekey="<?=SITEKEY?>"></div>
			<input type="submit" value="Войти" class="btn btn-success btn-continue">
			<span>Или</span>
			<a href="#" class="btn-outline-primary btn btn-register">Регистрация</a>

		</form>
		<div class="register-block">
			<form method="post" enctype="multipart/form-data" class="register-form">
				<h1>Регистрация</h1>
				<input type="hidden" name="action" value="registerUser">
				<div class="input-group">
					<label for="login">
						Login:
					</label>
					<input required type="text" name="login" value="<?= $_POST['login'] ?>">
					<p class="input-group__text">Только латинский буквы и цифры</p>
				</div>

				<div class="input-group">
					<label for="email">
						E-mail:
					</label>
					<input required type="email" name="email" value="<?= $_POST['email'] ?>">
				</div>

				<div class="input-group">
					<label for="password">
						Пароль:
					</label>
					<input required type="text" name="password" value="<?= $_POST['password'] ?>">
					<p class="input-group__text">И цифры и буквы</p>
				</div>
				<div class="input-group">
					<label for="repassword">
						Пароль ещё раз:
					</label>
					<input required type="text" name="repassword" value="<?= $_POST['repassword'] ?>">
					<p class="input-group__text"></p>
				</div>
				<input type="submit" value="Зарегистрироватся" class="btn btn-success">
				<span>Или</span>
				<a href="#" class="btn btn-outline-secondary btn-auth">Войти</a>


			</form>
		</div>


	</div>

