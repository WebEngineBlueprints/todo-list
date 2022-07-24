<?php
namespace App\Todo;

use Gt\DomTemplate\BindGetter;

class TodoItem {
	public function __construct(
		public readonly string $id,
		public readonly string $title,
		public readonly bool $completed,
	) {}

	#[BindGetter]
	public function getStatus():string {
		if($this->id === "") {
			return "new";
		}
		if($this->completed) {
			return "completed";
		}

		return "";
	}
}
