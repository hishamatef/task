<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SimpleFormTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    /** @test */
    public function it_validates_data01()
    {
        $this->post(route('simpleform.store'), [
            'data01' => '',
            'data02' => 'asd',
            'data03' => 'asd'
        ])->assertSessionHasErrors('data01');
    }

    /** @test */
    public function it_validates_data02()
    {
        $this->post(route('simpleform.store'), [
            'data01' => 'asd',
            'data02' => '',
            'data03' => 'asd'
        ])->assertSessionHasErrors('data02');
    }

    /** @test */
    public function it_validates_data03()
    {
        $this->post(route('simpleform.store'), [
            'data01' => 'asd',
            'data02' => 'asd',
            'data03' => ''
        ])->assertSessionHasErrors('data03');
    }

    /** @test */
    public function data01_must_have_value()
    {
        $this->post(route('simpleform.store'), ['data01' => 'asd'])
            ->assertSessionHasNoErrors('data01');
    }

    /** @test */
    public function data02_must_have_value()
    {
        $this->post(route('simpleform.store'), ['data02' => 'asd'])
            ->assertSessionHasNoErrors('data02');
    }

    /** @test */
    public function data03_must_have_value()
    {
        $this->post(route('simpleform.store'), ['data03' => 'asd'])
            ->assertSessionHasNoErrors('data03');
    }
}
