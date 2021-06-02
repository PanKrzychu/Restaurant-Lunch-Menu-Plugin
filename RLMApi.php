<?php

/**
 * @package  Quick Customisable Restaurant Menu
 */


class RLMApi
{
    
    public static function registerRoutes() {

        register_rest_route('RLMApi/v1', '/addLaunch', array(
            'methods' => 'POST',
            'callback' => function($data) {
                global $wpdb;
                
                $table_name = $wpdb->prefix . 'rlm';
                
                $wpdb->insert( 
                    $table_name, 
                    array( 
                        'first_dish' => $data['firstDish'], 
                        'second_dish' => $data['secondDish'], 
                        'drink' => $data['drink'], 
                        'dessert' => $data['dessert'], 
                        'date' => $data['date']
                    ) 
                    );

                wp_safe_redirect(
                    esc_url(
                        site_url('/wp-admin/admin.php?page=rlm')
                    )
                    );
                    exit();

            }
        ));

    }

    public static function getLunches() {
        global $wpdb;

        // $today = new DateTime();
        // $next = date_add($today, date_interval_create_from_date_string("7 days"));
        // $next = date_format($next, 'Y-m-d');
        // $today = new DateTime();
        // $before = date_sub($today, date_interval_create_from_date_string("7 days"));
        // $before = date_format($before, 'Y-m-d');
                
        $table_name = $wpdb->prefix . 'rlm';

        // $query = "SELECT * FROM $table_name WHERE date >= '$before' AND date <= '$next'";
        $query = "SELECT * FROM $table_name ORDER BY date DESC";
        
        $response = $wpdb->get_results($query);

        // echo $query;

        return $response;
    }

    public static function getLunchForToday() {
        global $wpdb;

        $today = date_format(new DateTime(), 'Y-m-d');
                
        $table_name = $wpdb->prefix . 'rlm';

        $query = "SELECT * FROM $table_name WHERE date = '$today'";
        
        $response = $wpdb->get_results($query);

        return $response;
    }

    public static function removeLunches() {
        global $wpdb;

        $before = date_sub(new DateTime(), date_interval_create_from_date_string("7 days"));
        $before = date_format($before, 'Y-m-d');
                
        $table_name = $wpdb->prefix . 'rlm';

        if($wpdb->delete($table_name, array( 'date' <= $before ))) return TRUE;

        return FALSE;
        
    }
    
}