<<<<<<< HEAD
=======
<form method="post" id="commentform" class="comment-form">
    <div class="len-post-comments">
        <div class="len-comments-blcok">
            <div class="len-comments-main">
                <div class="len-user-comments-avatar-blcok">
                    <img class="user-comments-avatar" src="/wp-content/themes/Len-Free/Assets/Len-Images/user-avatar.jpg" alt="">
                    <p class="user-comments-name-blcok">青桔柠檬</p>
                </div>
                <div class="len-user-comments-content">
                    <?php if (is_user_logged_in()) : ?>
                    <?php else : ?>
                        <div class="len-comments-input-block">
                            <input class="len-comments-input lan-len-comments-inputcolour" placeholder="昵称" type="text" name="author" id="author" value="<?php echo esc_attr($commenter['comment_author']); ?>" <?php if ($req) echo 'required'; ?>>
                            <input class="len-comments-input lan-len-comments-inputcolour" placeholder="邮箱" type="email" name="email" id="email" value="<?php echo esc_attr($commenter['comment_author_email']); ?>" <?php if ($req) echo 'required'; ?>>
                            <input class="len-comments-input lan-len-comments-inputcolour" placeholder="网站" type="url" name="url" id="url" value="<?php echo esc_attr($commenter['comment_author_url']); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="len-comments-textarea">
                        <textarea class="len-comments-textarea-block lan-len-comments-inputcolour" name="comment" id="comment" rows="5" placeholder="下面由我我简单喵两句"></textarea>
                        <div class="len-comments-submit-button-block">
                            <input id="submit" type="submit" name="submit" value="提交评论" class="comments-submit-button comments-submit-buttoneffect"></input>
                        </div>
                    </div>
                    <!-- <div class="len-comments"><span>表情</span></div> -->
                </div>
            </div>
            <div class="len-comments-part"></div>
        </div>
    </div>
    <p class="form-submit">
        <?php comment_id_fields(); ?>
    </p>
    <?php do_action('comment_form', $post->ID); ?>
</form>
<div id="comments" class="len-comments-content">
    <?php
    // 防止直接加载 comments.php
    if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
        die('Please do not load this page directly. Thanks!');
    }

    // 检查是否需要密码才能查看评论
    if (post_password_required()) { ?>
        <p class="nocomments">This post is password protected. Enter the password to view comments.</p>
    <?php
        return; // 终止脚本执行
    } ?>

    <?php if (have_comments()) : ?>
        <div id="comments" class="len-have-comments-block-min">
            <ol class="len-comments-ol-block">
                <?php wp_list_comments(array('callback' => 'Len_Comments_Module',)); ?>
            </ol>
        </div>
    <?php else : ?>
        <div class="len-comments-block-min">
            <p class="len-no-comments-block-content">貌似没有新评论欸</p>
        </div>
    <?php endif; ?>
</div>
<div class="len_comment_pagination_block_all">
    <?php
    $post_info = get_post(get_the_ID(), ARRAY_A);
    if (!$post_info['comment_count']) {
    ?>
    <?php }
    if ($post_info['comment_count']) {
        paginate_comments_links(array(
            'prev_next' => true
        ));
    }
    ?>
</div>
<script>
    jQuery(document).ready(function($) {
        $('#commentform').submit(function(event) {
            event.preventDefault();

            // Serialize the form data
            var formData = $(this).serialize();

            $.ajax({
                url: '<?php echo esc_url(site_url('/wp-comments-post.php')); ?>',
                method: 'POST',
                data: formData,
                dataType: 'html',
                success: function(response) {
                    // Optional: You can do something with the response HTML if needed
                    console.log(response);

                    // Optional: Display a success message
                    alert('评论成功！');

                    // Optional: Clear the form fields after successful submission
                    $('#commentform')[0].reset();

                    // Optional: You may reload the comments section to show the new comment
                    $('#comments').load(location.href + ' #comments');
                },
                error: function(error) {
                    // Optional: Handle errors
                    console.error('Error:', error);
                },
            });
        });
    });
</script>
>>>>>>> parent of 8dd72b3 (文章页模块基本完善)
