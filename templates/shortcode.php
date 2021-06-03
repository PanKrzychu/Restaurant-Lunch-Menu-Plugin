<?php

require_once plugin_dir_path(__FILE__) . '../RLMApi.php';

$lunches = RLMApi::getLunchForToday();

if(count($lunches) != 0) {
    $content = "";

    foreach ($lunches as $lunch) {

        $i = 1;
        if(!empty($lunch->first_dish)) {
            $first_dish_content = "
            <div class='dish-line'>
                <span>$i</span>
                <p id=first-dish>$lunch->first_dish</p>
            </div>
            ";
            $i++;
        }
        if(!empty($lunch->main_course)) {
            $main_course_content = "
            <div class='dish-line'>
                <span>$i</span>
                <p id=first-dish>$lunch->main_course</p>
            </div>
            ";
            $i++;
        }
        if(!empty($lunch->drink)) {
            $drink_content = "
            <div class='dish-line'>
                <span>$i</span>
                <p id=first-dish>$lunch->drink</p>
            </div>
            ";
            $i++;
        }
        if(!empty($lunch->dessert)) {
            $dessert_content = "
            <div class='dish-line'>
                <span>$i</span>
                <p id=first-dish>$lunch->dessert</p>
            </div>
            ";
            $i++;
        }

        $content = $content . "<div class='set'>" . $first_dish_content . $main_course_content . $drink_content . $dessert_content . "</div>";

    }
} else {
    $content = "

    <div class='set'>
        <p id=empty>Nie mamy na dzisiaj lunchu :(</p>
    </div>

";
}
