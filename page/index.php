<?php
use App\Todo\TodoItem;
use App\Todo\TodoList;
use Gt\Dom\HTMLDocument;
use Gt\DomTemplate\Binder;
use Gt\Http\Response;
use Gt\Input\Input;

function go(TodoList $todoList, Binder $binder, HTMLDocument $document):void {
	$todoListItems = $todoList->getAll();
	array_push($todoListItems, new TodoItem("", "", false));
	$binder->bindList($todoListItems);
	$document->querySelector("li.new input[name='title']")->autofocus = true;
}

function do_save(TodoList $todoList, Input $input, Response $response):void {
	if($id = $input->getString("id")) {
// If there's an ID, we shall update the existing record.
		$todoList->update(
			$id,
			$input->getString("title"),
			$input->getBool("completed")
		);
	}
	else {
// If there's not an ID, we shall create a new record.
		$todoList->create(
			$input->getString("title"),
		);
	}

	$response->reload();
}

function do_delete(TodoList $todoList, Input $input, Response $response):void {
	$todoList->delete($input->getString("id"));
	$response->reload();
}
