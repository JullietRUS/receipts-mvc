<?php

class Receipt
{
	public $name;
	public $id;
	public $description;

	/**
	 * Receipt constructor.
	 * @param $name
	 * @param $text
	 */
	public function __construct($name, $text, $id)
	{
		$this->name = $name;
		$this->description = htmlspecialchars($text);
		$this->id = intval($id);
	}

}

class ReceiptModel
{
	private $ListReceipts = array();
	private $total = 50;

	function __construct()
	{
		for ($i = 1; $i <= $this->total; $i++) {
			$receipt = new Receipt('Receipt ' . $i, 'Description ' . $i, $i);
			$this->ListReceipts[] = $receipt;
		}
	}

	/**
	 * @return int
	 */
	public function getTotal(): int
	{
		return $this->total;
	}

	public function getList($quantity, $offset = 0)
	{
		return array_slice($this->ListReceipts, $offset, $quantity);
	}

	public function getById($id)
	{
		for ($i = 0; $i < $this->total; $i++) {
			if ($this->ListReceipts[$i]->id === $id) {
				return $this->ListReceipts[$i];
			}
		}
		return false;
	}
}
