<?php

namespace Hug\Zip;

use Alchemy\Zippy\Zippy;
use Hug\FileSystem\FileSystem as FileSystem;

class Zip
{
    /**
     * Creates a compressed file (.zip, .tar, .tar.gz, .tar.bz2) from a directory
     *
     * Based on Zippy Librairy 
     * @link https://github.com/alchemy-fr/Zippy
     *
     * @param string $source Directory path where to take files to compress
     * @param string $destination Compressed file's path to create
     *
     * @return array $response
     *
     */
    public static function zip_compress($source, $destination, $stats = false)
    {
        $response = [
            'status' => 'error', 
            'message' => '', 
            'exception' => '',
            'source' => $source,
            'destination' => $destination
        ];
        try
        {
            $allowed_extensions = ['zip', 'tar', 'gz', 'bz2'];
            $destination_extension = pathinfo($destination, PATHINFO_EXTENSION);
            if(in_array($destination_extension, $allowed_extensions))
            {
                if(is_readable($source))
                {
                    $zippy = Zippy::load();
                    
                    # creates an archive.zip that contains a directory "folder" that contains files contained in "/path/to/directory" recursively
                    $dir_name = 'files';
                    if(is_file($source))
                    {
                        $dir_name = basename(dirname($source));
                    }
                    else
                    {
                        $dir_name = basename($source);
                    }

                    $archive = $zippy->create(
                        $destination, 
                        [$dir_name => $source], 
                        $recursive = true);
                    
                    $response['status'] = 'success';

                    if($stats)
                    {
                        $response['source_size'] = FileSystem::dir_size($source);
                        $response['source_size_hr'] = FileSystem::human_file_size($response['source_size']);
                        $response['destination_size'] = FileSystem::file_size($destination);
                        $response['destination_size_hr'] = FileSystem::human_file_size($response['destination_size']);
                        $response['compression'] = round(($response['source_size'] - $response['destination_size']) / $response['source_size'] * 100, 2);
                    }
                }
                else
                {
                    $response['message'] = 'SOURCE_NOT_READABLE';
                }
            }
            else
            {
                $response['message'] = 'INVALID_FILE_TYPE';
            }
        }
        catch(\Alchemy\Zippy\Exception\NotSupportedException $e)
        {
            $response['message'] = 'UNKNOWN_ERROR';
            $response['exception'] = $e->getMessage();
        }
        catch(\Alchemy\Zippy\Exception\RunTimeException $e)
        {
            $response['message'] = 'UNKNOWN_ERROR';
            $response['exception'] = $e->getMessage();
        }
        catch(\Alchemy\Zippy\Exception\InvalidArgumentException $e)
        {
            $response['message'] = 'UNKNOWN_ERROR';
            $response['exception'] = $e->getMessage();
        }
        catch(Exception $e)
        {
            $response['message'] = 'UNKNOWN_ERROR';
            $response['exception'] = $e->getMessage();
        }

        return $response;
    }

    /**
     * Extracts a compressed file (.zip, .tar, .tar.gz, .tar.bz2)
     *
     * Based on Zippy Librairy 
     * @link https://github.com/alchemy-fr/Zippy
     *
     * @param string $source Compressed file's path to extract
     * @param string $destination Directory path where to extract file
     *
     * @return array $response
     */
    public static function zip_extract($source, $destination, $stats = false)
    {
        $response = [
            'status' => 'error',
            'message' => '',
            'exception' => '',
            'source' => $source,
            'destination' => $destination
        ];
        
        try
        {
            $allowed_extensions = ['zip', 'tar', 'gz', 'bz2'];
            $source_extension = pathinfo($source, PATHINFO_EXTENSION);
            if(in_array($source_extension, $allowed_extensions))
            {
                if(is_writable($destination))
                {
                    $zippy = Zippy::load();

                    $archive = $zippy->open($source);

                    // extract content to `/tmp`
                    $res = $archive->extract($destination);

                    $response['status'] = 'success';

                    if($stats)
                    {
                        $response['source_size'] = FileSystem::file_size($source);
                        $response['source_size_hr'] = FileSystem::human_file_size($response['source_size']);
                        $response['destination_size'] = FileSystem::dir_size($destination);
                        $response['destination_size_hr'] = FileSystem::human_file_size($response['destination_size']);
                        $response['decompression'] = round(-($response['source_size'] - $response['destination_size']) / $response['source_size'] * 100, 2);
                    }
                }
                else
                {
                    $response['message'] = 'DESTINATION_NOT_WRITABLE';
                }
            }
            else
            {
                $response['message'] = 'INVALID_FILE_TYPE';
            }
        }
        catch(\Alchemy\Zippy\Exception\NotSupportedException $e)
        {
            $response['message'] = 'UNKNOWN_ERROR';
            $response['exception'] = $e->getMessage();
        }
        catch(\Alchemy\Zippy\Exception\RunTimeException $e)
        {
            $response['message'] = 'UNKNOWN_ERROR';
            $response['exception'] = $e->getMessage();
        }
        catch(\Alchemy\Zippy\Exception\InvalidArgumentException $e)
        {
            $response['message'] = 'UNKNOWN_ERROR';
            $response['exception'] = $e->getMessage();
        }
        catch(Exception $e)
        {
            $response['message'] = 'UNKNOWN_ERROR';
            $response['exception'] = $e->getMessage();
        }

        return $response;
    }

}
