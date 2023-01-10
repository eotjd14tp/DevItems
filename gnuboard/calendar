// php를 이용한 달력 제작 소스

<?php
  // 달력 날짜 기본 설정 코드
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

	// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
	add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css">', 0);

	function freeyymm($flag, $yymm){
		if(!$yymm) return date("Y-m");
		return date("Y-m",strtotime($flag, strtotime($yymm."01")));
	}

	// 달력 제작
	$nowMonth1 = date('Ym');
	$nowDate1 = date('Ymd');
	$nowMonth = date('Y-m'); // 현재 월
	$nowDate = date('Y-m-d'); // 오늘 날짜
	$nowDay = date('j'); // 찐 오늘만의 날짜

	$prevMonth = freeyymm('-1 month', $nowMonth1); // 이전 월
	$nextMonth = freeyymm('+1 month', $nowMonth1); // 다음 월
	$nowMonthLastDate = date('t', strtotime($nowMonth)); // 현재 월의 마지막 날짜
	$prevMonthLastDate = date('t', strtotime($prevMonth)); // 이전 월의 마지막 날짜
	$nextMonthStartDate = date('t', strtotime($nextMonth)); // 다음 월의 마지막 날짜
	$start_yoil = date('w',strtotime($nowMonth.'-01')); // 시작요일
	$total_week = ceil(($nowMonthLastDate + $start_yoil) / 7); // 현재 월의 주차
    $prevMonthStartDate = 0;
	if($start_yoil != 0) {
		$prevMonthStartDate = $prevMonthLastDate - $start_yoil + 1;
	}
?>

<?php
  // 달력 출력 소스
  // 주단위 먼저 처리
    $date = 1;
    $nowMonthDate = 1;

    for ($i = 0; $i < $total_week; $i++) {

      for ($o = 0; $o < 7; $o++) {
        $active = '';
        if($date == $nowDay) $active = 'current-day';
        if($i == 0) {
          // 첫째주 기준 뽑아내기
          if($o < $start_yoil) {
            // 이전 월 데이터 출력
            echo '<button class="date faded">'.$prevMonthStartDate.'</button>';
            $prevMonthStartDate++;
          } else {
            // 현재 월 데이터 출력
            if($o == 0) {
              // 일요일이면
              echo '<button class="date sun '.$active.'">'.$date.'</button>';
            } else if($o == 6) {
              // 토요일이면
              echo '<button class="date sat '.$active.'">'.$date.'</button>';
            } else {
              echo '<button class="date '.$active.'">'.$date.'</button>';
            }

            $date++;
          }
        } else {
          // 2주차부터 쭉
          if($date <= $nowMonthLastDate) {
            if($o == 0) {
              // 일요일이면
              echo '<button class="date sun '.$active.'">'.$date.'</button>';
            } else if($o == 6) {
              // 토요일이면
              echo '<button class="date sat '.$active.'">'.$date.'</button>';
            } else {
              echo '<button class="date '.$active.'">'.$date.'</button>';
            }
            $date++;
          } else {
            echo '<button class="date faded">'.$nowMonthDate.'</button>';
            $nowMonthDate++;
          }
        }
      }
    }
  

?>

