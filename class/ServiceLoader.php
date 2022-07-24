<?php
namespace App;

use App\Todo\TodoList;
use Gt\Database\Database;
use Gt\ServiceContainer\LazyLoad;
use Gt\WebEngine\Middleware\DefaultServiceLoader;

class ServiceLoader extends DefaultServiceLoader {
	#[LazyLoad]
	public function loadTodoList():TodoList {
		return new TodoList(
			$this->container->get(Database::class)
		);
	}
}
