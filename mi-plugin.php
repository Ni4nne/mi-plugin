<?php
/*
 * Plugin Name:       mi-plugin
 * Description:       Muestra un mensaje de bienvenida en el encabezado de cada página.
 * Version:           1.0.0
 * Requires at least: 6.5
 * Requires PHP:      8.2
 * Author:            Isabel León
 * License:           GPL v2 or later
 */


//Agregar estilos CSS
function mi_plugin_agregar_estilos() {

    //Ruta del archivo de estilos
    $estilos_url = plugin_dir_url( __FILE__ ) . 'mi-plugin_styles.css';
    
    //Añadir la hoja de estilos al encabezado
    wp_enqueue_style( 'mi-plugin-estilos', $estilos_url );

}
add_action( 'wp_enqueue_scripts', 'mi_plugin_agregar_estilos' );

// Agregar un saludo personalizado
function mi_plugin_agregar_saludo() {
    $current_user = wp_get_current_user();

    if ($current_user->ID != 0) {
        //Muestra el nombre del usuario conectado
        $saludo = 'Bienvenido ' . $current_user->display_name . '!';

        //Define la ruta al perfil del usuario
        $perfil = get_permalink(wc_get_page_id('myaccount'));

        //Muestra el mensaje al usuario y el icono dirige al perfil
        echo '<div class="mensaje"><a href="' . esc_url($perfil) . '">';
        echo '<i class="fa-solid fa-user"></i>';
        echo '</a><span>' . $saludo . '</span></div>';

    } else {
        //Si no hay un usuario conectado, muestra el mensaje al invitado
        $saludo = 'Bienvenido invitado!';

        echo '<div class="mensaje">';
        echo '<i class="fa-solid fa-user"></i>';
        echo '</a><span>' . $saludo . '</span></div>';

    }

}
add_action('wp_head', 'mi_plugin_agregar_saludo');