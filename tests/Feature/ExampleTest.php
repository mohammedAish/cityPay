<?php

namespace Tests\Feature;

use App\Http\Controllers\Web\ServiceController;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use WithoutMiddleware; // use this trait

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest(){
        /*   $ctr=new ServiceController();
           $response=$ctr->getAllServices();
        */
        $response = $this->get(route('tst_services'));
        //   $response->assertViewHas('services');
        //  $response->dump();
        $response->assertSuccessful();
    }

    public function testGetServiceInfo(){
        $response = $this->get(route('service'),[1]);
        //   $response->assertViewHas('services');
        // $response->dump();
        $response->assertSuccessful();
    }

    public function testProfile_info(){
        $user=Customer::find(1);
        $this->actingAs($user);
        $response = $this->get(route('profile_info'));
        $response->dump();
        $response->assertSuccessful();
    }
    public function testServiceInstruction(){
        $response = $this->get(route('service_instructions',['id'=>2]));
        $response->dump();
        $response->assertSuccessful();
    }


}
