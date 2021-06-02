<?php

require_once plugin_dir_path(__FILE__) . '../RLMApi.php';

$lunches = RLMApi::getLunchForToday();

if(count($lunches) != 0) {
    $content = "";

    foreach ($lunches as $lunch) {
        $content = $content . "

        <div class='set'>

            <div class='dish-line'>
                <span>1</span>
                <p id=first-dish>$lunch->first_dish</p>
            </div>

            <div class='dish-line'>
                <span>2</span>
                <p id=second-dish>$lunch->second_dish</p>
            </div>

            <div class='dish-line'>
                <span>3</span>
                <p id=second-dish>$lunch->drink</p>
            </div>

            <div class='dish-line'>
                <span>4</span>
                <p id=second-dish>$lunch->dessert</p>
            </div>
            
        </div>

        ";
    }
} else {
    $content = "

    <div class='set'>
        <p id=empty>Nie mamy na dzisiaj lunchu :(</p>
    </div>

";
}
