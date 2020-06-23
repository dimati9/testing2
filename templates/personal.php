<?php if($auth) : ?>
	<script src="scripts/personal.js" defer></script>
<div class="content">
	<h1>Здравствуйте <?=$userData['login']?> - это ваша адресная книга</h1>
	<a href="<?=SITE_URL?>?out">Выйти</a>
	<div class="buttons">
		<button class="add_new">Добавить новую запись</button>
		<form>
			<label for="search">Поиск: </label>
			<input type="text" class="search-text" placeholder="Николай / 88005553535">
			<button type="submit" class="search">Поиск</button>
			<button class="clear-search">Очистить</button>
		</form>

	</div>
	<table class="table table-bordered main-table" data-id="<?=$userData['id']?>">
		<thead>
		<tr>
			<th scope="col">Имя Фамилия</th>
			<th scope="col">Телефон</th>
			<th scope="col">Email</th>
			<th scope="col">Редактировать</th>
			<th scope="col">Удалить</th>
		</tr>
		</thead>
		<tbody class="main-tbody">
		<tr>
			<th scope="row">Имя Фамилия</th>
			<td>+7-922-72-55-325</td>
			<td>pochta@yandex.ru</td>
			<td><button>Изменить</button></td>
			<td><button>Удалить</button></td>
		</tr>

		</tbody>
	</table>
	<form class="add-form" enctype="multipart/form-data" method="post">
		<div class="item-add modal_text" style="position: fixed; border-radius: 10px; transform: translate(-50%, 50%)">
			<p class="add-form-text">Добавить новую запись</p>
			<input type="hidden" name="userId" value="<?=$userData['id']?>">
			<div class="input-group">
				<label for="add_name">Имя</label>
				<input type="text" name="name" class="add_name">
			</div>
			<div class="input-group">
				<label for="add_lastName">Фамилия</label>
				<input type="text" name="lastName" class="add_lastName">
			</div>
			<div class="input-group">
				<label for="add_phone">Телефон</label>
				<input type="number" name="phone" class="add_phone">
			</div>
			<div class="input-group">
				<label for="add_email">E-mail</label>
				<input type="email" name="email" class="add_email">
			</div>
			<div class="input-group">
				<label for="add_image">Фото</label>
				<input type="file" name="image" class="add_image" accept="image/jpeg,image/png">
			</div>

			<button type="submit" class="add_ok modal-ok__btn btn-outline-primary" href="#">Ок</button>
		</div>
		<div class="items-add-bg add-from__close">X</div>
	</form>
	<form class="edit-form" enctype="multipart/form-data" method="post">
		<div class="item-add modal_text" style="position: fixed; border-radius: 10px;">
			<p class="edit-form-text">Редактировать запись</p>
			<input type="hidden" name="userId" value="<?=$userData['id']?>">
			<input type="hidden" class="contactId" name="contactId" value="">
			<div class="input-group">
				<label for="edit_name">Имя</label>
				<input type="text" name="name" class="edit_name">
			</div>
			<div class="input-group">
				<label for="edit_lastName">Фамилия</label>
				<input type="text" name="lastName" class="edit_lastName">
			</div>
			<div class="input-group">
				<label for="edit_phone">Телефон</label>
				<input type="number" name="phone" class="edit_phone">
			</div>
			<div class="input-group">
				<label for="edit_phoneText">Телефон прописью</label>
				<button class="edit_phoneText" data-text="">Показать</button>
			</div>
			<div class="input-group">
				<label for="edit_email">E-mail</label>
				<input type="email" name="email" class="edit_email">
			</div>
			<div class="edit_images"></div>
			<div class="input-group">

				<label for="edit_image">Фото</label>
				<input type="file" name="image" class="edit_image" accept="image/jpeg,image/png">
			</div>

			<button type="submit" class="edit_ok modal-ok__btn btn-outline-primary" href="#">Ок</button>
			<button class="btn" href="#">Отменить</button>
		</div>
		<div class="items-add-bg edit-from__close">X</div>
	</form>
</div>
<?php endif;?>

