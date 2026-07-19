<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Project;
use App\Models\Experience;
use App\Models\Certificate;
use App\Models\Skill;
use App\Models\Education;
use App\Models\SocialLink;
use App\Models\Setting;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Truncate existing data to prevent duplicates
        User::truncate();
        Project::truncate();
        Experience::truncate();
        Certificate::truncate();
        Skill::truncate();
        Education::truncate();
        SocialLink::truncate();
        Setting::truncate();

        // 2. Seed Default Administrator Account
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        // 3. Seed Settings Defaults
        Setting::set('about_headline', 'Software Developer / Backend Specialist');
        Setting::set('about_biography', 'Perjalanan saya di dunia rekayasa perangkat lunak dimulai dari ketertarikan mendalam pada bagaimana data bergerak dari sensor fisik ke server cloud. Melalui studi formal dan proyek praktis, saya mendalami arsitektur backend, pemrosesan sensor telemetry, serta protokol API yang aman.');
        Setting::set('about_career_goal', 'Merancang API endpoints RESTful yang aman dengan enkripsi data (seperti QR Verification) dan JSON payloads.');
        Setting::set('about_current_focus', 'Menghubungkan ESP32 node sensor telemetry ke web backend untuk monitoring log volume data waktu nyata.');
        Setting::set('about_photo', 'assets/images/profile-avatar.png');
        Setting::set('about_resume', '');

        Setting::set('contact_email', 'ghozahimma65@gmail.com');
        Setting::set('contact_phone', '6285156326165');
        Setting::set('contact_whatsapp', '6285156326165');
        Setting::set('contact_linkedin', 'https://www.linkedin.com/in/ghozahimma');
        Setting::set('contact_github', 'https://github.com/ghozahimma65');
        Setting::set('contact_instagram', 'https://www.instagram.com/ghozahimma');
        Setting::set('contact_location', 'Malang, East Java, Indonesia');
        Setting::set('contact_google_maps', '');

        Setting::set('seo_meta_title', 'Ghoza Himma Al Farizqi | Software Developer & Backend Developer');
        Setting::set('seo_meta_description', 'Fresh Graduate D3 Manajemen Informatika dari Politeknik Negeri Jember. Berpengalaman membangun aplikasi web Laravel, mobile Flutter, dan sistem monitoring IoT telemetry.');
        Setting::set('seo_keywords', 'Laravel, Backend, Flutter, IoT, ESP32');
        Setting::set('seo_og_image', 'assets/images/profile-avatar.png');
        Setting::set('seo_twitter_card', 'summary_large_image');
        Setting::set('seo_robots', 'index, follow');

        // 4. Seed Projects
        Project::create([
            'title' => 'PAUD Monitoring & Student Pickup Security System',
            'slug' => 'paud-monitoring-system',
            'role' => 'Lead Full-Stack & IoT Developer',
            'duration' => '4 Months',
            'description' => 'A comprehensive web and Android application designed to track and monitor early childhood development progress and secure the student pickup process using encrypted QR Codes.',
            'problem' => 'Early childhood development progress was tracked manually on paper, leading to lost data, and student pickups were insecure due to unverified guardians.',
            'solution' => 'Developed a Laravel back-end with Flutter clients implementing encrypted QR code checks for pickup guards and online development cards.',
            'result' => 'Zero check-in verification errors, 100% guardian authentication records, and real-time development tracking for parents.',
            'github_url' => 'https://github.com/ghozahimma65/paud-monitoring-system',
            'demo_url' => null,
            'tech_stack' => ['Laravel', 'Flutter', 'MySQL', 'REST API', 'QR Code'],
            'features' => ['Multi Role Auth', 'Student Development CRUD', 'QR Code Verification', 'Home Visit Logs', 'REST API Integrations'],
            'image_path' => 'assets/images/project-paud.png',
            'status' => 'published',
            'order' => 1,
        ]);

        Project::create([
            'title' => 'DEVO IoT Monitoring System',
            'slug' => 'devo-iot-monitoring',
            'role' => 'IoT Systems Engineer',
            'duration' => '3 Months',
            'description' => 'An automated IoT dashboard designed for monitoring waste depot volumes in real time, leveraging ESP32 sensor node transmissions and displaying analytical charts.',
            'problem' => 'Waste disposal depots suffered from irregular overflows and inefficient cleanup routing due to lack of telemetry.',
            'solution' => 'Developed an automated ESP32-based volume reader system streaming telemetry to a Laravel REST API and a real-time analytics dashboard.',
            'result' => 'Reduced depot overflow events and enabled dynamic, telemetry-driven truck routing.',
            'github_url' => 'https://github.com/ghozahimma65/devo-iot-monitoring',
            'demo_url' => null,
            'tech_stack' => ['Laravel', 'ESP32', 'MySQL', 'REST API', 'IoT Sensors'],
            'features' => ['Realtime Dashboard Analytics', 'Sensor Data Stream Processing', 'ESP32 Device Configuration', 'Threshold Alerts & Notifications'],
            'image_path' => 'assets/images/project-devo.png',
            'status' => 'published',
            'order' => 2,
        ]);

        Project::create([
            'title' => 'LBB Cendekia Website',
            'slug' => 'lbb-cendekia-web',
            'role' => 'Web Developer',
            'duration' => '2 Months',
            'description' => 'A robust corporate portal and management system for LBB Cendekia, simplifying student registrations, content maintenance, and internal business dashboards.',
            'problem' => 'Course registrations, student payments, and content updates were managed manually, causing administrative bottlenecking.',
            'solution' => 'Built a customized dashboard with an admin enrollment workflow and self-service student pipeline.',
            'result' => 'Automated student registration pipeline and reduced administrative manual entry overhead by 60%.',
            'github_url' => 'https://github.com/ghozahimma65/lbb-cendekia-web',
            'demo_url' => null,
            'tech_stack' => ['Laravel', 'PHP', 'MySQL', 'Bootstrap'],
            'features' => ['Student Registration Pipeline', 'Content Management CRUD', 'Admin Business Dashboard', 'Bug Fixing & Speed Optimization'],
            'image_path' => 'assets/images/project-cendekia.png',
            'status' => 'published',
            'order' => 3,
        ]);

        // 5. Seed Experiences
        Experience::create([
            'role' => 'Software Developer Intern',
            'company' => 'PT Sarana Insan Muda Selaras',
            'location' => 'Yogyakarta, Indonesia',
            'start_date' => 'August 2025',
            'end_date' => 'December 2025',
            'current_position' => false,
            'responsibilities' => [
                'Developed scalable backend APIs and dashboards using Laravel framework.',
                'Resolved and debugged legacy codebase issues through structured bug fixing workflows.',
                'Built and integrated real-time data flows between ESP32 microcontrollers and Laravel backends.',
                'Designed database architectures, optimizing MySQL query execution for telemetry data.',
                'Collaborated with a cross-functional dev team using Git and agile project management tools.'
            ],
            'order' => 1,
        ]);

        // 6. Seed Certificates
        Certificate::create([
            'title' => 'Certificate of Competency',
            'issuer' => 'LSP / BNSP Indonesia',
            'issue_date' => '2024',
            'image_path' => 'assets/images/cert-competency.png',
            'credential_url' => null,
            'category' => 'Programming',
            'featured' => true,
            'order' => 1,
        ]);

        Certificate::create([
            'title' => 'IQF Level 3 Animation',
            'issuer' => 'Kementerian Pendidikan dan Kebudayaan',
            'issue_date' => '2023',
            'image_path' => 'assets/images/cert-animation.png',
            'credential_url' => null,
            'category' => 'Design',
            'featured' => false,
            'order' => 2,
        ]);

        Certificate::create([
            'title' => 'Junior Mobile Computing',
            'issuer' => 'Digitalent Scholarship - Kominfo',
            'issue_date' => '2024',
            'image_path' => 'assets/images/cert-mobile.png',
            'credential_url' => null,
            'category' => 'Mobile',
            'featured' => true,
            'order' => 3,
        ]);

        Certificate::create([
            'title' => 'Graphic Design Training',
            'issuer' => 'UPT Balai Latihan Kerja Madiun',
            'issue_date' => '2022',
            'image_path' => 'assets/images/cert-graphic.png',
            'credential_url' => null,
            'category' => 'Design',
            'featured' => false,
            'order' => 4,
        ]);

        // 7. Seed Skills
        $skills = [
            // Backend
            ['name' => 'PHP', 'category' => 'Backend', 'icon' => 'bi bi-code-slash', 'level' => 'Advanced', 'order' => 1],
            ['name' => 'Laravel', 'category' => 'Backend', 'icon' => 'bi bi-server', 'level' => 'Advanced', 'order' => 2],
            // Database
            ['name' => 'MySQL', 'category' => 'Database', 'icon' => 'bi bi-database-fill', 'level' => 'Advanced', 'order' => 1],
            ['name' => 'SQLite', 'category' => 'Database', 'icon' => 'bi bi-filetype-sql', 'level' => 'Intermediate', 'order' => 2],
            // API
            ['name' => 'REST API', 'category' => 'API', 'icon' => 'bi bi-braces', 'level' => 'Advanced', 'order' => 1],
            ['name' => 'JSON Payload', 'category' => 'API', 'icon' => 'bi bi-filetype-json', 'level' => 'Advanced', 'order' => 2],
            // Mobile
            ['name' => 'Dart', 'category' => 'Mobile', 'icon' => 'bi bi-code', 'level' => 'Intermediate', 'order' => 1],
            ['name' => 'Flutter', 'category' => 'Mobile', 'icon' => 'bi bi-phone', 'level' => 'Intermediate', 'order' => 2],
            // IoT
            ['name' => 'ESP32', 'category' => 'IoT', 'icon' => 'bi bi-cpu', 'level' => 'Intermediate', 'order' => 1],
            ['name' => 'Telemetry Sensors', 'category' => 'IoT', 'icon' => 'bi bi-broadcast', 'level' => 'Intermediate', 'order' => 2],
            // Frontend
            ['name' => 'HTML5', 'category' => 'Frontend', 'icon' => 'bi bi-filetype-html', 'level' => 'Advanced', 'order' => 1],
            ['name' => 'CSS3', 'category' => 'Frontend', 'icon' => 'bi bi-filetype-css', 'level' => 'Advanced', 'order' => 2],
            ['name' => 'JavaScript', 'category' => 'Frontend', 'icon' => 'bi bi-filetype-js', 'level' => 'Intermediate', 'order' => 3],
            ['name' => 'Bootstrap', 'category' => 'Frontend', 'icon' => 'bi bi-bootstrap', 'level' => 'Advanced', 'order' => 4],
            // Tools
            ['name' => 'Git', 'category' => 'Tools', 'icon' => 'bi bi-git', 'level' => 'Advanced', 'order' => 1],
            ['name' => 'GitHub', 'category' => 'Tools', 'icon' => 'bi bi-github', 'level' => 'Advanced', 'order' => 2],
            ['name' => 'VS Code', 'category' => 'Tools', 'icon' => 'bi bi-terminal-fill', 'level' => 'Advanced', 'order' => 3],
            ['name' => 'Android Studio', 'category' => 'Tools', 'icon' => 'bi bi-android2', 'level' => 'Intermediate', 'order' => 4],
            ['name' => 'Postman', 'category' => 'Tools', 'icon' => 'bi bi-send-fill', 'level' => 'Advanced', 'order' => 5],
            ['name' => 'Figma', 'category' => 'Tools', 'icon' => 'bi bi-figma', 'level' => 'Intermediate', 'order' => 6],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // 8. Seed Education Timeline
        Education::create([
            'school' => 'Politeknik Negeri Jember',
            'degree' => 'Diploma III (D3)',
            'major' => 'Manajemen Informatika',
            'start_date' => '2023',
            'end_date' => '2026',
            'description' => 'Mempelajari rekayasa perangkat lunak dasar, struktur data, basis data relasional, pemrograman berorientasi objek (OOP), perancangan sistem informasi, dan UI/UX design. Fokus tugas akhir dan proyek praktis mencakup implementasi full-stack web, mobile integration, dan Internet of Things (IoT).',
            'order' => 1,
        ]);

        // 9. Seed Social Links
        SocialLink::create([
            'platform' => 'GitHub',
            'icon' => 'bi bi-github',
            'url' => 'https://github.com/ghozahimma65',
            'order' => 1,
        ]);

        SocialLink::create([
            'platform' => 'LinkedIn',
            'icon' => 'bi bi-linkedin',
            'url' => 'https://www.linkedin.com/in/ghozahimma',
            'order' => 2,
        ]);
    }
}
