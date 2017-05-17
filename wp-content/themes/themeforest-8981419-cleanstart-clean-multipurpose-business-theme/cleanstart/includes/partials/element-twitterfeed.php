<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M            (c) 2014

File Description: TToolbar 

*/
Plethora_Theme::dev_comment('Start >>> Twitter Feed Template Part Loaded: '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');

$count                = Plethora_Theme::option( 'twitter_count' );
$consumer_key         = Plethora_Theme::option( 'twitter_consumer_key' );
$consumer_secret      = Plethora_Theme::option( 'twitter_consumer_secret' );
$screen_name          = Plethora_Theme::option( 'twitter_screen_name' );
$replies_switch       = Plethora_Theme::option( 'twitter_replies_switch' );
$twitter_profilelink  = Plethora_Theme::option( 'twitter_profilelink', "#" );
$twitter_enable_date  = Plethora_Theme::option( 'twitter_enable_date', "disable" );
$twitter_date_format  = Plethora_Theme::option( 'twitter_date_format', "M j" );

if ( class_exists('Plethora_Module_Twitterapiexchange') && $count > 0 && !empty( $consumer_key )  && !empty( $consumer_secret ) ) { 

  $settings = array(
     'consumer_key'              => $consumer_key,
     'consumer_secret'           => $consumer_secret,
  );
  $url      = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
  $query    = 'screen_name=' . $screen_name;
  $query   .= '&count=' . $count;
  $query   .= ( $replies_switch == 0 ) ? '&exclude_replies=true' : ''; 
  $twitter  = new Plethora_Module_Twitterapiexchange( $settings );
  $response =  $twitter->query( $query );

  if ( is_array( $response ) ) {  ?>     

      <?php Plethora_Theme::dev_comment('Start >>> Twitter Feed Section', 'layout'); ?>

      <section class="twitter_feed_wrapper skincolored_section">

        <div class="container">
          <div class="row">
               <div class="twitter_feed_icon wow fadeInDown"><a href="<?php echo $twitter_profilelink; ?>"><i class="fa fa-twitter"></i></a></div>
               <div id="twitter_flexslider" class="flexslider">
                    <ul class="slides">
                      <?php foreach ( $response as $tweets ) { ?>
                        <li class="item">
                          <blockquote>

                          <?php 

                          $development = Plethora_Theme::option( PLETHORA_META_PREFIX . 'development' );

                          if ( $development === 'development' ) { ?>
  
                              <!-- DEBUG: TWEET
                              <?php echo print_r($tweets,true); ?>
                              -->

                          <?php } ?>

                              <?php 
                              $twitter_date = ( $twitter_enable_date !== "disable" ) ? "<p><strong>" . date( $twitter_date_format, strtotime( $tweets->created_at )) . "</strong></p>" : ""; 
                              ?>

                              <?php if ( $twitter_enable_date === "top" ){ echo $twitter_date; } ?>
                              <p>
                                <?php echo $tweets->text; ?><a target="_blank" href="<?php echo "https://twitter.com/" . $tweets->user->screen_name . "/status/" . $tweets->id_str; ?>"> Tweet URL</a>
                              </p>
                              <?php if ( $twitter_enable_date === "bottom" ){ echo $twitter_date; } ?>

                          </blockquote>
                        </li>  
                      <?php } ?>
                    </ul>
              </div>
          </div>
        </div>

      </section>

      <?php Plethora_Theme::dev_comment('End <<< Twitter Feed Section', 'layout'); ?>

<?php 

  } else { 

    Plethora_Theme::dev_comment('ATTENTION: Unable to reach Twitter API with settings given. Please check if settings are correct', 'layout');
    
  }

} ?>

<?php Plethora_Theme::dev_comment('End <<< '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');?>