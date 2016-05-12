<?php
// include "../../../../../wp-load.php";
$path = $_SERVER['DOCUMENT_ROOT'];

include_once $path . '/wp-config.php';
include_once $path . '/wp-load.php';
include_once $path . '/wp-includes/wp-db.php';
include_once $path . '/wp-includes/pluggable.php';

//echo $endLimit=$startLimit+(+2);

function the_network_posts_ajax(){
	
	$page=$_GET['page'];
	$ItemPerPage=3;
	$offset=($page-1)*$ItemPerPage;
	
	
	$r_posts =  get_all_posts();
	$r_posts=array_slice($r_posts, $offset, 3);
	global $post;
	//print_r($r_posts);
	foreach($r_posts as $posts){
		switch_to_blog($posts->blogID);
		if(!DenUser::is_member($posts->blogID) && get_post_meta($posts->ID, '_member_post', true) == 'members') continue;
		$postContent=$posts->post_content;
		$excerpt = preg_replace('/\[(.*)\]/', '', $postContent);
		$ThemeExcerpt = extractExcerpt($excerpt); //substr($excerpt,0,150);
		$thumbnail=$posts->thumbnail;
		$author_info = get_userdata($posts->post_author);
		
		$html.='<div class="feed row"><div class="columns large-3"><a href="'.$posts->permalink.'">';
		if($thumbnail=='' || $thumbnail==null){ 
		   $html.='<img src="' .theme_url.'/images/dummyPostImage.png" />';
		     } else {
			$html.='<img src="'. $posts->thumbnail .'"/>';
			 }
			 $html.='</a></div>';
                $html.='<div class="columns large-6 qwashere"><a href="'. $posts->permalink.'"><h4>'. apply_filters( 'the_title', $posts->post_title, $posts->ID ) .'</h4></a>
                   <p>'.apply_filters( 'the_content', $ThemeExcerpt, $posts->ID ).'</p>';

                    if (strpos(DenUser::get_meta_field('language'), 'fr') === false)
                  {
                    $html .= '<small>Posted '.mysql2date('M d, Y', $posts->post_date).' by '. $author_info->first_name .' '. $author_info->last_name .' in <a href="'. $posts->blogUrl  .'">'. $posts->blogName .'</a></small>';
                }
                else
                {
                	$html .= '<small>Posté '.mysql2date('M d, Y', $posts->post_date).' par '. $author_info->first_name .' '. $author_info->last_name .' dans <a href="'. $posts->blogUrl  .'">'. $posts->blogName .'</a></small>';	
                }
                $html .= '</div>';
		
		
                $html.='<div class="columns large-3">
                    <a class="comments"  href="'. $posts->permalink .'#comments">'. $posts->commentcount .'</a>
                    '. getPostLikeLink( $posts->blogID, $posts->ID ) .'</div></div>'; 
        restore_current_blog();
	}
	
	return $html;
}
echo the_network_posts_ajax();
?>
