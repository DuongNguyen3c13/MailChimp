<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\MailChimpService;
use Illuminate\Http\Request;


class MailChimpController extends Controller
{
    protected $mailChimpService;

    public function __construct(MailChimpService $mailChimpService)
    {
        $this->mailChimpService = $mailChimpService;
    }

    public function index()
    {
        return view('home');
    }

    public function createList()
    {
        $this->mailChimpService->createList();

        return view('home');
    }

    public function getList()
    {
        return $this->mailChimpService->getList();
    }

    public function addMails()
    {
        return view('add_mail');
    }

    public function storeMails(Request $request)
    {
        $data['email'] = $request['email'];
        $data['first-name'] = $request['firstName'];
        $data['last-name'] = $request['lastName'];

        $this->mailChimpService->storeMails($data);

        return view('home');
    }

    public function createCampaign(Request $request)
    {
        $data['email'] = $request['email'];
        $data['name'] = $request['name'];

        $this->mailChimpService->createCampaign($data);

        return view('home');
    }

    public function getCampaigns()
    {
        $this->mailChimpService->getCampaigns();
    }

    private function setContent()
    {
        $this->mailChimpService->setContent();
    }

    public function sendMail()
    {
        $this->mailChimpService->sendMail();
    }

    public function setSender()
    {
        return view('set_sender');
    }
}
