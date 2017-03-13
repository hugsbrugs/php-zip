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
    /* *************** Zip::zip_compress *************** */
    /* ************************************************* */

    /**
     *
     */
    public function testCanZipCompressWithValidExtension()
    {
        $source = realpath(__DIR__ . '/../../');
        $destination = sys_get_temp_dir() . '/test.zip';
        // 'zip', 'tar', 'gz', 'bz2'

        $test = Zip::zip_compress($source, $destination);

        $this->assertInternalType('array', $test);

        $this->assertArrayHasKey('status', $test);
        $this->assertArrayHasKey('message', $test);
        $this->assertArrayHasKey('exception', $test);

        $this->assertContains( 'success', $test);
        // $this->assertContains( ['message' => ''], $test);
        // $this->assertContains( ['exception' => ''], $test);
    }
    
    /**
     *
     */
    public function testCannotZipCompressWithInvalidExtension()
    {
        $source = realpath(__DIR__ . '/../../');
        $destination = sys_get_temp_dir() . '/test.rar';

        $test = Zip::zip_compress($source, $destination);

        $this->assertInternalType('array', $test);

        $this->assertArrayHasKey('status', $test);
        $this->assertArrayHasKey('message', $test);
        $this->assertArrayHasKey('exception', $test);

        $this->assertContains( 'error', $test);
        // $this->assertContains( ['message' => ''], $test);
        // $this->assertContains( ['exception' => ''], $test);
    }

    /* ************************************************* */
    /* *************** Zip::zip_extract *************** */
    /* ************************************************* */

    /**
     *
     */
    public function testCanZipExtractWithValidExtension()
    {
        $source = sys_get_temp_dir() . '/test.zip';
        $destination = realpath(__DIR__ . '/../../../data/');

        $test = Zip::zip_extract($source, $destination);

        $this->assertInternalType('array', $test);

        $this->assertArrayHasKey('status', $test);
        $this->assertArrayHasKey('message', $test);
        $this->assertArrayHasKey('exception', $test);

        $this->assertContains( 'success', $test);
        // $this->assertContains( ['message' => ''], $test);
        // $this->assertContains( ['exception' => ''], $test);
    }

    /**
     *
     */
    public function testCannotZipExtractWithInvalidExtension()
    {
        $source = sys_get_temp_dir() . '/test.rar';
        $destination = realpath(__DIR__ . '/../../../data/');

        $test = Zip::zip_extract($source, $destination);

        $this->assertInternalType('array', $test);

        $this->assertArrayHasKey('status', $test);
        $this->assertArrayHasKey('message', $test);
        $this->assertArrayHasKey('exception', $test);

        $this->assertContains( 'error', $test);
        // $this->assertContains( ['message' => ''], $test);
        // $this->assertContains( ['exception' => ''], $test);
    }

}

