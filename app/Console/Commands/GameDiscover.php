<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GameDiscover extends Command
{
    protected $signature = 'game:discover {--connection=pgsql_game}';

    protected $description = 'Inspect the game-server Postgres DB to surface table + column names for the GameAccount model.';

    public function handle(): int
    {
        $conn = (string) $this->option('connection');

        try {
            DB::connection($conn)->getPdo();
        } catch (\Throwable $e) {
            $this->error("Cannot connect to '{$conn}': ".$e->getMessage());
            return self::FAILURE;
        }

        $this->info("Connected to '{$conn}'.");

        $this->matchedTables($conn);
        $this->accountsSchema($conn);
        $this->accountsSampleRow($conn);

        return self::SUCCESS;
    }

    private function matchedTables(string $conn): void
    {
        $rows = DB::connection($conn)->select(<<<'SQL'
            SELECT table_name
              FROM information_schema.tables
             WHERE table_schema = 'public'
               AND table_name ~* 'account|player|user|character|skill|item|activity'
             ORDER BY table_name
        SQL);

        $this->newLine();
        $this->line('<comment>Tables matching auth/game keywords:</comment>');
        foreach ($rows as $row) {
            $this->line('  - '.$row->table_name);
        }
    }

    private function accountsSchema(string $conn): void
    {
        $rows = DB::connection($conn)->select(<<<'SQL'
            SELECT column_name, data_type, is_nullable
              FROM information_schema.columns
             WHERE table_schema = 'public' AND table_name = 'accounts'
             ORDER BY ordinal_position
        SQL);

        $this->newLine();
        $this->line('<comment>accounts columns:</comment>');
        if ($rows === []) {
            $this->warn('  (table not found)');
            return;
        }
        foreach ($rows as $row) {
            $this->line(sprintf('  %-24s %-20s %s', $row->column_name, $row->data_type, $row->is_nullable));
        }
    }

    private function accountsSampleRow(string $conn): void
    {
        try {
            $row = DB::connection($conn)->table('accounts')->first();
        } catch (\Throwable $e) {
            $this->warn('  Could not read sample row: '.$e->getMessage());
            return;
        }

        if ($row === null) {
            $this->warn('  accounts table is empty');
            return;
        }

        $this->newLine();
        $this->line('<comment>accounts sample row (password masked):</comment>');
        foreach ((array) $row as $col => $val) {
            $display = match (true) {
                in_array($col, ['password', 'password_hash', 'pass'], true) && is_string($val) => $this->maskHash($val),
                is_string($val) && strlen($val) > 80 => substr($val, 0, 80).'…',
                default => (string) $val,
            };
            $this->line(sprintf('  %-24s %s', $col, $display));
        }
    }

    private function maskHash(string $hash): string
    {
        if (strlen($hash) <= 7) {
            return str_repeat('*', strlen($hash));
        }
        return substr($hash, 0, 7).str_repeat('*', max(0, strlen($hash) - 7));
    }
}
