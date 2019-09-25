<?php

class ReceiptView
{
	public static function htmlList($arItems)
	{

		echo '<div class="content">';
		echo '<h1>Receipts</h1>';
		foreach ($arItems as $key => $arItem) {
			echo '<div class="receipt"><h2>' . $arItem->name . '</h2>' .
					'<p><a href="?v=detail&id=' . $arItem->id . '">More</a></p></div>';
		}
		echo '</div>';
	}

	public static function htmlDetail($Item)
	{

		echo '<div class="content">'.'<h1>' . $Item->name . '</h1>' . $Item->description .
				' <p><a href="?v=list">Back</a></p></div>';
	}

	public static function pagingHTML($totPages, $curPage)
	{
		echo '<div class="paging"><span>Pages</span>';
		echo '<ul>';
		for ($i = 1; $i < $totPages; $i++) {

			$isActive = ($curPage === $i) ? ' class="current_page"' : '';

			echo '<li><a' . $isActive . ' href="?v=list&p=' . $i . '">' . $i . '</a></li>';
		}
		echo '</ul> from ' . $totPages . '</div>';
	}

}