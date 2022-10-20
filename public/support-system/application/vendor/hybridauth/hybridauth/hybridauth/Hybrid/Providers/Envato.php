<?php
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | https://github.com/hybridauth/hybridauth
*  (c) 2009-2011 HybridAuth authors | hybridauth.sourceforge.net/licenses.html
*/

/**
 * Hybrid_Providers_GitHub
 */
class Hybrid_Providers_Envato extends Hybrid_Provider_Model_OAuth2
{
    // default permissions
    // (no scope) => public read-only access (includes public user profile info, public repo info, and gists).
    public $scope = "";

    /**
     * IDp wrappers initializer
     */
    function initialize() {
        if (!$this->config["keys"]["id"] || !$this->config["keys"]["secret"]) {
            throw new Exception("Your application id and secret are required in order to connect to {$this->providerId}.", 4);
        }

        // override requested scope
        if (isset($this->config["scope"]) && !empty($this->config["scope"])) {
            $this->scope = $this->config["scope"];
        }

        // include OAuth2 client
        require_once Hybrid_Auth::$config["path_libraries"] . "OAuth/OAuth2Client.php";
        require_once Hybrid_Auth::$config["path_libraries"] . "Envato/Envato.php";

        // create a new OAuth2 client instance
        $this->api = new EnvatoOAuth2Client($this->config["keys"]["id"], $this->config["keys"]["secret"], $this->endpoint, $this->compressed);

        // If we have an access token, set it
        if ($this->token("access_token")) {
            $this->api->access_token = $this->token("access_token");
            $this->api->refresh_token = $this->token("refresh_token");
            $this->api->access_token_expires_in = $this->token("expires_in");
            $this->api->access_token_expires_at = $this->token("expires_at");
        }

        // Set curl proxy if exist
        if (isset(Hybrid_Auth::$config["proxy"])) {
            $this->api->curl_proxy = Hybrid_Auth::$config["proxy"];
        }

        // Provider api end-points
        $this->api->api_base_url  = "https://api.envato.com/";
        $this->api->authorize_url = "https://api.envato.com/authorization";
        $this->api->token_url     = "https://api.envato.com/token";
    }

    /**
     * load the user profile from the IDp api client
     */
    function getUserProfile()
    {
        //$data = $this->api->api( "v1/market/private/user/account.json" );
        $data = $this->api->api( "v1/market/private/user/email.json" );

        if ( ! isset( $data->email ) ){
            throw new Exception( "User profile request failed! {$this->providerId} returned an invalid response.", 6 );
        }
        $this->user->profile->email       = @ $data->email;
        $this->user->profile->emailVerified=$this->user->profile->email;
        $data = $this->api->api( "v1/market/private/user/account.json" );
        //GPrint($data);
        if(!empty($data->account->firstname) || !empty($data->account->surname)){
            $this->user->profile->firstName=$data->account->firstname;
            $this->user->profile->lastName=$data->account->surname;
            $this->user->profile->displayName = @ $data->account->firstname." ".$data->account->surname;
            $this->user->profile->photoURL    = @ $data->account->image;
            $this->user->profile->country    = @ $data->account->country;
        }
        $data = $this->api->api( "v1/market/private/user/username.json" );
        if(!empty($data->username)){
            $this->user->profile->identifier  = @ $data->username;
            $this->user->profile->displayName = @ $data->username;
            $this->user->profile->profileURL  = @ "https://codecanyon.net/user/{$data->username}";
            $this->user->profile->webSiteURL  =  @ "https://codecanyon.net/user/{$data->username}";
            if(empty($this->user->profile->firstName)){
                $this->user->profile->firstName=$data->username;
            }
        }
        return $this->user->profile;
    }
    /**
     *
     */
    function getUserContacts() {
        // refresh tokens if needed
        $this->refreshToken();

        //
        $response = array();
        $contacts = array();
        try {
            $response = $this->api->api( "user/followers" );
        } catch (Exception $e) {
            throw new Exception("User contacts request failed! {$this->providerId} returned an error: $e");
        }
        //
        if ( isset( $response ) ) {
            foreach ($response as $contact) {
                try {
                    $contactInfo = $this->api->api( "users/".$contact->login );
                } catch (Exception $e) {
                    throw new Exception("Contact info request failed for user {$contact->login}! {$this->providerId} returned an error: $e");
                }
                //
                $uc = new Hybrid_User_Contact();
                //
                $uc->identifier     = $contact->id;
                $uc->profileURL     = @$contact->html_url;
                $uc->webSiteURL     = @$contact->blog;
                $uc->photoURL       = @$contact->avatar_url;
                $uc->displayName    = ( isset( $contactInfo->name )?( $contactInfo->name ):( $contact->login ) );
                //$uc->description	= ;
                $uc->email          = @$contactInfo->email;
                //
                $contacts[] = $uc;
            }
        }
        return $contacts;
    }

}
