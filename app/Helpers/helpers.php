<?php

/**
 * Blood Bank Application Helper Functions
 *
 * Global helper functions that can be used throughout the application.
 * These functions are automatically loaded via composer.json autoload.files.
 */

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

if (!function_exists('settings')) {
    /**
     * Get application settings
     *
     * @param string|null $key Optional key to get specific setting
     * @param mixed $default Default value if setting not found
     * @return mixed
     */
    function settings(?string $key = null, $default = null)
    {
        $settings = Setting::first();

        if (!$settings) {
            return $default;
        }

        if ($key) {
            return $settings->$key ?? $default;
        }

        return $settings;
    }
}

if (!function_exists('current_user')) {
    /**
     * Get the currently authenticated user
     *
     * @param string $guard Optional guard name
     * @return \App\Models\User|\App\Models\Client|null
     */
    function current_user(?string $guard = null)
    {
        return $guard ? Auth::guard($guard)->user() : Auth::user();
    }
}

if (!function_exists('current_client')) {
    /**
     * Get the currently authenticated client
     *
     * @return \App\Models\Client|null
     */
    function current_client()
    {
        return Auth::guard('client-web')->user();
    }
}

if (!function_exists('is_admin')) {
    /**
     * Check if current user is an admin
     *
     * @return bool
     */
    function is_admin(): bool
    {
        $user = current_user();
        return $user && $user->isAdmin();
    }
}

if (!function_exists('is_moderator')) {
    /**
     * Check if current user is a moderator
     *
     * @return bool
     */
    function is_moderator(): bool
    {
        $user = current_user();
        return $user && $user->isModerator();
    }
}

if (!function_exists('has_role')) {
    /**
     * Check if current user has a specific role
     *
     * @param string|array $role
     * @return bool
     */
    function has_role($role): bool
    {
        $user = current_user();
        return $user && $user->hasRole($role);
    }
}

if (!function_exists('has_permission')) {
    /**
     * Check if current user has a specific permission
     *
     * @param string $permission
     * @return bool
     */
    function has_permission(string $permission): bool
    {
        $user = current_user();
        return $user && $user->can($permission);
    }
}

if (!function_exists('format_blood_type')) {
    /**
     * Format blood type with proper styling
     *
     * @param string $bloodType
     * @return string
     */
    function format_blood_type(string $bloodType): string
    {
        return strtoupper(trim($bloodType));
    }
}

if (!function_exists('blood_type_badge')) {
    /**
     * Generate HTML badge for blood type
     *
     * @param string $bloodType
     * @param string $class Additional CSS classes
     * @return string
     */
    function blood_type_badge(string $bloodType, string $class = ''): string
    {
        $formatted = format_blood_type($bloodType);
        $colors = [
            'A+'  => 'badge-danger',
            'A-'  => 'badge-warning',
            'B+'  => 'badge-info',
            'B-'  => 'badge-primary',
            'AB+' => 'badge-success',
            'AB-' => 'badge-secondary',
            'O+'  => 'badge-dark',
            'O-'  => 'badge-light',
        ];

        $badgeClass = $colors[$formatted] ?? 'badge-secondary';
        $class = trim("badge {$badgeClass} {$class}");

        return "<span class='{$class}'>{$formatted}</span>";
    }
}

if (!function_exists('format_phone')) {
    /**
     * Format phone number
     *
     * @param string $phone
     * @return string
     */
    function format_phone(string $phone): string
    {
        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Format as needed (customize based on your country)
        if (strlen($phone) == 11) {
            return preg_replace('/(\d{4})(\d{3})(\d{4})/', '$1-$2-$3', $phone);
        }

        return $phone;
    }
}

if (!function_exists('time_ago')) {
    /**
     * Get human-readable time difference
     *
     * @param string|\Carbon\Carbon $datetime
     * @return string
     */
    function time_ago($datetime): string
    {
        return \Carbon\Carbon::parse($datetime)->diffForHumans();
    }
}

if (!function_exists('generate_notification_title')) {
    /**
     * Generate notification title for donation request
     *
     * @param string $bloodType
     * @param string $cityName
     * @return string
     */
    function generate_notification_title(string $bloodType, string $cityName): string
    {
        return "Urgent: {$bloodType} Blood Needed in {$cityName}";
    }
}

if (!function_exists('notification_icon')) {
    /**
     * Get notification icon based on type
     *
     * @param string $type
     * @return string
     */
    function notification_icon(string $type = 'info'): string
    {
        $icons = [
            'donation' => 'fa-tint',
            'success'  => 'fa-check-circle',
            'error'    => 'fa-exclamation-circle',
            'warning'  => 'fa-exclamation-triangle',
            'info'     => 'fa-info-circle',
        ];

        return $icons[$type] ?? $icons['info'];
    }
}

if (!function_exists('format_date')) {
    /**
     * Format date in a readable format
     *
     * @param string|\Carbon\Carbon $date
     * @param string $format
     * @return string
     */
    function format_date($date, string $format = 'Y-m-d'): string
    {
        if (!$date) {
            return '';
        }

        return \Carbon\Carbon::parse($date)->format($format);
    }
}

if (!function_exists('format_datetime')) {
    /**
     * Format datetime in a readable format
     *
     * @param string|\Carbon\Carbon $datetime
     * @param string $format
     * @return string
     */
    function format_datetime($datetime, string $format = 'Y-m-d H:i:s'): string
    {
        if (!$datetime) {
            return '';
        }

        return \Carbon\Carbon::parse($datetime)->format($format);
    }
}

if (!function_exists('age_from_dob')) {
    /**
     * Calculate age from date of birth
     *
     * @param string|\Carbon\Carbon $dob
     * @return int
     */
    function age_from_dob($dob): int
    {
        if (!$dob) {
            return 0;
        }

        return \Carbon\Carbon::parse($dob)->age;
    }
}

if (!function_exists('can_donate_blood')) {
    /**
     * Check if client can donate blood (based on last donation date)
     * Minimum 90 days between donations
     *
     * @param string|\Carbon\Carbon|null $lastDonationDate
     * @return bool
     */
    function can_donate_blood($lastDonationDate): bool
    {
        if (!$lastDonationDate) {
            return true; // Never donated before
        }

        $daysSinceLastDonation = \Carbon\Carbon::parse($lastDonationDate)->diffInDays(now());
        return $daysSinceLastDonation >= 90; // 3 months minimum
    }
}

if (!function_exists('days_until_next_donation')) {
    /**
     * Calculate days until client can donate again
     *
     * @param string|\Carbon\Carbon|null $lastDonationDate
     * @return int
     */
    function days_until_next_donation($lastDonationDate): int
    {
        if (!$lastDonationDate) {
            return 0;
        }

        $daysSinceLastDonation = \Carbon\Carbon::parse($lastDonationDate)->diffInDays(now());
        $daysRemaining = 90 - $daysSinceLastDonation;

        return max(0, $daysRemaining);
    }
}

if (!function_exists('asset_image')) {
    /**
     * Get image asset with fallback
     *
     * @param string|null $path
     * @param string $default
     * @return string
     */
    function asset_image(?string $path, string $default = 'images/default.png'): string
    {
        if (!$path || !file_exists(public_path($path))) {
            return asset($default);
        }

        return asset($path);
    }
}

if (!function_exists('truncate_text')) {
    /**
     * Truncate text to specified length
     *
     * @param string $text
     * @param int $length
     * @param string $suffix
     * @return string
     */
    function truncate_text(string $text, int $length = 100, string $suffix = '...'): string
    {
        return Str::limit($text, $length, $suffix);
    }
}

if (!function_exists('status_badge')) {
    /**
     * Generate status badge HTML
     *
     * @param string $status
     * @param array $customColors
     * @return string
     */
    function status_badge(string $status, array $customColors = []): string
    {
        $defaultColors = [
            'pending'   => 'badge-warning',
            'approved'  => 'badge-success',
            'rejected'  => 'badge-danger',
            'completed' => 'badge-info',
            'active'    => 'badge-success',
            'inactive'  => 'badge-secondary',
        ];

        $colors = array_merge($defaultColors, $customColors);
        $class = $colors[strtolower($status)] ?? 'badge-secondary';
        $displayStatus = ucfirst($status);

        return "<span class='badge {$class}'>{$displayStatus}</span>";
    }
}

if (!function_exists('flash_success')) {
    /**
     * Flash success message to session
     *
     * @param string $message
     * @return void
     */
    function flash_success(string $message): void
    {
        session()->flash('success', $message);
    }
}

if (!function_exists('flash_error')) {
    /**
     * Flash error message to session
     *
     * @param string $message
     * @return void
     */
    function flash_error(string $message): void
    {
        session()->flash('error', $message);
    }
}

if (!function_exists('flash_warning')) {
    /**
     * Flash warning message to session
     *
     * @param string $message
     * @return void
     */
    function flash_warning(string $message): void
    {
        session()->flash('warning', $message);
    }
}

if (!function_exists('flash_info')) {
    /**
     * Flash info message to session
     *
     * @param string $message
     * @return void
     */
    function flash_info(string $message): void
    {
        session()->flash('info', $message);
    }
}

if (!function_exists('is_route')) {
    /**
     * Check if current route matches given route name
     *
     * @param string|array $route
     * @return bool
     */
    function is_route($route): bool
    {
        if (is_array($route)) {
            return in_array(request()->route()->getName(), $route);
        }

        return request()->route()->getName() === $route;
    }
}

if (!function_exists('active_route')) {
    /**
     * Return 'active' class if current route matches
     *
     * @param string|array $route
     * @param string $class
     * @return string
     */
    function active_route($route, string $class = 'active'): string
    {
        return is_route($route) ? $class : '';
    }
}

if (!function_exists('json_response')) {
    /**
     * Return standardized JSON response
     *
     * @param bool $success
     * @param string $message
     * @param mixed $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    function json_response(bool $success, string $message, $data = null, int $code = 200)
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data'    => $data,
        ], $code);
    }
}

if (!function_exists('upload_file')) {
    /**
     * Upload file and return path
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $folder
     * @param string $disk
     * @return string|false
     */
    function upload_file($file, string $folder = 'uploads', string $disk = 'public')
    {
        if (!$file || !$file->isValid()) {
            return false;
        }

        return $file->store($folder, $disk);
    }
}

if (!function_exists('delete_file')) {
    /**
     * Delete file from storage
     *
     * @param string $path
     * @param string $disk
     * @return bool
     */
    function delete_file(string $path, string $disk = 'public'): bool
    {
        if (!$path) {
            return false;
        }

        return \Illuminate\Support\Facades\Storage::disk($disk)->delete($path);
    }
}
