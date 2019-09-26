<?php

class ReceiptView
{
	public static function htmlList($arItems,  $CurPage)
	{

		echo '<div class="content">';
		echo '<h1>Receipts</h1>';
		foreach ($arItems as $arItem) {
			echo '<div class="receipt"><h2>' . $arItem['NAME'] . '</h2>' .
					'<p><a href="?v=detail&id=' . $arItem['ID'] . '&p='. $CurPage.'">More</a></p></div>';
		}
		echo '</div>';
	}

	public static function htmlDetail($Item, $CurPage)
	{
		echo '<div class="content">'.'<h1>' . $Item['NAME'] . ' </h1>' .
				 '<div class="receipt-detail">'.
         '<p><em>Level</em>: '.str_repeat('🍕',$Item['DIFFICULTY'] ).'</p>'.
				 '<p><em>🧭</em>: '.$Item['TIME'].' minutes</p>'.
				 '<p>'.$Item['DESC'] .'</p></div>'.
				 '<p><a href="?v=list&p='.$CurPage.'">Back</a></p></div>';
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
