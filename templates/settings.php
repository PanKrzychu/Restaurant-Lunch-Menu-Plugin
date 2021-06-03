
<div class="container">

    <h2>Restaurant Lunch Menu</h2>
    <h4>Add lunches to the list. To show the menu on your page use the shortcode [rlm].</h4>

    <div class="box">

        <div class="creator">

        <?php
            if (isset($_SESSION['creator_message'])) {
                echo ("
                    <div class='message " . $_SESSION['creator_message'][1] . "'><p>" . $_SESSION['creator_message'][0] . "</p></div>
                ");
                unset($_SESSION['creator_message']);
            }
        ?>

            <form class="creator-box" action="../wp-json/RLMApi/v1/addLaunch" method='POST'>

            <div class="input-group">
                <label for="firstDish">First dish</label>
                <textarea maxlength="220" name='firstDish'></textarea>
            </div>
            
            <div class="input-group">
                <label for="secondDish">Main course</label>
                <textarea maxlength="220" name='secondDish'></textarea>
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

                <?php 
                    $today = date_format(new DateTime(), 'Y-m-d');
                    echo "<input type='date' name='date' value=$today>";
                ?>
                
            </div>

            <div class="input-group">
                <button type="submit">Submit</button>
            </div>

            </form>
        </div>

        <div class="list">

        <?php 
        
        require_once plugin_dir_path(__FILE__) . 'SettingsTable.php';

        render_settings_table();
        
        ?>
            
        </div>

    </div>

</div>