<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        Session::start();
        $response = $this->call('POST', 'account/update_finance_accounts', array(
            'accounts_ids[2]'=>5,
            'accounts_ids[3]'=>5,
            '_token' => csrf_token(),
        ));

        $response->dump();
        $response->assertResponseOk(302);
    }
}
