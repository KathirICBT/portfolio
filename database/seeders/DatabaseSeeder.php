<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        DB::table('users')->insert([
            'name'       => 'Suresh Kumar',
            'email'      => 'admin@sureshkumar.ca',
            'password'   => Hash::make('Admin@123456'),
            'is_admin'   => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Sliders
        DB::table('sliders')->insert([
            [
                'title'           => 'Strategic Business Advisor & Growth Consultant',
                'subtitle'        => 'Empowering SMEs through strategic foresight and authentic collaboration. With over 22 years of entrepreneurial experience, I help leaders navigate complex challenges to build sustainable, high-impact organizations.',
                'eyebrow_label'   => 'Strategic Advisory · GTA',
                'media_id'        => null,
                'overlay_color'   => '#1A3A5C',
                'overlay_opacity' => 0.75,
                'cta1_label'      => 'Book a Free Consultation',
                'cta1_url'        => '#contact',
                'cta2_label'      => 'Learn More',
                'cta2_url'        => '#about',
                'sort_order'      => 1,
                'is_active'       => true,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'title'           => 'Building Real Connections That Drive Real Results',
                'subtitle'        => 'Founder of the Connecting GTA Business Networking Club — a dynamic platform for professionals to collaborate, grow, and lead together across the Greater Toronto Area.',
                'eyebrow_label'   => 'Community · Networking',
                'media_id'        => null,
                'overlay_color'   => '#1A3A5C',
                'overlay_opacity' => 0.75,
                'cta1_label'      => 'Explore Our Network',
                'cta1_url'        => '#services',
                'cta2_label'      => null,
                'cta2_url'        => null,
                'sort_order'      => 2,
                'is_active'       => true,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'title'           => 'From Vision to Scalable Reality',
                'subtitle'        => 'Proven frameworks for early-stage companies and established businesses to overcome complexity, achieve long-term stability, and grow with confidence.',
                'eyebrow_label'   => 'Start-ups · Strategy',
                'media_id'        => null,
                'overlay_color'   => '#1A3A5C',
                'overlay_opacity' => 0.75,
                'cta1_label'      => 'View Services',
                'cta1_url'        => '#services',
                'cta2_label'      => 'Contact Us',
                'cta2_url'        => '#contact',
                'sort_order'      => 3,
                'is_active'       => true,
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);

        // Page sections
        $sections = [
            ['key' => 'nav',          'nav_label' => 'Home',         'anchor' => '#home',         'title' => 'Suresh Kumar',                              'subtitle' => 'Strategic Business Advisor',                           'body' => null, 'sort_order' => 0],
            ['key' => 'about',        'nav_label' => 'About',        'anchor' => '#about',        'title' => 'Experience When It Matters Most.',          'subtitle' => 'About Me',                                            'body' => "As a dedicated mentor and strategic consultant, my primary focus is empowering small and medium-sized businesses to unlock their full potential within an increasingly competitive landscape. With over 22 years of entrepreneurial experience—including a decade deeply rooted in the Greater Toronto Area—I provide the practical frameworks and leadership coaching necessary to overcome operational challenges. My mission is to transform ambitious visions into sustainable, profitable realities by helping business owners exercise the passion needed to take their projects to the next level.\n\nTo further this mission, I founded the Connecting GTA Business Networking Club, creating an effective platform for professionals to network, learn, and grow together. This initiative, alongside my work with Kashden Consulting, is built on the belief that authentic relationships are the true catalyst for business success. By fostering a culture of collaboration and strategic leadership, I help entrepreneurs move beyond simple transactions to build a lasting presence that is both more sustainable and profitable in the long term.\n\nMy commitment to the community is reflected in my volunteer leadership as a Board Director for the Alzheimer Society of Durham Region and the Canadian Tamil Chamber of Commerce. I also serve as a Committee Member at the Rouge Valley Health System Foundation and lead the 100 Men of Toronto initiative to support local grassroots organizations.", 'sort_order' => 1],
            ['key' => 'stats',        'nav_label' => null,           'anchor' => '#stats',        'title' => 'Solutions Through Experience',              'subtitle' => 'We Are Ready To Help You Get A Solution',             'body' => null, 'sort_order' => 2],
            ['key' => 'services',     'nav_label' => 'Services',     'anchor' => '#services',     'title' => 'What We Offer Our Clients.',               'subtitle' => 'Business Strategist & Consultant',                    'body' => 'True business success is rooted in the powerful combination of strategic insight and earned trust. By bridging the gap between visionary thinking and operational excellence, I help entrepreneurs build the authentic connections necessary to scale sustainably.', 'sort_order' => 3],
            ['key' => 'network',      'nav_label' => 'Network',      'anchor' => '#network',      'title' => 'Trusted Networks',                         'subtitle' => 'Influential Connections',                             'body' => 'Building relationships with community leaders, elected officials, and civic organizations across the Greater Toronto Area.', 'sort_order' => 4],
            ['key' => 'clients',      'nav_label' => null,           'anchor' => '#clients',      'title' => 'Clients & Partners',                       'subtitle' => 'Trusted By Local Businesses',                         'body' => null, 'sort_order' => 5],
            ['key' => 'testimonials', 'nav_label' => 'Testimonials', 'anchor' => '#testimonials', 'title' => 'What Our Clients Say',                     'subtitle' => 'Client Testimonials',                                 'body' => null, 'sort_order' => 6],
            ['key' => 'gallery',      'nav_label' => 'Gallery',      'anchor' => '#gallery',      'title' => 'Gallery',                                  'subtitle' => 'Photo Gallery',                                       'body' => null, 'sort_order' => 7],
            ['key' => 'cta',          'nav_label' => null,           'anchor' => '#cta',          'title' => 'We Are Ready To Help You Get A Solution.', 'subtitle' => null,                                                  'body' => 'Reach out today to explore how strategic mentorship and authentic networking can help your business thrive. Our team is dedicated to providing the solutions you need to scale your vision effectively.', 'sort_order' => 8],
            ['key' => 'contact',      'nav_label' => 'Contact',      'anchor' => '#contact',      'title' => 'Connect With Us',                          'subtitle' => 'Get In Touch',                                        'body' => 'Ready to take your business to the next level? Reach out for a free consultation and discover how strategic mentorship can transform your vision into reality.', 'sort_order' => 9],
        ];
        foreach ($sections as $s) {
            DB::table('page_sections')->insert([
                'key'        => $s['key'],
                'nav_label'  => $s['nav_label'],
                'anchor'     => $s['anchor'],
                'title'      => $s['title'],
                'subtitle'   => $s['subtitle'],
                'body'       => $s['body'],
                'extra_json' => null,
                'is_visible' => true,
                'sort_order' => $s['sort_order'],
                'updated_at' => now(),
            ]);
        }

        // Services
        $services = [
            ['icon' => 'chart-bar',   'title' => 'Strategic Business Advisory',         'body' => 'We provide comprehensive consulting services that help small and medium-sized enterprises navigate complex market shifts and operational hurdles. By identifying and adapting to economic changes, we ensure your business remains both sustainable and profitable in a demanding environment.',                                                        'sort_order' => 1],
            ['icon' => 'users',       'title' => 'Authentic Networking Platforms',       'body' => 'Through the Connecting GTA Business Networking Club, we offer a dynamic ecosystem where professionals move beyond transactional exchanges to build genuine relationships. Our monthly VIP events and leadership forums are designed to foster trust and open doors to high-value collaborations.',                                                    'sort_order' => 2],
            ['icon' => 'rocket',      'title' => 'Comprehensive Start-Up Support',       'body' => 'We guide new entrepreneurs through the overwhelming details of launching a business, from initial market research to defining a unique value proposition. Our team helps you craft a clear, cost-effective strategy and a solid business plan that sets measurable goals for long-term growth.',                                                    'sort_order' => 3],
            ['icon' => 'computer',    'title' => 'Advanced Technology Solutions',        'body' => 'Leveraging a strong foundation in tech infrastructure, we offer expert services in network engineering, custom software development, and technical support. We focus on modernizing your digital operations to increase productivity and give your business a competitive edge in a fast-paced market.',                                           'sort_order' => 4],
            ['icon' => 'megaphone',   'title' => 'Integrated Marketing & Branding',      'body' => 'Our marketing solutions encompass everything from branding and social media management to targeted email campaigns and high-impact digital outreach. We help you tell your authentic story across all social platforms, effectively showcasing your strengths to a wider audience of potential customers.',                                        'sort_order' => 5],
            ['icon' => 'building',    'title' => 'Public Affairs & Government Relations', 'body' => 'In partnership with Wellington Dupont, we provide clients with strategic counsel on policy, regulations, and stakeholder relations across North America. We use our deep experience in business and politics to help you achieve favorable results while navigating the complexities of government processes.',                                    'sort_order' => 6],
        ];
        foreach ($services as $svc) {
            DB::table('services')->insert(array_merge($svc, [
                'link_label' => null, 'link_url' => null,
                'is_active'  => true, 'created_at' => now(), 'updated_at' => now(),
            ]));
        }

        // Network Profiles
        $profiles = [
            ['name' => 'Mayor Shaun Collier',         'title' => 'Mayor of Ajax, Ontario',              'bio' => 'Shaun Collier is a Canadian politician currently serving as the Mayor of Ajax, Ontario. As mayor, he also serves on Durham Regional Council. Collier holds a chartered director degree from McMaster University.',                                                                  'sort_order' => 1],
            ['name' => 'Former Minister Tony Clement', 'title' => 'Former Member of Parliament',         'bio' => 'Tony Clement is a former federal politician and former Member of Parliament for Parry Sound—Muskoka in Ontario. Before entering federal politics, Clement served as an Ontario cabinet minister, including as Minister of Health and Long-Term Care.',                          'sort_order' => 2],
            ['name' => 'Mayor Patrick Brown',          'title' => 'Mayor of Brampton',                   'bio' => 'Patrick Brown is currently serving as the Mayor of Brampton. Brown was formerly the leader of the Progressive Conservative Party of Ontario and brings extensive political leadership experience to the Greater Toronto Area.',                                                  'sort_order' => 3],
            ['name' => 'Former Minister David Tsubouchi', 'title' => 'Former Ontario Cabinet Minister',  'bio' => 'Board member of the OMERS Pension Fund, author of "Gambatte" and "The Chinese Door", and former Ontario Cabinet Minister with decades of public service and community leadership experience.',                                                                                   'sort_order' => 4],
        ];
        foreach ($profiles as $p) {
            DB::table('network_profiles')->insert(array_merge($p, [
                'media_id' => null, 'is_active' => true,
                'created_at' => now(), 'updated_at' => now(),
            ]));
        }

        // Clients
        $clients = [
            'Ramachandral Law', 'HJK', 'Claireport',
            'Commercial Packaging', 'Big Rig Wraps', 'CTS Building', 'DF Credit Solution',
        ];
        foreach ($clients as $i => $name) {
            DB::table('clients')->insert([
                'media_id'   => null,
                'name'       => $name,
                'url'        => null,
                'sort_order' => $i + 1,
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Testimonials
        DB::table('testimonials')->insert([
            'quote'        => 'Suresh demonstrated a high level of competency and skill in producing results that were of high quality, and demonstrated expertise like I\'ve never seen before.',
            'author_name'  => 'Donald Blair',
            'author_title' => 'Business Partner',
            'media_id'     => null,
            'sort_order'   => 1,
            'is_active'    => true,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        // Stats
        $stats = [
            ['value' => '22',  'suffix' => '+', 'label' => 'Years of Strategic Experience',    'description' => 'Providing entrepreneurs with proven roadmaps and mentorship to navigate complex business challenges.',              'icon' => 'trophy',    'sort_order' => 1],
            ['value' => '200', 'suffix' => '+', 'label' => 'Partnerships Created',              'description' => 'Transforming local business interactions into long-term strategic partnerships rooted in trust.',                    'icon' => 'handshake', 'sort_order' => 2],
            ['value' => '1',   'suffix' => 'M+','label' => 'Raised for Healthcare & Community', 'description' => 'Supporting local healthcare systems and grassroots charities across the Greater Toronto Area.',                      'icon' => 'heart',     'sort_order' => 3],
            ['value' => '100', 'suffix' => '+', 'label' => 'Events Organized',                  'description' => 'Monthly networking events, leadership forums, and VIP sessions connecting professionals across the GTA.',           'icon' => 'calendar',  'sort_order' => 4],
        ];
        foreach ($stats as $s) {
            DB::table('stats')->insert(array_merge($s, ['is_active' => true, 'updated_at' => now()]));
        }

        // SEO
        DB::table('seo_settings')->insert([
            'entity_type'      => 'page',
            'entity_key'       => 'home',
            'meta_title'       => 'Suresh Kumar | Strategic Business Advisor & Growth Consultant – GTA',
            'meta_description' => 'Suresh Kumar is a Strategic Business Advisor and Growth Consultant with 22+ years of entrepreneurial experience. Empowering SMEs across the Greater Toronto Area through strategic mentorship, authentic networking, and proven business frameworks.',
            'canonical_url'    => 'https://sureshkumar.ca/',
            'og_title'         => 'Suresh Kumar – Strategic Business Advisor & Growth Consultant',
            'og_description'   => 'Helping SMEs across the Greater Toronto Area build sustainable, high-impact organizations through strategic foresight, authentic collaboration, and 22+ years of proven entrepreneurial experience.',
            'og_image_id'      => null,
            'twitter_card'     => 'summary_large_image',
            'robots'           => 'index, follow',
            'schema_json'      => json_encode([
                '@context' => 'https://schema.org',
                '@type'    => 'Person',
                'name'     => 'Suresh Kumar',
                'jobTitle' => 'Strategic Business Advisor & Growth Consultant',
                'url'      => 'https://sureshkumar.ca',
                'telephone'=> '+14168187444',
                'email'    => 'info@sureshkumar.ca',
                'address'  => [
                    '@type'           => 'PostalAddress',
                    'addressRegion'   => 'ON',
                    'addressCountry'  => 'CA',
                    'addressLocality' => 'Greater Toronto Area',
                ],
                'sameAs' => ['https://www.linkedin.com/in/sureshkumardca/'],
            ]),
            'updated_at' => now(),
        ]);

        // Site Settings
        $settings = [
            'site_name'             => 'Suresh Kumar',
            'tagline'               => 'Strategic Business Advisor & Growth Consultant',
            'footer_copyright'      => '© ' . date('Y') . ' Suresh Kumar. All rights reserved.',
            'contact_email'         => 'info@sureshkumar.ca',
            'contact_phone_main'    => '416-818-7444',
            'contact_phone_cgta'    => '416-917-7617',
            'contact_phone_kashden' => '416-333-2004',
            'form_recipient_email'  => 'info@sureshkumar.ca',
            'social_linkedin'       => 'https://www.linkedin.com/in/sureshkumardca/',
            'social_twitter'        => '',
            'social_facebook'       => '',
            'ga_id'                 => '',
            'maintenance_mode'      => '0',
            'cta_button_label'      => 'Book Free Consultation',
            'cta_button_url'        => '#contact',
        ];
        foreach ($settings as $k => $v) {
            DB::table('site_settings')->insert(['key' => $k, 'value' => $v, 'updated_at' => now()]);
        }
    }
}
