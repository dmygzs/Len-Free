<?php
$var = '0.0.1';
function enqueue_custom_admin_styles()
{
    global $var;
    //引用主题的设置样式文件
    wp_enqueue_style('Len', CSF::include_plugin_url('assets/css/len.css'), array(), $var, 'all');
    wp_enqueue_style('Len-min', CSF::include_plugin_url('assets/css/len.min.css'), array(), $var, 'all');
}
add_action('admin_enqueue_scripts', 'enqueue_custom_admin_styles');

//前台全局CSS和JS文件
function Len_scripts_styles()
{

    global $var;
    //引用JavaScript文件
    wp_enqueue_script('Len-swiper', get_template_directory_uri() . '/Assets/Lne-JavaScript/swiper-bundle.min.js', array(), $var, true);
    wp_enqueue_script('main', get_template_directory_uri() . '/Assets/Lne-JavaScript/main.js', array(), $var, true);

    //引用Css样式文件
    wp_enqueue_style('Len-header', get_template_directory_uri() . '/Assets/Len-Css/header.css', array(), $var, 'all');
    wp_enqueue_style('Len-main', get_template_directory_uri() . '/Assets/Len-Css/main.css', array(), $var, 'all');
    wp_enqueue_style('Len-footer', get_template_directory_uri() . '/Assets/Len-Css/footer.css', array(), $var, 'all');

    //幻灯片样式
    wp_enqueue_style('Len-swiper', get_template_directory_uri() . '/Assets/Len-Css/swiper-bundle.min.css', array(), $var, 'all');

    //文章页样式
    wp_enqueue_style('Len-article', get_template_directory_uri() . '/Assets/Len-Css/article.css', array(), $var, 'all');

    //图标引用
    wp_enqueue_script('ali', '//at.alicdn.com/t/c/font_4353348_7ymlde7ymd6.js', array(), $var, true);
}
add_action('wp_enqueue_scripts', 'Len_scripts_styles');
<<<<<<< HEAD
=======

/**
 * 在WordPress主题的<head>部分添加自定义的<meta>标签。
 */
function add_custom_meta_tags()
{
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">' . PHP_EOL;
}

// 将函数挂载到wp_head动作上
add_action('wp_head', 'add_custom_meta_tags');
>>>>>>> parent of 8dd72b3 (文章页模块基本完善)
