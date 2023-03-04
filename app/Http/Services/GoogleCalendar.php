<?php
namespace App\Http\Services;

require_once '../vendor/autoload.php';

use  Google\Client;
use  Google\Service\Calendar;
class GoogleCalendar{

	public static function getClient()
    {
        
    	$client = new Client();
        $client->setApplicationName("my project");
        $client->setScopes(Calendar::CALENDAR);
        $client->setAuthConfig(storage_path('app/googleClient/client_secret.json'));
        $client->setAccessType('offline');
        return $client;
    }

    /**
    * Returns an authorized API client.
    * @return Google_Client the authorized client object
    */
    public static function oauth()
    {
        $client = self::getClient();
        
        // Load previously authorized credentials from a file.
        $credentialsPath = storage_path('app/googleClient/token.json');
        if (!file_exists($credentialsPath)) {
        	return false;
        }
       
        $accessToken = json_decode(file_get_contents($credentialsPath), true);
        $client->setAccessToken($accessToken);

        // Refresh the token if it's expired.
        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
        }
        return $client;
    }

    public static function getResources($client)
    {
        $service = new Calendar($client);

        // On the user's calenda print the next 10 events .
        $calendarId = 'primary';
        $optParams = array(
            'maxResults' => 10,
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => date('c'),
        );
        $results = $service->events->listEvents($calendarId, $optParams);
        $events = $results->getItems();

        if (empty($events)) {
            print "No upcoming events found.\n";
        } else {
            print "Upcoming events:\n";
            foreach ($events as $event) {
                $start = $event->start->dateTime;
                if (empty($start)) {
                    $start = $event->start->date;
                }
                printf("%s (%s)\n", $event->getSummary(), $start);
            }
        }
    }
}

?>