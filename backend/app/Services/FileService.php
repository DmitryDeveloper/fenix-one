<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Symfony\Component\HttpFoundation\StreamedResponse;
use RuntimeException;

/**
 * Class FileService
 * @package App\Services
 */
class FileService
{
    /**
     * Write the contents of a file. If you call method without calling the disk
     * method, the method call will automatically be passed to the default disk
     *
     * @param  string  $path
     * @param  string|resource  $fileContents
     * @param  string  $disk
     * @param  mixed  $options
     * @return bool
     */
    public function put($path, $fileContents, $options = [], $disk = ''): bool
    {
        if ($disk !== '') {
            return Storage::disk($disk)->put($path, $fileContents, $options);
        }
        return Storage::put($path, $fileContents, $options);
    }

    /**
     * Store the uploaded file on the disk.
     * Automatically generate a unique ID for file name.
     *
     * @param  string  $path
     * @param  File|UploadedFile  $file
     * @param  mixed  $options
     * @param  string  $disk
     * @return string|false
     */
    public function putFile($path, $file, $options = [], $disk = '')
    {
        if ($disk !== '') {
            return Storage::disk($disk)->putFile($path, $file, $options);
        }
        return Storage::putFile($path, $file, $options);
    }

    /**
     * This method is like putFile, only you manually specify a file name.
     *
     * @param  string  $path
     * @param  File|UploadedFile  $file
     * @param  string  $fileName
     * @param  mixed  $options
     * @param  string  $disk
     * @return string|false
     */
    public function putFileAs($path, $file, $fileName, $options = [], $disk = '')
    {
        if ($disk !== '') {
            return Storage::disk($disk)->putFileAs($path, $file, $fileName, $options);
        }
        return Storage::putFileAs($path, $file, $fileName, $options);
    }

    /**
     * Get the UNIX timestamp of the last time the file was modified.
     *
     * @param  string  $path
     * @param  string  $disk
     * @return int
     */
    public function lastModified($path, $disk = ''): int
    {
        if ($disk !== '') {
            return Storage::disk($disk)->lastModified($path);
        }
        return Storage::lastModified($path);
    }

    /**
     * Get the contents of a file.
     * The raw string contents of the file will be returned by the method.
     *
     * @param  string  $path
     * @param  string  $disk
     * @return string
     *
     * @throws FileNotFoundException
     */
    public function get($path, $disk = ''): string
    {
        if ($disk !== '') {
            return Storage::disk($disk)->get($path);
        }
        return Storage::get($path);
    }

    /**
     * Determine if a file exists.
     *
     * @param  string  $path
     * @param  string  $disk
     * @return bool
     */
    public function exists($path, $disk = ''): bool
    {
        if ($disk !== '') {
            return Storage::disk($disk)->exists($path);
        }
        return Storage::exists($path);
    }

    /**
     * Generate a response that forces the user's browser to download the file at the
     * given path.
     * The second argument to the method, which will determine the file name that
     * is seen by the user downloading the file.
     *
     * @param  string  $path
     * @param  string|null  $name
     * @param  mixed  $headers
     * @param  string  $disk
     * @return StreamedResponse
     */
    public function download(
        $path,
        $name = null,
        array $headers = [],
        $disk = ''
    ): StreamedResponse {
        if ($disk !== '') {
            return Storage::disk($disk)->download($path, $name, $headers);
        }
        return Storage::download($path, $name, $headers);
    }

    /**
     * Get the URL for the file at the given path.
     * If you are using the local driver, this will typically just prepend /storage to the
     * given path and return a relative URL to the file. If you are using the s3 or
     * rackspace driver, the fully qualified remote URL will be returned.
     *
     * @param  string  $path
     * @param  string  $disk
     * @return string
     *
     * @throws RuntimeException
     */
    public function url($path, $disk = ''): string
    {
        if ($disk !== '') {
            return Storage::disk($disk)->url($path);
        }
        return Storage::url($path);
    }

    /**
     * Get the file size of a given file in bytes.
     *
     * @param  string  $path
     * @param  string  $disk
     * @return int
     */
    public function size($path, $disk = ''): int
    {
        if ($disk !== '') {
            return Storage::disk($disk)->size($path);
        }
        return Storage::size($path);
    }

    /**
     * Copy a file to a new location.
     *
     * @param  string  $from
     * @param  string  $to
     * @param  string  $disk
     * @return bool
     */
    public function copy($from, $to, $disk = ''): bool
    {
        if ($disk !== '') {
            return Storage::disk($disk)->copy($from, $to);
        }
        return Storage::copy($from, $to);
    }

    /**
     * Move a file to a new location.
     *
     * @param  string  $from
     * @param  string  $to
     * @param  string  $disk
     * @return bool
     */
    public function move($from, $to, $disk = ''): bool
    {
        if ($disk !== '') {
            return Storage::disk($disk)->move($from, $to);
        }
        return Storage::move($from, $to);
    }

    /**
     * Get the visibility for the given path.
     *
     * @param  string  $path
     * @param  string  $disk
     * @return string
     */
    public function getVisibility($path, $disk = ''): string
    {
        if ($disk !== '') {
            return Storage::disk($disk)->getVisibility($path);
        }
        return Storage::getVisibility($path);
    }

    /**
     * Set the visibility for the given path.
     *
     * @param  string  $path
     * @param  string  $visibility
     * @param  string  $disk
     * @return bool
     */
    public function setVisibility($path, $visibility, $disk = ''): bool
    {
        if ($disk !== '') {
            return Storage::disk($disk)->setVisibility($path, $visibility);
        }
        return Storage::setVisibility($path, $visibility);
    }

    /**
     * Delete a single file or an array of files at a given path.
     *
     * @param  string|array  $paths
     * @param  string  $disk
     * @return bool
     */
    public function delete($paths, $disk = ''): bool
    {
        if ($disk !== '') {
            return Storage::disk($disk)->delete($paths);
        }
        return Storage::delete($paths);
    }

    /**
     * Get an array of all files in a directory.
     *
     * @param  string|null  $directory
     * @param  bool  $recursive
     * @param  string  $disk
     * @return array
     */
    public function files($directory = null, $recursive = false, $disk = ''): array
    {
        if ($disk !== '') {
            return Storage::disk($disk)->files($directory, $recursive);
        }
        return Storage::files($directory, $recursive);
    }

    /**
     * Get all of the files from the given directory including all sub-directories
     * (recursive).
     *
     * @param  string|null  $directory
     * @param  string  $disk
     * @return array
     */
    public function allFiles($directory = null, $disk = ''): array
    {
        if ($disk !== '') {
            return Storage::disk($disk)->allFiles($directory);
        }
        return Storage::allFiles($directory);
    }

    /**
     * @param $request
     * @param  string  $path
     * @param $postId
     * @return false|string
     */
    public function storeImage($request, $path, $postId)
    {
        if ($file = $request->file('file')) {
            return $this->putFileAs($path, $file, $postId
                . '.' . $file->getClientOriginalExtension());
        }
        return false;
    }

    /**
     * @param  string  $path
     * @param $postId
     * @return false|string
     */
    public function getImage($path, $postId)
    {
        if ($files = $this->files($path)) {
            foreach ($files as $file) {
                if (stripos($file, (string) $postId) !== false) {
                    return $this->url($file);
                }
            }
        }
        return false;
    }
}
