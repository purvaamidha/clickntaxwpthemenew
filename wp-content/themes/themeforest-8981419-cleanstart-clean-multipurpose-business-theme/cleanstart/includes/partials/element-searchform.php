<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M            (c) 2014

File Description: Search form(s) template part

*/
Plethora_Theme::dev_comment('Start >>> Search Template Part Loaded: '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');
Plethora_Theme::dev_comment('Start >>> Search Form Section', 'layout');
if ( is_404() ) { 

    echo '                    <div class="search_form">';
    echo '                         <form role="search" method="get" name="s" id="s" action="'. esc_url( home_url( '/' )).'">';
    echo '                              <div class="row">';
    echo '                                   <div class="col-sm-2 col-md-2"></div>';
    echo '                                   <div class="col-sm-6 col-md-6">';
    echo '                                        <input name="s" id="search" class="form-control" type="search">';
    echo '                                   </div>';
    echo '                                   <div class="col-sm-4 col-md-4"> <input type="submit" id="submit_btn" class="btn btn-primary" name="submit" value="'. __('Search', 'cleanstart') .'" /> </div>';
    echo '                                   <div class="col-sm-2 col-md-2"></div>';
    echo '                              </div>';
    echo '                         </form>';
    echo '                    </div>';

} else { 

    echo '                         <form role="search" method="get" name="s" id="s" action="'. esc_url(home_url( '/' )) .'">';
    echo '                              <div class="row">';
    echo '                                <div class="col-lg-10">';
    echo '                                    <div class="input-group">';
    echo '                                        <input name="s" id="search" class="form-control" type="text" placeholder="'. __('Search', 'cleanstart') .'">';
    echo '                                        <span class="input-group-btn">';
    echo '                                          <button class="btn btn-default" type="submit">'. __('Go!', 'cleanstart') .'</button>';
    echo '                                        </span>';
    echo '                                    </div>';
    echo '                                </div>';
    echo '                              </div>';
    echo '                         </form>';
}
Plethora_Theme::dev_comment('End <<< Search Form Section', 'layout');
Plethora_Theme::dev_comment('End <<< '. THEME_PARTIALS_DIR . '/'. basename( __FILE__ ), 'templateparts');?>