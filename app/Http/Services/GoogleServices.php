<?php
namespace App\Http\Services;

class GoogleServices
{

    protected $user;
    protected $client;
    public function __construct(){

    }

    private function googleClientConfig($user){
        $redirectUrl = "user.integration.authorize_google_calendar";
        $allScopes = implode('',array(
            \Google_Service_Calendar::CALENDAR,
            Oauth2::USERINFO_PROFILE,
            Oauth2::USERINFO_EMAIL
        )

        );

        $client  = new \Google_Client();
        $client->setApplicationName(applicationName:"Google Calendar");
        $client->setScopes($allScopes);
        $client->setAuthConfig(storage_path(path:'app/googleClient/client_secret.json'));
        $client->setState(state:'gcalendar');
        $client->setRedirectUrl(route($redirectUrl));
        $client->setAccessType(accessType:'offline');
        $client->setApprovalPromt(approvalPromt:'force');
        return $client;
    }
}
?>