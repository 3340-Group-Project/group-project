<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class SiteSettings
{
    private const FILE = 'site-settings.json';
    private const ALLOWED_THEMES = ['default', 'dark', 'seasonal'];

    private static function readAll(): array
    {
        try {
            $disk = Storage::disk('local');
            if (!$disk->exists(self::FILE)) return [];
            $raw = $disk->get(self::FILE);
            $data = json_decode($raw, true);
            return is_array($data) ? $data : [];
        } catch (\Throwable $e) {
            return [];
        }
    }

    private static function writeAll(array $data): void
    {
        Storage::disk('local')->put(self::FILE, json_encode($data, JSON_PRETTY_PRINT));
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        $all = self::readAll();
        return array_key_exists($key, $all) ? $all[$key] : $default;
    }

    public static function set(string $key, mixed $value): void
    {
        $all = self::readAll();
        $all[$key] = $value;
        self::writeAll($all);
    }

    public static function getTheme(string $default = 'default'): string
    {
        $theme = (string) self::get('site_theme', $default);
        return in_array($theme, self::ALLOWED_THEMES, true) ? $theme : $default;
    }

    public static function setTheme(string $theme): void
    {
        if (!in_array($theme, self::ALLOWED_THEMES, true)) {
            $theme = 'default';
        }
        self::set('site_theme', $theme);
    }

    /** @return string[] lowercased emails */
    public static function getAdminEmails(): array
    {
        $emails = self::get('admin_emails', []);
        if (!is_array($emails)) $emails = [];
        return array_values(array_unique(array_map(fn($e) => strtolower(trim((string)$e)), $emails)));
    }

    public static function toggleAdminEmail(string $email): void
    {
        $email = strtolower(trim($email));
        if ($email === '') return;

        $emails = self::getAdminEmails();
        if (in_array($email, $emails, true)) {
            $emails = array_values(array_filter($emails, fn($x) => $x !== $email));
        } else {
            $emails[] = $email;
            $emails = array_values(array_unique($emails));
        }
        self::set('admin_emails', $emails);
    }

    /** @return string[] lowercased emails */
    public static function getDisabledEmails(): array
    {
        $emails = self::get('disabled_emails', []);
        if (!is_array($emails)) $emails = [];
        return array_values(array_unique(array_map(fn($e) => strtolower(trim((string)$e)), $emails)));
    }

    public static function toggleDisabledEmail(string $email): void
    {
        $email = strtolower(trim($email));
        if ($email === '') return;

        $emails = self::getDisabledEmails();
        if (in_array($email, $emails, true)) {
            $emails = array_values(array_filter($emails, fn($x) => $x !== $email));
        } else {
            $emails[] = $email;
            $emails = array_values(array_unique($emails));
        }
        self::set('disabled_emails', $emails);
    }
}
