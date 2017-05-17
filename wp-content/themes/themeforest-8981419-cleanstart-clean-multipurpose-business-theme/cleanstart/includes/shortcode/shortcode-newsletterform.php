<?php
/*
 ______ _____   _______ _______ _______ _______ ______ _______ 
|   __ \     |_|    ___|_     _|   |   |       |   __ \   _   |
|    __/       |    ___| |   | |       |   -   |      <       |
|___|  |_______|_______| |___| |___|___|_______|___|__|___|___|

P L E T H O R A T H E M E S . C O M               (c) 2014-2015

File Description: MailChimp Form Shortcode

*/

if ( ! defined( 'ABSPATH' )) exit; // NO ACCESS IF DIRECT OR TEAM POST TYPE NOT EXISTS

if ( class_exists('Plethora_Shortcode') && !class_exists('Plethora_Shortcode_NewsletterForm') ):

  /**
   * @package Plethora Base
   */

  class Plethora_Shortcode_NewsletterForm extends Plethora_Shortcode { 

    public $shortcode_title       = "MailChimp Form Shortcode";
    public $shortcode_subtitle    = "Activate/Deactivate MailChimp Form Shortcode";
    public $shortcode_description = "MailChimp Form shortcode";

    function __construct() {

          // REGISTER SHORTCODE
 
              // Hook shortcode registration on init
              $this->add( $this->params() );

              /*** ADD SCRIPTS ***/
              // Prepare array for script registration according to wp_register_script usage. 
              if (!is_admin()) {
                $this->add_script( array(
                  array(
                    'handle'    => 'newsletter_form', 
                    'src'       => THEME_ASSETS_URI . '/js/newsletter_form.min.js', 
                    'deps'      => array( 'jquery' ), 
                    'ver'       => '1.0', 
                    'in_footer' => true
                  )
                  ,array(
                    'type'     => 'localized_script',
                    'handle'   => 'newsletter_form',
                    'variable' => 'myAjax',
                    'data'     => array( 'ajaxurl' => admin_url( 'admin-ajax.php' ))
                  )
                  ,array(
                    'type'     => 'localized_script',
                    'handle'   => 'newsletter_form',
                    'variable' => 'newsletter_form_strings',
                    'data'     => array( 
                      'invalid_email' => __( 'Invalid Email', 'cleanstart' ),
                      'server_error'  => __( 'Server response error', 'cleanstart'),
                      'success'       => __( 'SUCCESS', 'cleanstart'),
                      'error'         => __( 'ERROR', 'cleanstart'),
                      )
                  )
                 
                ));

              }
              /*** END OF ADD SCRIPTS ***/

              /*** AJAX FUNCTIONALITY FOR SHORTCODE ***/

              add_action("wp_ajax_newsletter_form", array( $this, "ajax_handler") );
              add_action("wp_ajax_nopriv_newsletter_form", array( $this, "ajax_handler") );

              /*** END OF AJAX FUNCTIONALITY FOR SHORTCODE ***/

       }

      public function ajax_handler() {

           if ( !wp_verify_nonce( $_POST['nonce'], "newsletter_form_nonce")) {
              exit("No naughty business please");
           }   

          $result['type']    = "error";
          $result['message'] = "";
          $result['debug']   = "";
          $email             = !empty( $_POST["email"] ) ? sanitize_email( $_POST["email"] ) : '';
          /******/
          $firstname         = !empty( $_POST["firstname"] ) ? sanitize_text_field( $_POST["firstname"] ) : '';
          $lastname          = !empty( $_POST["surname"] ) ? sanitize_text_field( $_POST["surname"] ) : '';
          /******/

           if( is_email( $email ) === false ) {
              $result['type']    = "error";
              $result['message'] = __( 'Invalid email', 'cleanstart' );
              $result['debug']   = "";
           } else {
            // Send to MailChimp API

            $mailchimp_apikey = method_exists('Plethora', 'option') ? Plethora::option('mailchimp_apikey') : '';
            $mailchimp_listid = method_exists('Plethora', 'option') ? Plethora::option('mailchimp_listid') : '';

            if ( 
              class_exists('Plethora_Module_MailChimp') 
              && $mailchimp_apikey !== ''
              && $mailchimp_listid !== ''
            ) { 
              $MailChimp        = new Plethora_Module_MailChimp( $mailchimp_apikey );

              $mailchimp_data = array(
                'id'                => $mailchimp_listid,
                'email'             => array( 'email'=> $_POST['email'] ),
                'double_optin'      => false,
                'update_existing'   => true,
                'replace_interests' => false,
                'send_welcome'      => false,
              );

              if ( $firstname !== "" || $lastname !== "" ){
                $mailchimp_data['merge_vars'] = array( 'FNAME'=> $firstname, 'LNAME'=> $lastname );
              }

              $result = $MailChimp->call('lists/subscribe', $mailchimp_data );

              if ( $result === false ){

                $result['type']    = "error";
                $result['message'] = __( "ERROR", "cleanstart" );
                $result['debug']   = __( "Error connecting to the MailChimp API endpoint.", 'cleanstart');

              } else {

                if ( isset($result['status']) && $result['status'] === "error" ){

                  $result['type']    = "error";
                  $result['message'] = __( "ERROR", "cleanstart" );
                  $result['debug']   = $result['error'];

                } else {

                  $result['debug']   = print_r( $result, true );
                  $result['type']    = "success";
                  $result['message'] = __( 'Successful request', 'cleanstart' );


                }

              }

            } 

           }

           if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
              $result = json_encode($result);
              echo $result;
           }
           else {
              header("Location: ".$_SERVER["HTTP_REFERER"]);
           }

           die();

      }

       /** 
       * Returns feature information for several uses by Plethora Core (theme options etc.)
       *
       * @return array
       * @since 1.0
       *
       */
       public function get_feature_options() {

          $feature_options = array ( 
              'switchable'       => true,
              'options_title'    => $this->shortcode_title,
              'options_subtitle' => $this->shortcode_subtitle,
              'options_desc'     => $this->shortcode_description,
              'tutorial_videos'  => array(),
              'tutorial_links'   => array(),
              'version'          => '1.0'
            );
          
          return $feature_options;
       }

       /** 
       * Returns shortcode content
       *
       * @return array
       * @since 1.0
       *
       */
       public function params() {

          $sc_settings =  array(
              "base"          => 'sc_newsletterform',
              "name"          => __("MailChimp Form", 'cleanstart'),
              "description"   => $this->shortcode_description,
              "class"         => "",
              "weight"        => 1,
              "category"      => 'Plethora Shortcodes',
              "admin_enqueue_css" => THEME_CORE_ASSETS_URI .'/admin-shortcodes.css',
              "icon"              => THEME_CORE_ASSETS_URI . '/icons/plethora_shortcodes-32x32.png', 
              "params"        => array(
                  array(
                      "param_name"    => "title",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h3",                                               
                      "class"         => "",                                                    
                      "heading"       => __("Title", 'cleanstart'),
                      "value"         => 'NEVER MISS A SINGLE <strong>FEATURE</strong>',                                     
                      "description"   => __("Title text (accepts html)", 'cleanstart'),      
                      "admin_label"   => false,                                             
                  )
                  ,array(
                      "param_name"    => "subtitle",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Subtitle", 'cleanstart'),
                      "value"         => 'Subscribe to our newsletter and learn about cutting edge updates!',                                     
                      "description"   => __("Text that appears in the subtitle (accepts html)", 'cleanstart'),      
                      "admin_label"   => false,                                             
                  )
                  ,array(
                      "param_name"    => "email_placeholder",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Email field placeholder", 'cleanstart'),
                      "value"         => 'Email Address',                                     
                      "description"   => __("Text that appears in the email field placeholder", 'cleanstart'),      
                      "admin_label"   => false,                                             
                  )
                  ,array(
                      "param_name"    => "button_text",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Subscribe button text", 'cleanstart'),
                      "value"         => 'SUBSCRIBE',                                     
                      "description"   => __("Text that appears in the Subscribe button (accepts html)", 'cleanstart'),      
                      "admin_label"   => false,                                             
                  )
                  /*** ENABLE FIRST NAME - SURNAME INPUT FIELDS [1] ***/
                  ,array(
                      "param_name"    => "name_inputbox",                                  
                      "type"          => "dropdown",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Display Name-Surname Box", 'cleanstart'),
                      "value"         => array( 'Hide'=>'0', 'Show'=>'1' ),
                      "description"   => __("Displays two extra input fields for submitting first and last name.", 'cleanstart'),      
                      "admin_label"   => false                                             
                  )
                  ,array(
                      "param_name"    => "firstname_placeholder",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Name field placeholder", 'cleanstart'),
                      "value"         => 'name',                                     
                      "description"   => __("Text that appears in the name field placeholder", 'cleanstart'),      
                      "admin_label"   => false,                                             
                      'dependency'    => array( 
                                          'element' => 'name_inputbox', 
                                          'value' => '1'   
                                      )
                  )
                  ,array(
                      "param_name"    => "lastname_placeholder",                                  
                      "type"          => "textfield",                                        
                      "holder"        => "h4",                                               
                      "class"         => "vc_hidden",                                                    
                      "heading"       => __("Surname field placeholder", 'cleanstart'),
                      "value"         => 'surname',                                     
                      "description"   => __("Text that appears in the surname field placeholder", 'cleanstart'),      
                      "admin_label"   => false,                                             
                      'dependency'    => array( 
                                          'element' => 'name_inputbox', 
                                          'value' => '1'   
                                      )
                  )
                  /*** /ENABLE FIRST NAME - SURNAME INPUT FIELDS [1] ***/
              )
          );

          return $sc_settings;
       }


       /** 
       * Returns shortcode settings (compatible with Visual composer)
       *
       * @return array
       * @since 1.0
       *
       */
       public function content( $atts, $content = null ) {

        $this->add_script = true; 

          extract( shortcode_atts( array( 
            "title"             => 'NEVER MISS A SINGLE <strong>FEATURE</strong>',                                     
            "subtitle"          => 'Subscribe to our newsletter and learn about cutting edge updates!',                                     
            "email_placeholder" => 'Email Address',                                     
            "button_text"       => 'SUBSCRIBE',
            /*** ENABLE FIRST NAME - SURNAME INPUT FIELDS [2] ***/
            "name_inputbox"         => '0',
            "firstname_placeholder" => "name",
            "lastname_placeholder"  => "surname"
            /*** /ENABLE FIRST NAME - SURNAME INPUT FIELDS [2] ***/
            ), $atts ) );

          // USER ATTRIBUTES AS VARIABLES

          $email_field_class = "";
          $nonce  = wp_create_nonce("newsletter_form_nonce");
          $output = '<div class="newsletter_form">';
          $output .= !empty($title) ? '<h3>' .  $title .'</h3>' : '';
          $output .= !empty($subtitle) ? '<h4>' . $subtitle . '</h4>' : '';
          $output .= '<form class="form-inline" id="newsletter" action="' . admin_url('admin-ajax.php') . '" method="POST">';
          /*** ENABLE FIRST NAME - SURNAME INPUT FIELDS [3] ***/
          if ( $name_inputbox === "1" ){
            $email_field_class = "name_enabled";
            $output .= '<input class="form-control" placeholder="' . esc_attr($firstname_placeholder) . '" name="first_name" id="first_name" type="text">
                        <input class="form-control" placeholder="' . esc_attr($lastname_placeholder) . '" name="last_name" id="last_name" type="text">';
          }
          /*** /ENABLE FIRST NAME - SURNAME INPUT FIELDS [3] ***/
          $output .= '<input class="form-control ' . $email_field_class . '" placeholder="' . esc_attr($email_placeholder) . '" name="email" id="email" type="text">
                      <button class="btn btn-primary newsletter_form_button" type="submit">' . $button_text . '</button>
                      <span id="newsletterResponse" class="btn btn-primary hidden">'. __('MESSAGE', 'cleanstart') .'</span>';
          $output .= '<input type="hidden" name="nonce" id="nonce" value="' . esc_attr( $nonce ) . '">';
          $output .= '</form></div>';

          return $output;

       }

  }
  
 endif;