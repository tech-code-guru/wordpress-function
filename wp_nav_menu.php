<?php
            $defaults = array(
                'theme_location'  => '',
                'container'       => false,
                'menu_class'      => '',
                'menu_id'         => 'menu',
                'echo'            => true,
                'depth'           => 3,
                );
            wp_nav_menu( $defaults );
            ?>