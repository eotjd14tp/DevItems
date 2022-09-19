// 그누보드 게시판 페이징
// ver 1.0
// 게시글이 1개 있어도 페이징이 뜰 수 있게 처리
// 다음 페이징이 없어도 다음 페이지를 누르면 2페이지로 가는 오류 있음
function get_paging($write_pages, $cur_page, $total_page, $url, $add="") {
	$url = preg_replace('#(&amp;)?page=[0-9]*#', '', $url);
	$url .= substr($url, -1) === '?' ? 'page=' : '&amp;page=';

	$str = '';
	if ($cur_page >= 1) {
		// 처음 버튼 생성
		$str .= '<a href="'.$url.'1'.$add.'" class="page-first">처음</a>'.PHP_EOL;
	}

	$start_page = ( ( (int)( ($cur_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
	$end_page = $start_page + $write_pages - 1;

	if ($end_page >= $total_page) $end_page = $total_page;

	if ($start_page >= 1) {
		// 이전 버튼 생성
		$str .= '<a href="'.$url.($start_page-1).$add.'" class="page-prev">이전</a>'.PHP_EOL;
	}

	if ($total_page >= 1) {
		for ($k=$start_page;$k<=$end_page;$k++) {
			// 글 갯수에 따라 보여지는 버튼 생성
			if ($cur_page != $k)
				$str .= '<a href="'.$url.$k.$add.'" class="number">'.$k.PHP_EOL;
			else
				$str .= '<a class="number on">'.$k.'</a>'.PHP_EOL; // 현재 활성화된 페이지
		}
	}

	if ($total_page >= $end_page) {
		// 다음 버튼 생성
		$str .= '<a href="'.$url.($end_page+1).$add.'" class="page-next">다음</a>'.PHP_EOL;
	}

	if ($cur_page <= $total_page) {
		// 맨끝 버튼 생성
		$str .= '<a href="'.$url.$total_page.$add.'" class="page-last">맨끝</a>'.PHP_EOL;
	}

	if ($str)
		return '<nav class="pagination">'.$str.'</nav>';
	else
		return "";
}
