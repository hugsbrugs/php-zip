<?php

# For PHP7
// declare(strict_types=1);

// namespace Hug\Tests\Zip;

use PHPUnit\Framework\TestCase;

use Hug\Zip\Zip as Zip;

/**
 *
 */
final class ZipTest extends TestCase
{    

    /* ************************************************* */
    /* ***************** Zip::compress ***************** */
    /* ************************************************* */

    /**
     *
     */
    public function testCanCompressWithValidExtension()
    {
        $source = realpath(__DIR__ . '/../../');
        $destination = sys_get_temp_dir() . '/test.zip';
        // 'zip', 'tar', 'gz', 'bz2'

        $test = Zip::compress($source, $destination);

        $this->assertInternalType('array', $test);

        $this->assertArrayHasKey('status', $test);
        $this->assertArrayHasKey('message', $test);
        $this->assertArrayHasKey('exception', $test);

        // $this->assertContains( 'success', $test);
        // $this->assertContains( ['message' => ''], $test);
        // $this->assertContains( ['exception' => ''], $test);
    }
    
    /**
     *
     */
    public function testCannotCompressWithInvalidExtension()
    {
        $source = realpath(__DIR__ . '/../../');
        $destination = sys_get_temp_dir() . '/test.rar';

        $test = Zip::compress($source, $destination);

        $this->assertInternalType('array', $test);

        $this->assertArrayHasKey('status', $test);
        $this->assertArrayHasKey('message', $test);
        $this->assertArrayHasKey('exception', $test);

        // $this->assertContains( 'error', $test);
        // $this->assertContains( ['message' => ''], $test);
        // $this->assertContains( ['exception' => ''], $test);
    }

    /* ************************************************* */
    /* ***************** Zip::extract ***************** */
    /* ************************************************* */

    /**
     *
     */
    public function testCanExtractWithValidExtension()
    {
        $source = sys_get_temp_dir() . '/test.zip';
        $destination = realpath(__DIR__ . '/../../../data/');

        $test = Zip::extract($source, $destination);

        $this->assertInternalType('array', $test);

        $this->assertArrayHasKey('status', $test);
        $this->assertArrayHasKey('message', $test);
        $this->assertArrayHasKey('exception', $test);

        // $this->assertContains( 'success', $test);
        // $this->assertContains( ['message' => ''], $test);
        // $this->assertContains( ['exception' => ''], $test);
    }

    /**
     *
     */
    public function testCannotExtractWithInvalidExtension()
    {
        $source = sys_get_temp_dir() . '/test.rar';
        $destination = realpath(__DIR__ . '/../../../data/');

        $test = Zip::extract($source, $destination);

        $this->assertInternalType('array', $test);

        $this->assertArrayHasKey('status', $test);
        $this->assertArrayHasKey('message', $test);
        $this->assertArrayHasKey('exception', $test);

        // $this->assertContains( 'error', $test);
        // $this->assertContains( ['message' => ''], $test);
        // $this->assertContains( ['exception' => ''], $test);
    }

}

