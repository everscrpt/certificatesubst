<?php

namespace App\Http\Controllers\Mailwizz;

use App\Http\Controllers\Controller;
use App\Model\Setting;
use Config;
use Illuminate\Http\Request;

class MailwizzController extends Controller
{
    private $config;

    private $SubscribeEndPoint;

    private $CampignMailEndPoint;

    public function __construct()
    {

        // Set Config
        $this->config = Config::get('mailwizz.config.mailwizz');

        $MailWizzConfig = new \MailWizzApi_Config($this->config);
        \MailWizzApi_Base::setConfig($MailWizzConfig);

        // Set Endpoint
        $this->SubscribeEndPoint = new \MailWizzApi_Endpoint_ListSubscribers();
        $this->CampignMailEndPoint = new \MailWizzApi_Endpoint_Campaigns();

    }

    public function subscribe(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $names = explode(' ', $request->name);
        $first_name = $names[0];
        if (isset($names[1])) {
            $last_name = $names[1];
        } else {
            $last_name = '';
        }

        $response = $this->SubscribeEndPoint->create('nf371h4n90175', [
            'EMAIL' => $request->email, // the confirmation email will be sent!!! Use valid email address
            'FNAME' => $first_name,
            'LNAME' => $last_name,
        ]);

        // DISPLAY RESPONSE
        $resp = $response->body->toArray();

        if ($resp['status'] == 'success') {
            return response()->json(['success' => true, 'data' => $resp['data']], 200);
        } else {
            return response()->json(['success' => false, 'error' => $resp['error']], 401);
        }

    }

    public function sendMail()
    {

        $uniID = uniqid();

        $settings = Setting::select('value')->where(['key' => 'mailwizz_setting'])->first();

        $data = json_decode($settings->value);
        $the_date_object = new \DateTime(date('Y-m-d ').' '.$data->time, new \DateTimeZone('America/Toronto'));
        $time_to_send = $the_date_object->format('Y-m-d H:i:s');

        $posts = app(\App\Http\Controllers\Web\SearchController::class)->getLatestPosts();

        // die("Total posts " . count($posts));

        if (count($posts)) {
            ob_start();
            foreach ($posts as $key => $post) {
                ?>
                    <div style="margin-bottom: 15px; font-family: sans-serif; padding: 10px; background: #f5f5f5; color: #5f5f5f;">
                        <h3 style="margin: 0; font-weight: bold;"><a style="text-decoration: none; color: #006faa!important;" href="<?php echo $post['link']; ?>" target="blank"><?php echo $post['title']; ?></a></h3>
                        <p style="margin:0"><strong>Publication:</strong> <?php echo $post['site']; ?></p>
                        <?php foreach ($post['owner_data'] as $owner) { ?>
                            <small><?php echo $owner['title']; ?>: <?php echo $owner['data']; ?></small><br>
                        <?php } ?>
                        <?php if (isset($post['location'])) { ?>
                        <small><strong>Location of premises:</strong> <span><?php echo $post['location']; ?></span></small>
                        <?php } ?>
                    </div>
                    <?php } ?>
                <?php
            $post_html = ob_get_clean();

            $mail_template = str_replace('#MAIL_CONTENT#', $post_html, $data->email_template);

            $response = $this->CampignMailEndPoint->create([
                'name' => 'CSP Daily Mailing List '.date('Y-m-d'), // required
                'type' => 'regular', // optional: regular or autoresponder
                'from_name' => $data->from_name, // required
                'from_email' => $data->from_email, // required
                'subject' => $data->mail_subject, // required
                'reply_to' => $data->reply_to, // required
                'send_at' => $time_to_send,
                'list_uid' => $data->mailwizz_list_id, // required
                //'segment_uid'   => 'SEGMENT-UNIQUE-ID', optional, only to narrow down

                // optional block, defaults are shown
                'options' => [
                    'url_tracking' => 'no', // yes | no
                    'json_feed' => 'no', // yes | no
                    'xml_feed' => 'no', // yes | no
                    'plain_text_email' => 'yes', // yes | no
                    'email_stats' => null, // a valid email address where we should send the stats after campaign done
                ],

                // required block, archive or template_uid or content => required.
                'template' => [
                    //'archive'         => file_get_contents(dirname(__FILE__) . '/template-example.zip'),
                    // 'template_uid'    => 'TEMPLATE-UNIQUE-ID',
                    'content' => $mail_template,
                    'inline_css' => 'no', // yes | no
                    'plain_text' => null, // leave empty to auto generate
                    'auto_plain_text' => 'yes', // yes | no
                ],
            ]);

            // DISPLAY RESPONSE
            $resp = $response->body->toArray();

            // print_r($response->body);

            if ($resp['status'] == 'success') {
                return response()->json(['success' => true], 200);
            } else {
                return response()->json(['success' => false, 'error' => $resp['error']], 401);
            }
        }

        return response()->json(['success' => false, 'error' => 'No new post available'], 401);

    }
}
