<?
if($_POST['submit_feedback']){

    $message = 'Feedback: '.$_POST['feedback_comment']."\n";

    wp_mail('dhr.denissues.grp@deltahotels.com', 'Feedback', $message);

}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=1214"/>
    <title><?php echo get_bloginfo( 'name' ); ?></title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/bower_components/slick-carousel/slick/slick.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/stylesheets/app.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/stylesheets/custom.css">
    <script src="<?php echo get_template_directory_uri(); ?>/js/Site.date.js"></script>
    <?php wp_head();?>
</head>
<body <?php body_class(); ?>>

<div id="page-wrapper" class="row">
    <div class="large-12 columns">
        <header id="page-header">
            <a href="<?php echo get_site_url(1); ?>"><h1 id="logo">DEN</h1></a>
            <nav id="profile-nav">
                <ul>
                    <li><a href="<?php echo get_site_url(1); ?>"><?php _e('Employee Network','deltamain');?></a></li>
                    <li class="profile hasSub" >
                    <?php echo get_avatar( get_current_user_id(), 36 ); ?>
                        <a href="#"><?php _e('Hello','deltamain');?>, <span class="profile-name"><?= DenUser::field('user_firstname') ?></span></a>
                        
                        <div id="navMenu_profile" class="navMenu">
                            <ul>
                                <li><a href="https://deltahotels.okta.com/enduser/settings?fromLogin=true"><?php _e('My Delta Profile','deltamain');?></a></li>
                                <li id="opener"><a href="#"><?php _e('Intranet Settings','deltamain');?></a></li>
                                <?php if(current_user_can('read')):?>
                                <li><a href="/wp-admin"><?php _e('Administration Panel','deltamain');?></a></li>
                                <?php endif;?>
                                <li><a href="<? echo wp_logout_url();?>"><?php _e('Log Out','deltamain');?></a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            <nav id="global-nav">
                <ul>
                    <!-- <li><a href="#"><?php _e('Social','deltamain');?></a></li> -->
                    <li><a href="https://www.deltahotels.com" target="_blank"><?php _e('DeltaHotels.com','deltamain');?></a></li>
                    <li class="directory">
                        <a href="#"><?php _e('Employee Directory','deltamain');?></a>
                        <div class="employee_directory" id="employee_list">
                            <form class="directory_search" method="post" action="">
                                <span><? _e('Search','deltamain');?></span>
                                <input type="text" class="search" val="" name="d_search">
                            </form>
                            <div class="directory_results">
                                Results
                            </div>
                            <div class="directory_instruction">
                                <p>Type in a search phrase above to find Delta team members at corporate or any hotel.</p>
                                <p>You can search by:</p>
                                <ul>
                                    <li>- Username</li>
                                    <li>- First Name</li>
                                    <li>- Last Name</li>
                                    <li>- Email</li>
                                    <li>- Property Code</li>
                                    <li>- Property Name</li>
                                    <li>- Title</li>
                                    <li>- Department</li>
                                    <li>- Work Phone</li>
                                </ul>
                            </div>
                            <div class="loading" style="display:none; text-align: center; padding: 10px;"><img src="<?php echo get_template_directory_uri();?>/images/ajax-loader.gif" style="vertical-align: middle;" alt="loading"></div>
                            <ul class="list">
                                <!-- <li>
                                    <div class="profile_img">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/fpo/department_team.jpg">
                                    </div>
                                    <div class="profile_info">
                                        <h3 class="name">Joe Public</h3>
                                        <span>Specialist</span>
                                        <span>Delta Toronto</span>
                                        <span>Email | 416.123.1234</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="profile_img">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/fpo/department_team.jpg">
                                    </div>
                                    <div class="profile_info">
                                        <h3 class="name">Dominique Renfrew</h3>
                                        <span>Specialist</span>
                                        <span>Delta Toronto</span>
                                        <span>Email | 416.123.1234</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="profile_img">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/fpo/department_team.jpg">
                                    </div>
                                    <div class="profile_info">
                                        <h3 class="name">John Smith</h3>
                                        <span>Specialist</span>
                                        <span>Delta Toronto</span>
                                        <span>Email | 416.123.1234</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="profile_img">
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/fpo/department_team.jpg">
                                    </div>
                                    <div class="profile_info">
                                        <h3 class="name">IT Editor</h3>
                                        <span>Specialist</span>
                                        <span>Delta Toronto</span>
                                        <span>Email | 416.123.1234</span>
                                    </div>
                                </li> -->
                            </ul>
                        </div>
                    </li>
                    <li><a href="https://drive.google.com/" target="_blank"><?php _e('Google Drive','deltamain');?></a></li>
                    <? if(DenUser::field('language') == 'en'):?>
                        <li class="help"><a href="//den.deltahotels.com/help">Help</a></li>
                    <? else: ?>
                        <li class="help"><a href="//den.deltahotels.com/aide">Aide</a></li>
                    <? endif;?>
                </ul>
            </nav>
            <nav id="main-nav">
                    <ul class="clearfix">
                        <li><a href="<?php echo get_site_url(1); ?>"><?php _e('Home','deltamain');  ?></a></li>

                        <li class="hasSub notme">
                            <a href="#"><?php echo _e('Apps','deltamain');  ?></a>
                            <div class="navMenu" style="position: absolute; padding-left: 20px; padding-top: 10px;">
                                <iframe src="<?= get_site_url(1) ?>/wp-content/themes/deltamaster/okta_apps.php" style="height: 235px; width: 320px; display: none;" frameborder="0" ></iframe>
                            </div>
                        </li>

                        <li class="hasSub">
                            <a href="#"><?php echo _e('Departments','deltamain');  ?></a>
                            
                            <div class="navMenu iconItem" id="navMenu_departments">
                                <div class="inner">
                                    <div class="column-2">
                                        <div class="col col-1">
                                            <a class="item" href="//asset.den.deltahotels.com">
                                                <div class="image"><img width="22" height="22" alt="nav app icon" src="/wp-includes/images/nav_app_icon.png"></div>
                                                
                                                <div class="content">
                                                    <div class="title"><? _e('Asset Management', 'deltamain'); ?></div>
                                                    <!--<div class="copy">Check out Google Drive</div>-->
                                                </div>
                                            </a>

                                            <a class="item" href="//dc.den.deltahotels.com">
                                                <div class="image"><img width="22" height="22" alt="nav app icon" src="/wp-includes/images/nav_app_icon.png"></div>
                                                
                                                <div class="content">
                                                    <div class="title"><? _e('Design and Construction', 'deltamain');?></div>
                                                    <!--<div class="copy">Check out Google Groups</div>-->
                                                </div>
                                            </a>

                                            <a class="item" href="//finance.den.deltahotels.com">
                                                <div class="image"><img width="22" height="22" alt="nav app icon" src="/wp-includes/images/nav_app_icon.png"></div>
                                                
                                                <div class="content">
                                                    <div class="title"><? _e('Finance','deltamain');?></div>
                                                    <!--<div class="copy">Check out Secure Billing</div>-->
                                                </div>
                                            </a>

                                            <a class="item" href="//grs.den.deltahotels.com">
                                                <div class="image"><img width="22" height="22" alt="nav app icon" src="/wp-includes/images/nav_app_icon.png"></div>
                                                
                                                <div class="content">
                                                    <div class="title"><? _e('Global Reservation Services','deltamain');?></div>
                                                    <!--<div class="copy">Check out your MyExpense Report</div>-->
                                                </div>
                                            </a>

                                            <!--<a class="item" href="#">
                                                <div class="image"><img width="22" height="22" alt="nav app icon" src="/wp-includes/images/nav_app_icon.png"></div>
                                                
                                                <div class="content">
                                                    <div class="title">Home Page</div>
                                                    <div class="copy">Check out your Google Mail</div>
                                                </div>
                                            </a>-->

                                            <a class="item" href="//it.den.deltahotels.com">
                                                <div class="image"><img width="22" height="22" alt="nav app icon" src="/wp-includes/images/nav_app_icon.png"></div>
                                                
                                                <div class="content">
                                                    <div class="title"><? _e('Technology','deltamain');?></div>
                                                    <!--<div class="copy">Check out Employee Discounts</div>-->
                                                </div>
                                            </a>
                                            
                                            <a class="item" href="//legal.den.deltahotels.com">
                                                <div class="image"><img width="22" height="22" alt="nav app icon" src="/wp-includes/images/nav_app_icon.png"></div>
                                                
                                                <div class="content">
                                                    <div class="title"><? _e('Legal','deltamain');?></div>
                                                    <!--<div class="copy">Check out your Google Calendar</div>-->
                                                </div>
                                            </a>
                                            
                                            
                                        </div>
                                        
                                        <div class="col col-2">
                                            <a class="item" href="//marketing.den.deltahotels.com">
                                                <div class="image"><img width="22" height="22" alt="nav app icon" src="/wp-includes/images/nav_app_icon.png"></div>
                                                
                                                <div class="content">
                                                    <div class="title"><? _e('Marketing','deltamain');?></div>
                                                    <!--<div class="copy">Check out Medallia</div>-->
                                                </div>
                                            </a>
                                            
                                            <a class="item" href="//corporate.den.deltahotels.com">
                                                <div class="image"><img width="22" height="22" alt="nav app icon" src="/wp-includes/images/nav_app_icon.png"></div>
                                                
                                                <div class="content">
                                                    <div class="title"><? _e('Office Services','deltamain');?></div>
                                                    <!--<div class="copy">Check out Delta Privilege</div>-->
                                                </div>
                                            </a>
                                            
                                            <a class="item" href="//ops.den.deltahotels.com">
                                                <div class="image"><img width="22" height="22" alt="nav app icon" src="/wp-includes/images/nav_app_icon.png"></div>
                                                
                                                <div class="content">
                                                    <div class="title"><? _e('Operations','deltamain');?></div>
                                                    <!--<div class="copy">Check out Talent Nest Employee Portal</div>-->
                                                </div>
                                            </a>

                                            <!--<a class="item" href="//ops-acc.den.deltahotels.com">
                                                <div class="image"><img width="22" height="22" alt="nav app icon" src="/wp-includes/images/nav_app_icon.png"></div>
                                                
                                                <div class="content">
                                                    <div class="title">Operations Accounting</div>
                                                    <div class="copy">Check out Environment Management Portal</div>
                                                </div>
                                            </a>-->

                                            <a class="item" href="//pr.den.deltahotels.com">
                                                <div class="image"><img width="22" height="22" alt="nav app icon" src="/wp-includes/images/nav_app_icon.png"></div>
                                                
                                                <div class="content">
                                                    <div class="title"><? _e('People Resources','deltamain');?></div>
                                                    <!--<div class="copy">Check out Destinations</div>-->
                                                </div>
                                            </a>
                                            
                                            <a class="item" href="//revenue.den.deltahotels.com">
                                                <div class="image"><img width="22" height="22" alt="nav app icon" src="/wp-includes/images/nav_app_icon.png"></div>
                                                
                                                <div class="content">
                                                    <div class="title"><? _e('Revenue Management','deltamain');?></div>
                                                    <!--<div class="copy">Check out Delta STEP Program</div>-->
                                                </div>
                                            </a>  

                                            <a class="item" href="//sales.den.deltahotels.com">
                                                <div class="image"><img width="22" height="22" alt="nav app icon" src="/wp-includes/images/nav_app_icon.png"></div>
                                                
                                                <div class="content">
                                                    <div class="title"><? _e('Sales','deltamain');?></div>
                                                    <!--<div class="copy">Check out Talent Nest Management System</div>-->
                                                </div>
                                            </a>                                          
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!--<li><a href="#"><?php echo _e('Hotels','deltamain');  ?></a></li>-->

                        <!-- <li class="hasSub">
                            <a href="#" id="mainNav_committees"><?php _e('Committees','deltamain');  ?></a>
                            <div class="navMenu column-2 greyBlue" id="navMenu_committees">
                                <div class="col col-1"> -->
                                    <?php 
                                    //   global $wpdb;
                                    // $table= $wpdb->blogs;
                                    // $sql= "select blog_id from ".$table ." where public='1'" ;
                                    // $blog_query= $wpdb->get_results($sql);
                                    // foreach($blog_query as $blog_group){
                                    //     $blogs_pregroup[] = $blog_group->blog_id;
                                    //     }
                                    //                     $exclude = array(1,2,3,4 );
                                    //                                     //print_r($exclude);
                                    //                                 $blogs_group = array_diff($blogs_pregroup, $exclude);
                                    //                                 $prgogram_group = array_values($blogs_group);
                                                                    
                                                                        ?>


                                    <?php /**/
                                    // $args = array(
                                    //     'network_id' => $wpdb->siteid,
                                    //     'public'     => null,
                                    //     'archived'   => null,
                                    //     'mature'     => null,
                                    //     'spam'       => null,
                                    //     'deleted'    => null,
                                    //     'limit'      => 100,
                                    //     'offset'     => 10,
                                    // );
                                    // $blogs= wp_get_sites( $args );
                                    // if ( 0 < count( $blogs ) ) :
                                    //     foreach( $blogs as $blog ) : 
                                    //         switch_to_blog( $blog[ 'blog_id' ] );

                                    //         if ( get_theme_mod( 'show_in_home', 'on' ) !== 'on' ) {
                                    //             continue;
                                    //         }

                                    //         $description  = get_bloginfo( 'description' );
                                    //         $blog_details = get_blog_details( $blog[ 'blog_id' ] );
                                            ?>
                                            
                                            <!-- <div id="ctab-panel-<?php echo $blog['blog_id'];?>" class="inner ctab-panel">
                                                    <div class="title"><?php bloginfo('name');?></div>
                                                <p>
                                                     <?php echo $description; ?>
                                                </p>

                                                
                                            </div> -->
                                            <?php //restore_current_blog(); ?>
                                    <?php //endforeach; 
                                    // endif; restore_current_blog();   /**/ ?>
                                <!-- </div>
                                
                                <div class="col col-2">
                                    <div class="inner">
                                        <ul>
                                            <li class="ctab" rel="#ctab-panel-11"><a href="http://engagement.den.deltahotels.com ">Employee Engagement</a></li>
                                            <li class="ctab" rel="#ctab-panel-12"><a href="http://erc.den.deltahotels.com">Employee Representative</a></li>
                                            <li class="ctab" rel="#ctab-panel-13"><a href="http://green.den.deltahotels.com">Green Committee</a></li>
                                            <li class="ctab" rel="#ctab-panel-14"><a href="http://isc.den.deltahotels.com">Intranet Steering Committee</a></li>
                                            <li class="ctab" rel="#ctab-panel-15"><a href="http://jhsc.den.deltahotels.com">Join Health and Safety</a></li>
                                            <li class="more"><a href="<?php echo get_blog_option($wpdb->siteid, 'siteurl'); ?>/view-all/?site_cat=3">View All</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li> -->
                        
                        <li class="separator">&nbsp;</li>
                        
                        <li class="hasSub">
                            <a href="#" id="mainNav_programs"><?php _e('Programs and Promotions','deltamain');  ?></a>
                            
                            <div class="navMenu column-2 greyBlue" id="navMenu_programs">
                                <div class="col col-1">
        
                                    <div id="mtab-panel-15" class="inner mtab-panel">
                                        <div class="title"><?php echo get_blog_option('15', 'blogname');?></div>
                                        <p>
                                             <?php echo get_blog_option('15', 'blogdescription');?>
                                        </p>

                                    </div>
                                    <div id="mtab-panel-16" class="inner mtab-panel">
                                        <div class="title"><?php echo get_blog_option('16', 'blogname');?></div>
                                        <p>
                                             <?php echo get_blog_option('16', 'blogdescription');?>
                                        </p>

                                    </div>
                                    <div id="mtab-panel-17" class="inner mtab-panel">
                                        <div class="title"><?php echo get_blog_option('17', 'blogname');?></div>
                                        <p>
                                             <?php echo get_blog_option('17', 'blogdescription');?>
                                        </p>

                                    </div>
                                    <div id="mtab-panel-18" class="inner mtab-panel">
                                        <div class="title"><?php echo get_blog_option('18', 'blogname');?></div>
                                        <p>
                                             <?php echo get_blog_option('18', 'blogdescription');?>
                                        </p>

                                    </div>
                                    <div id="mtab-panel-26" class="inner mtab-panel">
                                        <div class="title"><?php echo get_blog_option('26', 'blogname');?></div>
                                        <p>
                                             <?php echo get_blog_option('26', 'blogdescription');?>
                                        </p>

                                    </div>
   <!--                                  <div id="mtab-panel-20" class="inner mtab-panel">
                                        <div class="title"><?php echo get_blog_option('20', 'blogname');?></div>
                                        <p>
                                             <?php echo get_blog_option('20', 'blogdescription');?>
                                        </p>

                                    </div> -->

                                </div>
                                
                                <div class="col col-2">
                                    <div class="inner">
                                    <ul>
                                    <li class="mtab" rel="#mtab-panel-15">
                                <a href="//deltaprivilege.den.deltahotels.com/">Delta Privilege</a></li>
                                    <li class="mtab" rel="#mtab-panel-16">
                                    <a href="//simplyclean.den.deltahotels.com/">Simply Clean</a></li>
                                    <li class="mtab" rel="#mtab-panel-17">
                                    <a href="//deltagreens.den.deltahotels.com/">Delta Greens</a></li>
                                    <li class="mtab" rel="#mtab-panel-18">
                                    <a href="//meetings.den.deltahotels.com/">Delta Meetings</a></li>
                                    <li class="mtab" rel="#mtab-panel-26">
                                    <a href="//promotions.den.deltahotels.com/">Promotions</a></li>
                                    <!-- <li class="mtab" rel="#mtab-panel-20">
                                <a href="http://talents.den.deltahotels.com/">Delta Talents</a></li> -->
                                    <li class="more"><a href="<?php global $wpdb; echo get_blog_option($wpdb->siteid, 'siteurl'); ?>/view-all/?site_cat=4">View All</a></li>
                                    </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>

            <section id="header-search">
                <form role="search" method="get" id="searchform" action="/globalsearch/">
                    <div>
                        <input class="ms-global-search_vbox" type="text" tabindex="1" size="16" value="" name="mssearch" placeholder="<?php _e('Search','deltamain');?>">
                            <button>Submit</button>
                    </div>
                </form>
            </section>

        </header>
<section id="page-body">
<?php
global $post;
$permalink = get_permalink();

if(is_front_page() && THEME_TYPE == 'PROGRAM'): ?>
    <nav id="breadcrumb" style="margin-bottom:0;">
        <ul class="clearfix">
            <li><a href="//den.deltahotels.com/"><? _e('Home', 'deltamain'); ?></a></li>
            <li><a href="<?php echo get_site_url(1); ?>/view-all/?site_cat=4"><? _e('Programs', 'deltamain'); ?></a></li>
            <li><a href="<?php bloginfo('url')?>"><?php bloginfo('name');?></a></li>
        </ul>
    </nav>
    <header id="hero">
        <div class="image"><img src="<?php echo get_theme_mod('image_setting'); ?>" alt="Delta Hotel reception" ></div>
        
        <div class="content clearfix">
            <div class="badge"><img src="<?php echo get_theme_mod('logo_setting'); ?>" alt="Delta Privilege badge" title="<?php bloginfo('name'); ?>"></div>
            
            <div class="copy">
                <h3><?php bloginfo('name');?></h3>
                <p><?php bloginfo('description');?></p>
            </div>
        </div>
    </header>
<? elseif (THEME_TYPE == 'PROGRAM') :?>
    <nav id="breadcrumb">
        <ul class="clearfix">
            <li><a href="//den.deltahotels.com/"><? _e('Home', 'deltamain'); ?></a></li>
            <li><a href="<?php echo get_site_url(1); ?>/view-all/?site_cat=4"><? _e('Programs', 'deltamain'); ?></a></li>
            <li><a href="<?php bloginfo('url')?>"><?php bloginfo('name');?></a></li>
            <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
        </ul>
    </nav>
<? elseif (THEME_TYPE == 'DEPARTMENT') :?>
    <nav id="breadcrumb">
        <ul class="clearfix">
            <li><a href="//den.deltahotels.com/"><? _e('Home', 'deltamain'); ?></a></li>
            <li><a href="<?php echo get_site_url(1); ?>/view-all/?site_cat=2"><? _e('Departments', 'deltamain'); ?></a></li>
            <li><a href="<?php bloginfo('url')?>"><?php bloginfo('name');?></a></li>
            <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
        </ul>
    </nav>

<? endif; ?>