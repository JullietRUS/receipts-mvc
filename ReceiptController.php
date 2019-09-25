<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/ReceiptModel.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ReceiptView.php');

class ReceiptController
{

	var $listData;
	var $curPage;
	var $curItemID;
	var $itemsOnPage;
	var $viewType = 'list';

	private $Model;

	/**
	 * ReceiptListController constructor.
	 * @param $listData
	 */
	public function __construct($quantityOnPage = '')
	{
		$this->Model = new ReceiptModel();

		$total = $this->Model->getTotal();

		$this->itemsOnPage = $quantityOnPage ? $quantityOnPage : $total;

		if (isset($_REQUEST['v']) && in_array($_REQUEST['v'], array('list', 'detail'))) {
			$this->viewType = $_REQUEST['v'];
		}

		if ($this->viewType === 'list') {

			$p = 1;
			if (isset($_REQUEST['p'])) {
				$p = intval($_REQUEST['p']);
			}

			$this->curPage = $p > 0 ? $p : 1; // or first page

			$offset = $this->curPage > 1 ? $quantityOnPage * $this->curPage : 0;

			$this->listData = $this->Model->getList($this->itemsOnPage, $offset);
		} else {
			$this->curItemID = intval($_REQUEST['id']);
		}


	}

	public function view()
	{

		if ($this->viewType === 'list') {
			ReceiptView::htmlList($this->listData);

			if ($this->itemsOnPage < $this->Model->getTotal()) {
				$this->paging();
			}
		} else {

			if ($item = $this->Model->getById($this->curItemID)) {
				ReceiptView::htmlDetail($item);
			}


		}


	}

	private function paging()
	{
		ReceiptView::pagingHTML($this->Model->getTotal() / $this->itemsOnPage, $this->curPage);
	}

}
