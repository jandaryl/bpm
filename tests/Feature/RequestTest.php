<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Shared\RequestHelper;

class RequestTest extends TestCase
{
    use RequestHelper;
    /**
     * Test to make sure the controller and route work with the view
     *
     * @return void
     */
    public function testIndexRoute()
    {
      // get the URL
      $response = $this->apiCall('GET', '/requests');
      $response->assertStatus(200);
      // check the correct view is called
      $response->assertViewIs('requests.index');
      

    }
}