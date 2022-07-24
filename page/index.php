<?php
use App\Todo\TodoItem;
use App\Todo\TodoList;
use Gt\Dom\HTMLDocument;
use Gt\DomTemplate\DocumentBinder;
use Gt\Input\Input;

function go(DocumentBinder $binder, TodoList $todoList, HTMLDocument $document):void {
	$todoListItems = $todoList->getAll();
	array_push($todoListItems, new TodoItem("", "", false));
	$binder->bindList($todoListItems);
	$document->querySelector("li.new input[name='title']")->autofocus = true;
}

function do_save(Input $input, TodoList $todoList):void {
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

	header("Location: ./");
	exit;
}

function do_delete(Input $input, TodoList $todoList):void {
	$todoList->delete($input->getString("id"));
	header("Location: ./");
	exit;
}
