<?php
namespace App;

use App\Todo\TodoList;
use Gt\Database\Database;
use GT\WebEngine\Service\DefaultServiceLoader;

class ServiceLoader extends DefaultServiceLoader {
	public function loadTodoList():TodoList {
		return new TodoList(
			$this->container->get(Database::class)
		);
	}
}
