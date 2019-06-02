<?php

namespace App\Http\Services;

class MailChimpService
{
    protected $uri;

    protected $apiKey;

    public function __construct()
    {
        $this->uri = 'https://' . env('MAIL_CHIMP_DATA_CENTER') . '.api.mailchimp.com/3.0/';
        $this->apiKey = env('MAILCHIMP_APIKEY');
    }

    public function createList()
    {
        $ch = curl_init($this->uri . 'lists');

        $postData = [
            'name' => 'Newly created list',
            'contact' => [
                'company' => 'company',
                'address1' => 'address1',
                'city' => 'city',
                'state' => 'state',
                'zip' => 'zip',
                'country' => 'country',
            ],
            "permission_reminder" => "permission_reminder",
            "campaign_defaults" => [
                'from_name' => 'Duong',
                'from_email' => 'duongnguyen.3c13@gmail.com',
                'subject' => 'sample subject',
                'language' => 'en',
            ],
            "email_type_option" => true,
        ];

        $this->sendPost($ch, $postData);
    }

    public function getList()
    {
        $ch = curl_init($this->uri . 'lists');

        $response = $this->sendGet($ch);

        if (!is_null($response)) {
            return $response->lists[0]->id;
        };

        return;
    }

    public function getCampaigns()
    {
        $ch = curl_init($this->uri . 'campaigns?status=save');

        $response = $this->sendGet($ch);

        if (!empty($response->campaigns)) {
            return reset($response->campaigns)->id;
        };

        return;
    }

    public function storeMails(array $data)
    {
        $ch = curl_init($this->uri . 'lists/' . $this->getList() . '/members');

        $postData = [
            'email_address' => $data['email'],
            'status' => "subscribed",
            'merge_fields' => [
                "FNAME" => $data['first-name'],
                "LNAME"=> $data['last-name'],
            ],
        ];

        $this->sendPost($ch, $postData);
    }

    public function setContent()
    {
        $ch = curl_init($this->uri . 'campaigns/' . $this->getCampaigns() . '/content');

        $postData = [
            'html' => 'This is the sample content for the test email'
        ];

        $this->sendPut($ch, $postData);
    }

    public function createCampaign(array $data)
    {
        $this->setContent();

        $ch = curl_init($this->uri . 'campaigns');

        $postData = [
            'recipients' => [
                'list_id' => $this->getList()
            ],
            'type' => 'regular',
            'settings' => [
                'subject_line' => 'This is the sample subject',
                'reply_to' => $data['email'],
                'from_name' => $data['name'],
            ],
        ];

        $this->sendPost($ch, $postData);
    }

    public function sendMail()
    {
        $this->setContent();

        $ch = curl_init($this->uri . 'campaigns/' . $this->getCampaigns() . '/actions/send');

        $postData = [];

        $this->sendPost($ch, $postData);
    }

    private function sendPost($ch, $postData)
    {
        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization: apikey '. $this->apiKey,
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ];

        curl_setopt_array($ch, $options);

        curl_exec($ch);
    }

    private function sendPut($ch, $postData)
    {
        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Authorization: apikey '. $this->apiKey,
                'Content-Type: application/json'
            ),
        ];

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt_array($ch, $options);

        curl_exec($ch);
    }

    private function sendGet($ch)
    {
        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: apikey '. $this->apiKey,
                'Content-Type: application/json'
            ],
        ];

        curl_setopt_array($ch, $options);
        $response = json_decode(curl_exec($ch));
        curl_close($ch);

        return $response;
    }
}
