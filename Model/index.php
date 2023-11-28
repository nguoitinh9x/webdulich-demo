<?php
    $Slider = new \Library\plugins('Slider','owl');
    $plugin_css .= $Slider->css();
    $plugin_js .= $Slider->js();

    $Hot = new \Library\plugins('News','type1');
    $plugin_css .= $Hot->css();
    $plugin_js .= $Hot->js();

    $Ads = new \Library\plugins('About','ads');
    $plugin_css .= $Ads->css();

    $Tour = new \Library\plugins('News','ajax');
    $plugin_css .= $Tour->css();
    $plugin_js .= $Tour->js();

    $Album = new \Library\plugins('Album','grid');
    $plugin_css .= $Album->css();

    $Video = new \Library\plugins('Video','type1');
    $plugin_css .= $Video->css();
    $plugin_js .= $Video->js();

    $News = new \Library\plugins('News','owl');
    $plugin_css .= $News->css();
    $plugin_js .= $News->js();