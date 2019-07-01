<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/third_party/pubnub/autoloader.php');

use Pubnub\Pubnub;

class PubnubController extends CI_Controller
{
  public function index()
  {
  	parent :: __construct();

  }

  public function subscribe() {

    echo "Started  Updated";
    $pubnub = new Pubnub('pub-c-a2c67d8e-1b26-4e00-878b-8b74a6ef3393', 'sub-c-1aa69146-117c-11e7-9faf-0619f8945a4f');

    //Subscribe to a channel, this is not async.
    $pubnub->subscribe('hello_world', function ($envelope) {
                 print_r($envelope);
           });
  }

  public function publish() {

    $pubnub = new Pubnub('pub-c-a2c67d8e-1b26-4e00-878b-8b74a6ef3393', 'sub-c-1aa69146-117c-11e7-9faf-0619f8945a4f');

    // Use the publish command separately from the Subscribe code shown above.
    // Subscribe is not async and will block the execution until complete.
    $response = $pubnub->publish('hello_world','Hello PubNub Updated!');

    print_r($response);

  }

}
?>
