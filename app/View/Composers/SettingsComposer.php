<?php

namespace App\View\Composers;

use App\Models\Setting;
use Illuminate\View\View;

class SettingsComposer
{
    /**
     * Bind settings data to the view.
     * All Setting::get() calls are consolidated here — views must never call models directly.
     */
    public function compose(View $view): void
    {
        $aboutPhoto = Setting::get('about_photo', 'assets/images/profile-avatar.png');
        if ($aboutPhoto && ! str_starts_with($aboutPhoto, 'assets/') && ! str_starts_with($aboutPhoto, 'http') && ! str_starts_with($aboutPhoto, 'storage/')) {
            $aboutPhoto = ltrim(\Illuminate\Support\Facades\Storage::disk('public')->url($aboutPhoto), '/');
        }

        $aboutResume = Setting::get('about_resume');
        if ($aboutResume && ! str_starts_with($aboutResume, 'http') && ! str_starts_with($aboutResume, 'storage/')) {
            $aboutResume = ltrim(\Illuminate\Support\Facades\Storage::disk('public')->url($aboutResume), '/');
        }

        $view->with('globalSettings', [
            // SEO
            'seo_meta_title'       => Setting::get('seo_meta_title', 'Ghoza Himma Al Farizqi | Software Developer & Backend Developer'),
            'seo_meta_description' => Setting::get('seo_meta_description', 'Fresh Graduate D3 Manajemen Informatika dari Politeknik Negeri Jember.'),
            'seo_keywords'         => Setting::get('seo_keywords', 'Laravel, Backend, Flutter, IoT, ESP32'),
            'seo_robots'           => Setting::get('seo_robots', 'index, follow'),
            'seo_og_image'         => Setting::get('seo_og_image', 'assets/images/profile-avatar.png'),
            'seo_twitter_card'     => Setting::get('seo_twitter_card', 'summary_large_image'),

            // Profile
            'about_headline'       => Setting::get('about_headline', 'Software Developer / Backend Developer'),
            'about_biography'      => Setting::get('about_biography', ''),
            'about_photo'          => $aboutPhoto,
            'about_resume'         => $aboutResume,
            'about_career_goal'    => Setting::get('about_career_goal', ''),
            'about_current_focus'  => Setting::get('about_current_focus', ''),

            // Contact
            'contact_email'        => Setting::get('contact_email', ''),
            'contact_phone'        => Setting::get('contact_phone', ''),
            'contact_whatsapp'     => Setting::get('contact_whatsapp', ''),
            'contact_linkedin'     => Setting::get('contact_linkedin', ''),
            'contact_github'       => Setting::get('contact_github', ''),
            'contact_instagram'    => Setting::get('contact_instagram', ''),
            'contact_location'     => Setting::get('contact_location', ''),
            'contact_google_maps'  => Setting::get('contact_google_maps', ''),
        ]);
    }
}
