
<div class="container">

    <h2>Restaurant Lunch Menu</h2>
    <h4>Add lunches to the list</h4>

    <div class="box">

        <div class="creator">

            <form class="creator-box" action="../wp-json/RLMApi/v1/addLaunch" method='POST'>

            <div class="input-group">
                <label for="firstDish">First dish</label>
                <input type='text' name='firstDish'>
            </div>
            
            <div class="input-group">
                <label for="secondDish">Main course</label>
                <input type='text' name='secondDish'>
            </div>

            <div class="input-group">
                <label for="drink">Drink</label>
                <input type='text' name='drink'>
            </div>

            <div class="input-group">
                <label for="dessert">Dessert</label>
                <input type='text' name='dessert'>
            </div>

            <div class="input-group">
                <label for="date">Date</label>
                <input type='date' name='date'>
            </div>

            <div class="input-group">
                <button type="submit">Submit</button>
            </div>

            </form>
        </div>

        <div class="list">


            <table>
                <tr>
                    <th class='dish-th'>First dish:</th>
                    <th class='dish-th'>Main course:</th> 
                    <th class='dish-th'>Drink:</th> 
                    <th class='dish-th'>Dessert:</th> 
                    <th class='date-th'>Date:</th>
                </tr>

                <?php
                    require_once plugin_dir_path(__FILE__) . '../RLMApi.php';
                    $lunches = RLMApi::getLunches();

                    foreach ($lunches as $lunch) {

                        echo ("
                        <tr>
                            <td class='dish-td'>$lunch->first_dish</td>
                            <td class='dish-td'>$lunch->second_dish</td>
                            <td class='dish-td'>$lunch->drink</td>
                            <td class='dish-td'>$lunch->dessert</td>
                            <td class='date-td'>$lunch->date</td>
                        </tr>
                    ");
                    }

                ?>



                

            </table>

        </div>
    </div>

</div>