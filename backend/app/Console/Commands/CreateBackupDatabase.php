<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\LogicException;
use Symfony\Component\Process\Exception\RuntimeException;
use Carbon\Carbon;

/**
 * Class CreateBackupDatabase
 * @package App\Console\Commands
 */
class CreateBackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create backup of database';

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws LogicException
     * @throws RuntimeException
     */
    public function handle()
    {
        try {
            $this->checkDir(storage_path('backups'));
            $date = Carbon::now()->format('d-m-Y');
            $process = new Process(sprintf(
                "mysqldump --single-transaction -h%s -u%s -p%s %s | gzip > %s",
                config("database.connections.mysql.host"),
                config("database.connections.mysql.username"),
                config("database.connections.mysql.password"),
                config("database.connections.mysql.database"),
                storage_path("backups/$date.sql.gz")
            ));
            $process->mustRun();
            $success = "The backup has been created successfully!";
            Log::info($success);
            $this->info($success);
        } catch (RuntimeException | LogicException $exception) {
            $fail = "The backup process has been failed.";
            Log::error($fail, (array) $exception);
            $this->error($fail);
        }
    }

    /**
     * Check existence of directory. If directory doesn't exist will create one.
     *
     * @param  string  $directory
     * @throws RuntimeException
     */
    protected function checkDir(string $directory): void
    {
        if (!is_dir($directory) && (!mkdir($directory) && !is_dir($directory))) {
            throw new RuntimeException(sprintf(
                'Directory "%s" was not created',
                $directory
            ));
        }
    }
}
