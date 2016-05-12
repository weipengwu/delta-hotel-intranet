                <footer id="page-footer">
                    <div class="row">
                        <div class="feedback">
                            <form action="" method="post" style="text-align:right">
                                <h4><? _e("Welcome to the new DEN. We'd love to hear your feedback.", "deltamain");?></h4>
                                <? //$categories = get_categories('exclude=1');?>
<!--                                 <select class="feedback_category" name="feedback_category">
                                     <option><? _e('Choose a category', 'deltamain');?></option>
                                     <? foreach ($categories as $category) :?>
                                     <option value="<? echo $category->name; ?>"><? echo $category->name ?></option>
                                     <? endforeach;?>
                                </select> -->
                                <input type="text" name="feedback_comment" placeholder="<? _e('Enter your question or feedback', 'deltamain');?>" class="feedback_comment">
                                <input class="submit" name="submit_feedback" type="submit" value="<? _e('Submit', 'deltamain');?>">
                            </form>
                        </div>
                        <div class="help">
                            <h4><? _e('Need More Help?', 'deltamain');?></h4>
                            <ul>
                                <li><a target="_blank" href="https://deltahotels.service-now.com/navpage.do"><? _e('Submit a ticket','deltamain');?></a></li>
                                <li><a class="contactadmin" href="mailto:dhr.denissues.grp@deltahotels.com"><? _e('Contact the administrator','deltamain');?></a></li>
                            </ul>
                        </div>
                        <!-- <div id="contactadmin" title="Contact the administrator">
                            <form id="contact_admin_form">
                                <label>Your Name*:</label>
                                <input type="text" name="yourname">
                                <label>Your Email*:</label>
                                <input type="text" name="youremail">
                                <label>Message*:</label>
                                <textarea name="message"></textarea>

                            </form>
                        </div> -->
                        <!-- <div id="thankyou" title="Thank you">
                            <p>Your message has been sent successfully.</p>
                        </div>
                        <div id="errormsg" title="Error">
                            <p>An error occured. Please try again.</p>
                        </div> -->
                        <div class="search">
                            <section id="footer-search">
                                <h4><? _e('Search the DEN','deltamain');?></h4>
                                <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>globalsearch/">
                                    <div>
                                        <input type="text" value="" name="mssearch" id="s" placeholder="<? _e('Search','deltamain');?>" />
                                        <button>Submit</button>
                                    </div>
                                </form>
                            </section>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <?php wp_footer(); ?>
        <div id="dialog" class='dialog-language' title="<?php _e('Intranet Settings','deltamain');?>">
             <form>
            <fieldset>
            <legend class="title"><?php _e('Language','deltamain');?></legend>
            
            <input type="radio" name="language" <?= DenUser::get_meta_field('language') == 'en' ? 'checked' : '' ?> value="en"  id="english" class="text ui-widget-content ui-corner-all">
            <label for="english">English</label>
            
            <input type="radio" name="language" <?= DenUser::get_meta_field('language') == 'fr' ? 'checked' : '' ?> value="fr" id="french" class="text ui-widget-content ui-corner-all">
            <label for="french">Français</label>
            </fieldset>
            </form>
        </div>
        <? $text = __('Subscribe to %s', 'deltamain' );?>
        <div id="subscribe" class='dialog-language' title="<? echo sprintf($text, get_bloginfo( 'name' )); ?>">
            <?php $text3 = __('%s News will be added to your Delta Headlines. If you would also like to receive notifications of new posts by email, check the box below.', 'deltamain'); ?>
            <!-- <p><?php echo sprintf($text3, get_bloginfo( 'name' )); ?></p> -->
            <form>
            <!-- <!-- <input type="checkbox" id="subscribed" name="subscribed" <?= DenUser::is_subscribed(get_current_blog_id()) ? 'checked' : '' ?> class="text ui-widget-content ui-corner-all" checked>
            <? $text2 = __('Send me email notifications when there are new %s headlines', 'deltamain');?>
            <label class="checkbox" for="subscribed"><?php echo sprintf($text2, get_bloginfo( 'name' ))?></label> --> 
            </form>
        </div>
        <div id="manage_subscribe" class='dialog-language' title="My Delta Headlines Subscriptions">
            <form>
                <? $sites = wp_get_sites(); ?>
                <table>
                    <tr blogid="1">
                    <?php $details = get_blog_details('1');?>
                        <td class="name"><?= $details->blogname ?></td>
                        <td class="subscribed disabled"><? _e('Subscribed', 'deltamain');  ?></td>
                        <td class="switch disabled">
                            <div class="off">Off</div><div class="on">On</div>
                        </td>
                    </tr>
                <? //$sites = DenUser::field('subscribed_blog_ids');?>

                <? foreach ($sites as $site): ?>
                    <? $details = get_blog_details($site['blog_id']); ?>
                    <? if($site['blog_id'] == 1) continue;?>
                    <? if(DenUser::is_member($site['blog_id'])):?>
                        <tr blogid="<?= $site['blog_id'] ?>">
                            <td class="name"><?= $details->blogname ?></td>
                            <td class="subscribed disabled"><? _e('Subscribed', 'deltamain');  ?></td>
                            <td class="switch disabled">
                                <input type="hidden" name="blog_id[<?= $site['blog_id']; ?>]" value="1">
                                <div class="off">Off</div><div class="on">On</div>
                            </td>
                        </tr>
                    <? elseif(DenUser::is_subscribed($site['blog_id'])): ?>
                    <tr blogid="<?= $site['blog_id']; ?>">
                        <td class="name"><?= $details->blogname ?></td>
                        <td class="subscribed">Unsubscribe</td>
                        <td class="switch">
                            <input type="hidden" name="blog_id[<?= $site['blog_id']; ?>]" value="1">
                            <div class="off">Off</div><div class="on">On</div>
                        </td>
                    </tr>
                    <? endif;?>
                <? endforeach; ?>
                </table>

            </form>
        </div>

        <script type="text/javascript">

        <? if (DenUser::is_subscribed(get_current_blog_id())): ?>
            current_subscribed = true;
        <? else: ?>
            current_subscribed = false;
        <? endif; ?>
        <?php 
            global $post;

            if(DenUser::field('language') == 'en'){
                if (isset($_REQUEST['blog_id']) && isset($_REQUEST['tid'])) {
                    switch_to_blog($_REQUEST['blog_id']);
                    $lang_post_id = icl_object_id($_REQUEST['tid'], 'post', FALSE, 'fr');
                    restore_current_blog();
                }else{
                    $lang_post_id = icl_object_id($post->ID, get_post_type($post->ID), FALSE, 'fr');
                }
            }else{
                if (isset($_REQUEST['blog_id']) && isset($_REQUEST['tid'])){
                    switch_to_blog($_REQUEST['blog_id']);
                    $lang_post_id = icl_object_id($_REQUEST['tid'], 'post', FALSE, 'en');
                    restore_current_blog();
                }else{
                    $lang_post_id = icl_object_id($post->ID, get_post_type($post->ID), FALSE, 'en');
                }
            }
            
            $lang_permalink = get_permalink($lang_post_id);
        ?>
            var lang_url = "<?php echo $lang_permalink; ?>";

            dialog_save_text = "<?php echo _e('Save','deltamain'); ?>";
            dialog_cancel_text = "<?php echo _e('Cancel','deltamain'); ?>";
            dialog_update_text = "<?php echo _e('Update','deltamain'); ?>";

        </script>

        <script>
            var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-21243303-1']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();
          
        </script>
    </body>
</html>
