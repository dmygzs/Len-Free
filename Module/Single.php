<?php

/**
 * 文章详情页模块函数
 * 2024/1/13/0:17
 * 作者：青桔
 */

/**
 * 文章转载功能函数模块
 * 
 * 这个函数获取转载文章的值并判断输出结果
 * 
 * @param string $Address            要获取的 '_Len_Post_Module('', 'Module_Source_Address', '', '');' 中的键。
 * @param string $Author_Name        要获取的 '_Len_Post_Module('', 'Module_Source_Author_Name', '', '');' 中的键。
 * @param string $Link               要获取的 '_Len_Post_Module('', 'Module_Source_Link', '', '');' 中的键。
 * @param mixed  $default            如果未找到对应值时返回的默认值。
 * @return mixed 返回获取到的元数据值或默认值。
 */
function Len_Source_Module()
{
    //获取值
    //获取转载网站名称
    $Address =  _Len_Post_Module('', 'Module_Source_Address', '', '');
    //获取转载作者名
    $Author_Name =  _Len_Post_Module('', 'Module_Source_Author_Name', '', '');
    //获取转载网站地址
    $Link =  _Len_Post_Module('', 'Module_Source_Link', '', '');
?>
    <div class="len-source-min">
        <div class="len-source-blcoik">
       
        <div class="len-source-div">
                <svg class="len-source-post-icon" aria-hidden="true">
                    <use xlink:href="#icon-dian"></use>
                    <li class="len-soure-li">
                        <!-- 获取当前标题 -->
                        来源标题： <?php echo get_the_title($ID); ?>
                    </li>
            </div>
            <div class="len-source-div">
                <svg class="len-source-post-icon" aria-hidden="true">
                    <use xlink:href="#icon-dian"></use>
                    <li class="len-soure-li">
                        <!-- 获取当前链接 -->
                        文章链接： <?php the_permalink(); ?>
                    </li>
            </div>
            <div class="len-source-div">
                <svg class="len-source-post-icon" aria-hidden="true">
                    <use xlink:href="#icon-dian"></use>
                    <li class="len-soure-li">
                        本文章转载地址<?php
                                //如果值为空则输出 '未知网站'
                                if ($Address != '') {
                                    echo $Address;
                                } else {
                                    echo '未知网站';
                                } ?>,是由<?php
                                        //如果值为空则输出 '未知作者'
                                        if ($Author_Name != '') {
                                            echo $Author_Name;
                                        } else {
                                            echo '未知作者';
                                        } ?>创造编写</li>
            </div>

            <div class="len-source-div">
                <svg class="len-source-post-icon" aria-hidden="true">
                    <use xlink:href="#icon-dian"></use>
                    <li class="len-soure-li">
                        来源地址：<?php
                                //如果值为空则输出 '未知网址'
                                if ($Link != '') {
                                    echo $Link;
                                } else {
                                    echo '未知网址';
                                } ?></li>
            </div>
        </div>
    </div>
<?php
}


/**
 * 获取文章缩略图 URL
 *
 * @param int $post_id 文章 ID
 *
 * @return string 缩略图 URL
 */
function Len_Thumbnail_Module($post_id = '')
{
    // 初始化缩略图变量
    $Thumbnail = '';

    // 获取 Len_Backlinks_Thumbnail 数据
    $Len_Backlinks_Thumbnail = get_post_meta($post_id, 'Len_Post_Module_Thumbnail_Sidebars', true);

    // 尝试反序列化 Len_Backlinks_Thumbnail，如果是字符串
    if (is_string($Len_Backlinks_Thumbnail)) {
        $Len_Backlinks_Thumbnail = unserialize($Len_Backlinks_Thumbnail);
    }

    // 获取 Len_Backlinks_thumbnail，如果存在
    $Len_Backlinks_thumbnail = isset($Len_Backlinks_Thumbnail['Len_Backlinks_Thumbnail']) ? $Len_Backlinks_Thumbnail['Len_Backlinks_Thumbnail'] : '';

    // 如果 Len_Backlinks_thumbnail 存在，赋值给 $Thumbnail
    if ($Len_Backlinks_thumbnail) {
        $Thumbnail = $Len_Backlinks_thumbnail;
    } else {
        // 获取文章内容
        $post_content = get_post_field('post_content', $post_id);

        // 使用正则表达式匹配文章内容中的第一个 img 标签的 src 属性
        preg_match('/<img[^>]*src=["\']([^"\']+)["\'][^>]*>/', $post_content, $matches);

        // 如果匹配到 img 标签，提取图片的 URL 赋值给 $Thumbnail
        if (!empty($matches)) {
            $Thumbnail = $matches[1];
        }

        // 如果文章内容中没有图片，则获取特色图片
        if (!$Thumbnail) {
            $thumbnail_id = get_post_thumbnail_id($post_id);
            if ($thumbnail_id) {
                $Thumbnail = wp_get_attachment_url($thumbnail_id);
            }
        }
    }

    // 如果最终没有获取到缩略图 URL，则返回默认 URL
    if (!$Thumbnail) {
        return '/wp-content/themes/Len-Free/Assets/Len-Images/post-background-1.png';
    }

    // 返回缩略图 URL
    return $Thumbnail;
}


<<<<<<< HEAD
function Len_Module_Switcher()
=======
/**
 * 根据条件执行相应的模块函数
 *
 * @param bool $User_Show 是否显示用户模块
 * @param bool $Copyright 是否显示版权模块
 * @param bool $Source 是否显示来源模块
 *
 * @return mixed 根据条件返回相应模块的内容
 */
function Len_Module_Switcher($User_Show = true, $Copyright = true, $Source = true)
>>>>>>> parent of 8dd72b3 (文章页模块基本完善)
{
    $User_Show = _Len_Post_Module('', '', '', 'Module_Switcher_User_Show');
    $Copyright = _Len_Post_Module('', '', '', 'Module_Switcher_Copyright');
    $Source = _Len_Post_Module('', '', '', 'Module_Switcher_Source');

<<<<<<< HEAD
    if ($User_Show = true) {
        echo '                                <div class="len-article-showcase-block">
=======
    // 获取相应的元数据键值
    $User_Show_key = _Len_Post_Module('', '', '', 'Module_Switcher_User_Show', $Post_ID);
    $Copyright_key = _Len_Post_Module('', '', '', 'Module_Switcher_Copyright', $Post_ID);
    $Source_key = _Len_Post_Module('', '', '', 'Module_Switcher_Source', $Post_ID);

    // 根据传入的参数，决定执行哪个函数
    if ($User_Show && $User_Show_key) {
        return User_Show_Static_Module();
    } elseif ($Copyright && $Copyright_key) {
        return Len_Modeule_Copyright();
    } elseif ($Source && $Source_key) {
        return Len_Source_Module();
    }
}

function Len_Modeule_Copyright()
{
    // 获取版权声明模块的背景图片路径
    $Img = _len('Post_Copyright_Module_1');

    // 获取版权声明的文本内容部分1
    $Text_1 = _len('Post_Copyright_Module_2');

    // 获取版权声明的文本内容部分2
    $Text_2 = _len('Post_Copyright_Module_3');
?>

    <!-- 版权声明模块的HTML结构开始 -->
    <div class="len-article-copyright">
        <legend class="copyright-title">版权声明</legend>

        <div class="copyright-block">
            <!-- 版权声明模块的背景图片 -->
            <img class="copyright-background-img" src="<?php echo $Img; ?>" alt="">

            <div class="copyright-min-blcok">
                <!-- 版权声明文本内容部分1 -->
                <div class="copyright-text-min">
                    <?php echo $Text_1; ?>
                </div>

                <hr>

                <!-- 版权声明文本内容部分2 -->
                <div class="copyright-remind">
                    <?php echo $Text_2; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- 版权声明模块的HTML结构结束 -->
<?php
}

/**
 * 获取用户静态模块
 *
 * 通过文章ID获取作者信息，并显示用户头像、名称、简介和文章发布时间。
 * 以及文章的浏览量、评论数量和点赞数量。
 */
function User_Show_Static_Module()
{
    // 获取当前文章ID
    $Post_ID = get_the_ID();

    // 获取文章作者ID
    $Author_ID = get_post_field('post_author', $Post_ID);

    // 获取作者信息
    $User = get_user_by('ID', $Author_ID);
    $User_avatar = get_avatar_url($Author_ID);
    $User_name = $User->display_name;
    $User_description = get_user_meta($Author_ID, 'description', true);

    // 获取文章发布时间
    $Post_Time = Len_Like_Comments_Browse_Time_Module('', '', '', $Post_ID);

    //获取浏览数量
    $Post_Views = Len_Like_Comments_Browse_Time_Module('', '', $Post_ID, '');

    //获取评论数量
    $Post_Comments = Len_Like_Comments_Browse_Time_Module('', $Post_ID, '', '');
    //获取喜欢数量
    $Post_Like = Len_Like_Comments_Browse_Time_Module($Post_ID, '', '', '');
?>
    <div class="len-article-showcase-block">
>>>>>>> parent of 8dd72b3 (文章页模块基本完善)
        <div class="len-article-user-min">
            <div class="len-article-avatar-min">
                <img class="len-article-avatar-block" src="/wp-content/themes/Len-Free/Assets/Len-Images/user-avatar.jpg" alt="">
            </div>
            <div class="len-article-name-min">
                <p class="len-article-name-blcok">青桔柠檬</p>
                <p class="len-article-introduce-blcok">『青桔柠檬，一个长在树上酸酸的柠檬』 </p>
            </div>
        </div>
        <div class="len-article-stats-min">
            <p class="len-article-time-block">
                <svg class="len-stats-post-icon" aria-hidden="true">
                    <use xlink:href="#icon-shijianzhouqi"></use>
                </svg>8天前
            </p>
            <div class="len-article-stats-all-min">
                <span class="len-stats-browse-block">
                    <svg class="len-stats-post-icon" aria-hidden="true">
                        <use xlink:href="#icon-liulan"></use>
<<<<<<< HEAD
                    </svg>64</span>
=======
                    </svg><?php echo $Post_Views ?></span>
>>>>>>> parent of 8dd72b3 (文章页模块基本完善)
                <span class="len-stats-comments-block">
                    <svg class="len-stats-post-icon" aria-hidden="true">
                        <use xlink:href="#icon-pinglun"></use>
                    </svg>12</span>
                <span class="len-stats-like-block">
                    <svg class="len-stats-post-icon" aria-hidden="true">
                        <use xlink:href="#icon-xihuan"></use>
                    </svg>30</span>
            </div>
        </div>
<<<<<<< HEAD
    </div>';
    } elseif ($Copyright = true) {
    } elseif ($Copyright = true) {
=======
    </div>
<?php
}


/**
 * 获取文章发布时间的友好显示
 *
 * @param int $post_id 文章ID
 *
 * @return string 时间提示
 */
function Len_Post_Time_Module($Post_id = '')
{
    global $Post;

    // 如果未提供文章ID，则使用当前文章的ID
    if (!$Post_id) {
        $Post_id = $Post->ID;
    }

    // 获取文章的发布时间（以Unix时间戳格式表示）
    $post_time = strtotime(get_the_time('Y-m-d H:i:s', $Post_id));

    // 获取当前时间的时间戳
    $current_time = current_time('timestamp');

    // 计算时间差（单位：秒）
    $diff = abs($current_time - $post_time);

    // 时间差对应的友好提示
    if ($diff < 60) {
        $time = sprintf(_n('%s秒前', '%s秒前', $diff), $diff);
    } elseif ($diff < 3600) {
        $mins = floor($diff / 60);
        $time = sprintf(_n('%s分钟前', '%s分钟前', $mins), $mins);
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        $time = sprintf(_n('%s小时前', '%s小时前', $hours), $hours);
    } elseif ($diff < 2592000) {
        $days = floor($diff / 86400);
        $time = sprintf(_n('%s天前', '%s天前', $days), $days);
    } elseif ($diff < 31536000) {
        $months = floor($diff / 2592000);
        $time = sprintf(_n('%s个月前', '%s个月前', $months), $months);
    } else {
        $years = floor($diff / 31536000);
        $time = sprintf(_n('%s年前', '%s年前', $years), $years);
    }

    return $time;
}

/**
 * Len_Like_Comments_Browse_Time_Module 函数用于根据传入的参数获取相应的内容。
 *
 * @param string $Like     点赞相关参数。
 * @param string $Comments 评论相关参数。
 * @param string $Browse   浏览相关参数。
 * @param string $Time     时间相关参数。
 *
 * @return string 返回根据参数获取的内容，如果没有匹配的情况，返回空字符串。
 */
function Len_Like_Comments_Browse_Time_Module($Like = '', $Comments = '', $Browse = '', $Time = '')
{
    // 判断 $Browse 是否有值，如果有则返回对应的内容
    if ($Browse !== '') {
        // 获取文章的点赞次数，如果存在则返回，否则返回 '0'
        return Len_post_views($Browse);
    } elseif ($Comments !== '') {
        // 处理 $Comments 的情况
        // 返回对应的内容或执行其他逻辑
        return get_comments_number($Comments);
    } elseif ($Like !== '') {
        // 处理 $Like 的情况
        // 返回对应的内容或执行其他逻辑
        return get_post_meta($Like, 'bigfa_ding', true) ? get_post_meta($Like, 'bigfa_ding', true) : '0';
    } elseif ($Time !== '') {
        // 处理 $Time 的情况
        // 返回对应的内容或执行其他逻辑
        return Len_Post_Time_Module($Time);
    }

    // 如果没有匹配的情况，返回空字符串
    return '';
}





/**
 * 获取文章浏览次数
 *
 * @param int $post_id 文章ID
 * @return int 浏览次数
 */
function Len_post_views($post_id)
{
    // 定义浏览次数的存储键名
    $count_key = 'views';

    // 从文章的元数据中获取浏览次数
    $count = get_post_meta($post_id, $count_key, true);

    // 如果浏览次数为空，则设置为0，并更新元数据
    if ($count === '') {
        $count = 0;
        update_post_meta($post_id, $count_key, $count);
    }

    // 返回文章的浏览次数
    return $count;
}

/**
 * 设置更新文章的阅读次数
 *
 * @param int $post_id 文章ID
 */
function Set_post_views($post_id)
{
    // 定义浏览次数的存储键名
    $count_key = 'views';

    // 只在单页和文章页面更新阅读次数
    if (is_single() || is_page()) {
        // 获取当前文章的浏览次数
        $count = get_post_meta($post_id, $count_key, true);

        // 如果浏览次数为空，将其设置为0，否则加1
        $count = $count === '' ? 0 : $count + 1;

        // 更新文章的浏览次数元数据
        update_post_meta($post_id, $count_key, $count);
    }
}

// 使用 wp_head 钩子将 set_post_views 函数添加到文章页面头部
add_action('wp_head', 'Set_post_views');


// 注册 AJAX 动作，允许非登录用户调用 bigfa_like 函数
add_action('wp_ajax_nopriv_bigfa_like', 'bigfa_like');

// 注册 AJAX 动作，允许登录用户调用 bigfa_like 函数
add_action('wp_ajax_bigfa_like', 'bigfa_like');

/**
 * 处理点赞的 AJAX 回调函数
 */
function bigfa_like()
{
    global $wpdb, $post;

    // 从前端传递的 POST 数据中获取文章 ID 和操作类型
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];

    // 判断操作类型是否为 'ding'
    if ($action == 'ding') {
        // 获取当前文章的点赞次数
        $bigfa_raters = get_post_meta($id, 'bigfa_ding', true);

        // 设置 Cookie 以避免重复点赞
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // 使 Cookie 在 localhost 上工作
        setcookie('bigfa_ding_' . $id, $id, $expire, '/', $domain, false);

        // 更新点赞次数
        if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
            update_post_meta($id, 'bigfa_ding', 1);
        } else {
            update_post_meta($id, 'bigfa_ding', ($bigfa_raters + 1));
        }

        // 返回更新后的点赞次数
        echo get_post_meta($id, 'bigfa_ding', true);
    }

    // 终止 WordPress 请求处理
    die;
}


/**
 * Len_Post_Tag function.
 *
 * 输出当前文章的标签列表，包括标签名称和链接。
 */
function Len_Post_Tag_Module()
{
    // 获取当前文章的标签列表
    $tags = get_the_tags();

    // 检查是否存在标签
    if ($tags) {
        // 遍历每个标签
        foreach ($tags as $tag) {
            // 输出每个标签的名称和链接
            echo '<a class="len-link-all" href="' . esc_url(get_tag_link($tag->term_id)) . '"><li class="article-tag-li">' . esc_html($tag->name) . '</li></a>';
        }
    }
}



/**
 * Len_parent_category function.
 *
 * 输出当前文章的主要（顶级）分类名称和链接。
 *
 * @param int $Post_ID 文章ID，默认为空，使用当前文章的ID。
 */
function Len_Parent_Category_Module($Post_ID = '')
{
    // 获取当前文章的分类列表
    $categories = get_the_category($Post_ID);

    if ($categories) {
        // 只考虑第一个分类，因为通常一个文章只属于一个主要分类
        $parent_category = $categories[0];

        // 循环获取父级分类，直到没有父级分类为止
        while ($parent_category->parent) {
            $parent_category = get_category($parent_category->parent);
        }

        $category_name = $parent_category->name; // 获取父级分类的名称
        $category_link = get_category_link($parent_category->term_id); // 获取父级分类的链接

        // 输出分类名称和链接
        if ($category_name && $category_link) {
            echo '<div class="article-parent-classification"><span><a class="len-link-all" href="' . esc_url($category_link) . '">' . esc_html($category_name) . '</a></span></div>';
        } else {
            echo esc_html($category_name);
        }
    }
}


add_filter('pre_option_link_manager_enabled', '__return_true');

// 通过过滤器修改链接管理菜单名称
function Len_modify_link_manager_name($name)
{
    return '友情链接';
}
add_filter('admin_menu', 'Len_modify_link_manager_menu');

// 修改链接管理菜单
function Len_modify_link_manager_menu()
{
    global $menu;

    // 遍历菜单项，找到原始的“链接”菜单
    foreach ($menu as $key => $value) {
        if ($value[0] == '链接') {
            // 将原始的“链接”菜单名称修改为“友情链接”
            $menu[$key][0] = '友情链接';
            break;
        }
    }
}


function Len_Mutaual_Module($wx = true, $zfb = true)
{
    $Wx_Qr = _len('Post_Pay_Img_Module_2');
    $Zfb_Qr = _len('Post_Pay_Img_Module_1');

    if ($wx === true) {
        return $Wx_Qr;
    } elseif ($zfb === true) {
        return $Zfb_Qr;
>>>>>>> parent of 8dd72b3 (文章页模块基本完善)
    }
}
