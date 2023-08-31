<section id="calendar" style="display: flex;">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<?php
    date_default_timezone_set('America/Sao_Paulo');
    $my_year = date("Y");
    function year_check($my_year){
        if ($my_year % 400 == 0){
            return true;
        }else if ($my_year % 100 == 0){
            return false;
        }else if ($my_year % 4 == 0){
            return true;
        }else{
            return false;
        }
    }

    $month_ = $_GET["month"]??date("m");
    switch ($month_) {
        case '1': $num_days = 31; $month = "Janeiro"; break;
        case '2':
            $month = "Fevereiro";
            if (year_check($my_year) == true) {
                $num_days = 29;
            } else {
                $num_days = 28;
            }    
        break;
        case '3': $num_days = 31; $month = "Março"; break;
        case '4': $num_days = 30; $month = "Abril"; break;
        case '5': $num_days = 31; $month = "Maio"; break;
        case '6': $num_days = 30; $month = "Junho"; break;
        case '7': $num_days = 31; $month = "Julho"; break;
        case '8': $num_days = 31; $month = "Agosto"; break;
        case '9': $num_days = 30; $month = "Setembro"; break;
        case '10': $num_days = 31; $month = "Outubro"; break;
        case '11': $num_days = 30; $month = "Novembro"; break;
        case '12': $num_days = 31; $month = "Dezembro"; break;
    }
    
    $day = 1;
    $previous_month = $month_ -1;
    $next_month = $month_ +1;

    echo"
    <div class='calendar-content'>
        <div class='calendar-container_weekdays'>
            <form action='home.php' method='GET' class='arrows_container'>
                <span class='grid-item_arrows'><button type='submit'><i class='fa fa-caret-left'></i></button></span>
                <input type='hidden' name='page' value='calendar'>
                <input type='hidden' name='month' value='".$previous_month."'>
            </form>
            <span class='grid-item_month'>".$month."</span>
            <form action='home.php' method='GET' class='arrows_container'>
                <span class='grid-item_arrows'><button type='submit'><i class='fa fa-caret-right'></i></button></span>
                <input type='hidden' name='page' value='calendar'>
                <input type='hidden' name='month' value='".$next_month."'>
            </form>
            <span class='grid-item_weekdays'>D</span>
            <span class='grid-item_weekdays'>S</span>
            <span class='grid-item_weekdays'>T</span>
            <span class='grid-item_weekdays'>Q</span>
            <span class='grid-item_weekdays'>Q</span>
            <span class='grid-item_weekdays'>S</span>
            <span class='grid-item_weekdays'>S</span>
        </div>
    ";
    echo'
        <div class="calendar-container">
            <form id="calendar" action="home.php" method="GET" class="form-calendar">
    ';
    $booking_date = $appoiment_controller->get_all_booking_dates($_SESSION['profile'][1]['access_to_appoiment']['view']);
    foreach ($booking_date as $booking_date) {
        $day_teste = strtotime($booking_date["booking_date"]);
        $appoiment_day_teste[] = (int)date("d",$day_teste);
    }
    while ($day <= $num_days) {
        if ($day == date('d')) {
            echo"
                <div class='grid-item".$day." ".date("l", mktime(0, 0, 0, $month_, $day, date("Y")))."'>
                    <input class='grid-item today' name='appoiment_day' type='submit' value='".$day."'>
                </div>
            ";
        } elseif ($day == 1) {
            //Create an select query to see which day has an appoiment
            //
            echo"
                <div class='grid-item".$day." ".date("l", mktime(0, 0, 0, $month_, $day, date("Y")))."'>
                    <input class='appoiment grid-item' name='appoiment_day' type='submit' value='".$day."'>
                </div>
            ";
        } else {
            echo"
                <div class='grid-item".$day." ".date("l", mktime(0, 0, 0, $month_, $day, date("Y")))."'>
                    <input class='grid-item' name='appoiment_day' type='submit' value='".$day."'>
                </div>
            ";
        }
        $day = $day + 1;
    }
    

    switch (date('l', strtotime(date('Y-'.$month_.'-1')))) {
        case "Sunday": echo"<style>.grid-item1{grid-column-start: 1;}</style>"; break;
        case "Monday": echo"<style>.grid-item1{grid-column-start: 2;}</style>"; break;
        case "Tuesday": echo"<style>.grid-item1{grid-column-start: 3;}</style>"; break;
        case "Wednesday": echo"<style>.grid-item1{grid-column-start: 4;}</style>"; break;
        case "Thursday": echo"<style>.grid-item1{grid-column-start: 5;}</style>"; break;
        case "Friday": echo"<style>.grid-item1{grid-column-start: 6;}</style>"; break;
        case "Saturday": echo"<style>.grid-item1{grid-column-start: 7;}</style>"; break;
    }
    
    echo'
                <input type="hidden" name="month" value="'.$month_.'">
                <input type="hidden" name="page" value="calendar">
            </form>
        </div>
        </div>
    ';
    $current_day = date("d");
    $appoiment_day = $_GET['appoiment_day']??$current_day;

    
    
?>
</section>