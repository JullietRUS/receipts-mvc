<?php

class ReceiptModel
{

	private $total = 30;
	private $DB;
	private $lastError;

	function __construct()
	{
		if (!$this->DB) {
			$this->DB = new PDO('sqlite:' . $_SERVER['DOCUMENT_ROOT'] . '/database/receipts');
			$this->DB ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	}

	public function add($arValues)
	{
			$sql = 'INSERT INTO receipts (ID, NAME, DESC, DIFFICULTY, TIME, DATE_CREATE) VALUES(:ID, :NAME, :DESC, :DIFFICULTY, :TIME, :DATE_CREATE)';
			$prepared = $this->DB->prepare($sql);

			$prepared->bindParam(':ID', $arValues['ID'], PDO::PARAM_INT);
			$prepared->bindParam(':NAME', $arValues['NAME'], PDO::PARAM_STR);
			$prepared->bindParam(':DESC', $arValues['DESC'], PDO::PARAM_STR);
			$prepared->bindParam(':DIFFICULTY', $arValues['DIFFICULTY'], PDO::PARAM_INT);
			$prepared->bindParam(':TIME', $arValues['TIME'], PDO::PARAM_INT);
			$prepared->bindParam(':DATE_CREATE', $arValues['DATE_CREATE'], PDO::PARAM_STR);

			$prepared->execute();
	}

	/**
	 * @return mixed
	 */
	public function getLastError()
	{
		return $this->lastError;
	}


	/**
	 * @return int
	 */
	public function getTotal(): int
	{
		return $this->total;
	}

	public function getList($first, $quantity)
	{
			$sql = 'SELECT * FROM receipts ORDER BY ID LIMIT ' . $first . ',' . $quantity . ' ';
			$prepared = $this->DB->prepare($sql);
			$prepared->execute();

			$list = array();//$prepared->fetch(PDO::FETCH_ASSOC);

			while ($row = $prepared->fetch(PDO::FETCH_ASSOC)) {
				$list[] = $row;
			}

			return $list;
	}

	public function getById($id)
	{
			$sql = 'SELECT * FROM receipts WHERE ID=:id';
			$prepared = $this->DB->prepare($sql);
			$prepared->bindParam(':id', $id, PDO::PARAM_INT);
			$prepared->execute();
			return $prepared->fetch(PDO::FETCH_ASSOC);
	}
}
