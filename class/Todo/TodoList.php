<?php
namespace App\Todo;

use Gt\Database\Database;
use Gt\Database\Result\Row;
use Gt\Ulid\Ulid;

class TodoList {
	public function __construct(
		private readonly Database $db,
	) {
	}

	/** @return array<TodoItem> */
	public function getAll():array {
		$todoItemArray = [];

		foreach($this->db->fetchAll("todo/getAll") as $row) {
			array_push($todoItemArray, $this->rowToTodoItem($row));
		}

		return $todoItemArray;
	}

	public function update(string $id, string $title, ?bool $completed):void {
		$this->db->update("todo/updateById", $title, $completed ?? false, $id);
	}

	public function create(string $title):void {
		$id = new Ulid();
		$this->db->insert("todo/insert", $title, $id);
	}

	public function delete(string $id):void {
		$this->db->delete("todo/deleteById", $id);
	}

	private function rowToToDoItem(?Row $row = null):?TodoItem {
		if(!$row) {
			return null;
		}

		return new TodoItem(
			$row->getString("id"),
			$row->getString("title"),
			$row->getBool("completed"),
		);
	}
}
