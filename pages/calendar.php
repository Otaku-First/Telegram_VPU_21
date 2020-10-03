
<?php
/*
Author: Otaku-First
GitHub: https://github.com/Otaku-First
Date: 30.09.20
*/
require_once("db_connect.php");

 ?> 
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php  include 'include/head.php';?> 
    </head>
    <body class="sb-nav-fixed">
       <?php  include 'include/nav.php';?> 
        <div id="layoutSidenav">
             <?php  include 'include/menu.php';?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        
                      <?php 
                              
       $mess_sql = mysql_query("SELECT * FROM `messages` WHERE chat_id=".$_GET["u_mess"]."");
                                  
       $u_name_sql = mysql_query("SELECT `name` FROM `users` WHERE chat_id=".$_GET["u_mess"]."");
                                        
                                        $u_name_arr = mysql_fetch_array($u_name_sql);
                                       

                                        
                                        
                                            ?>
                                            <h1></h1>
                        <div></div>
                  
                          



	<style type="text/css">
		hr {
			height: 1px;
			overflow: hidden;
			font-size: 0;
			line-height: 0;
			background: #ccc;
			margin: 50px 0;
			border: 0;
		}

		/* css for calendar */
		.b-calendar {
			font: 14px/1.2 Arial, sans-serif;
			background: #f2f2f2;
		}
		.b-calendar--along {
			width: 300px;
			padding: 30px 40px;
			margin: 50px auto;
		}
		.b-calendar--many {
			padding: 20px;
			width: 250px;
			display: inline-block;
			vertical-align: top;
			margin: 0 20px 20px;
		}
		.b-calendar__title {
			text-align: center;
			margin: 0 0 20px;
		}
		.b-calendar__year {
			font-weight: bold;
			color: #333;
		}
		.b-calendar__tb {
			width: 100%;
		}
		.b-calendar__head {
			font: bold 14px/1.2 Arial, sans-serif;
			padding: 5px;
			text-align: left;
			border-bottom: 1px solid #c0c0c0;
		}
		.b-calendar__np {
			padding: 5px;
		}
		.b-calendar__day {
			font: 14px/1.2 Arial, sans-serif;
			padding: 8px 5px;
			text-align: left;
		}
		.b-calendar__weekend {
			color: red;
		}
	</style>


<?

function draw_calendar($month, $year, $action = 'none') {
	$calendar = '<table cellpadding="0" cellspacing="0" class="b-calendar__tb">';
	
	// вывод дней недели
	$headings = array('Пн','Вт','Ср','Чт','Пт','Сб','Вс');
	$calendar.= '<tr class="b-calendar__row">';
	for($head_day = 0; $head_day <= 6; $head_day++) {
		$calendar.= '<th class="b-calendar__head';
		// выделяем выходные дни
		if ($head_day != 0) {
			if (($head_day % 5 == 0) || ($head_day % 6 == 0)) {
				$calendar .= ' b-calendar__weekend';
			}
		}
		$calendar .= '">';
		$calendar.= '<div class="b-calendar__number">'.$headings[$head_day].'</div>';
		$calendar.= '</th>';
	}
	$calendar.= '</tr>';

	// выставляем начало недели на понедельник
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$running_day = $running_day - 1;
	if ($running_day == -1) {
		$running_day = 6;
	}
	
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$day_counter = 0;
	$days_in_this_week = 1;
	$dates_array = array();
	
	// первая строка календаря
	$calendar.= '<tr class="b-calendar__row">';
	
	// вывод пустых ячеек
	for ($x = 0; $x < $running_day; $x++) {
		$calendar.= '<td class="b-calendar__np"></td>';
		$days_in_this_week++;
	}
	
	// дошли до чисел, будем их писать в первую строку
	for($list_day = 1; $list_day <= $days_in_month; $list_day++) {
		$calendar.= '<td class="b-calendar__day';

		// выделяем выходные дни
		if ($running_day != 0) {
			if (($running_day % 5 == 0) || ($running_day % 6 == 0)) {
				$calendar .= ' b-calendar__weekend';
			}
		}
		$calendar .= '">';

		// пишем номер в ячейку
		$calendar.= '<div class="b-calendar__number"><a href="add_r.php?year='.date("Y").'&month='.$month.'&day='.$list_day.'">'.$list_day.'</a></div>';
		$calendar.= '</td>';

		// дошли до последнего дня недели
		if ($running_day == 6) {
			// закрываем строку
			$calendar.= '</tr>';
			// если день не последний в месяце, начинаем следующую строку
			if (($day_counter + 1) != $days_in_month) {
				$calendar.= '<tr class="b-calendar__row">';
			}
			// сбрасываем счетчики 
			$running_day = -1;
			$days_in_this_week = 0;
		}

		$days_in_this_week++; 
		$running_day++; 
		$day_counter++;
	}

	// выводим пустые ячейки в конце последней недели
	if ($days_in_this_week < 8) {
		for($x = 1; $x <= (8 - $days_in_this_week); $x++) {
			$calendar.= '<td class="b-calendar__np"> </td>';
		}
	}
	$calendar.= '</tr>';
	$calendar.= '</table>';

	return $calendar;
}

?>


<?
	$months = Array(
		0 => 'Январь',
		1 => 'Февраль',
		2 => 'Март',
		3 => 'Апрель',
		4 => 'Май',
		5 => 'Июнь',
		6 => 'Июль',
		7 => 'Август',
		8 => 'Сентябрь',
		9 => 'Октябрь',
		10 => 'Ноябрь',
		11 => 'Декабрь'
	);

	for ($month = 1; $month <= 12; $month++) { ?>
		<div class="b-calendar b-calendar--many">
			<div class="b-calendar__title"><span class="b-calendar__month"><?= $months[$month-1] ?></span> <span class="b-calendar__year"></span></div>
			<?
				echo draw_calendar($month,date('Y'));
			?>
		</div>
	<? }
?>

                    
                    </div>
                </main>
                 <?php  include 'include/flooter.php';?> 
            </div>
        </div>
        <?php  include 'include/script.php';?> 
        <script>$(document).ready(function() {
    $('#dataTable2').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );</script>
    </body>
</html>




