<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use LaraZeus\Sky\Models\Post;
use LaraZeus\Sky\Models\Tag;
use LaraZeus\Sky\Models\Library;
use LaraZeus\Sky\Models\Navigation;
use App\Models\User;
use App\Models\Event;
use App\Models\Business;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TestDataSeederClean extends Seeder
{
    /**
     * Run the database's seeds.
     */
    public function run(): void
    {
        // Ensure we have at least one admin user
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]);
        }

        // Create 10 test users
        $testUsers = User::factory(10)->create();

        // Create 100 additional users with businesses
        $businessUsers = User::factory(100)->create();

        // Create tags (categories and regular tags)
        $this->createTags();

        // Create posts
        $this->createPosts($user);

        // Create pages
        $this->createPages($user);

        // Create libraries
        $this->createLibraries($testUsers);

        // Create events for test users
        $this->createEvents($testUsers);

        // Create businesses for business users
        $this->createBusinessesForUsers($businessUsers);

        // Create navigation menu
        $this->createNavigation();

        $this->command->info('Test data created successfully!');
    }

    private function createTags(): void
    {
        $categories = [
            'Technology',
            'Business',
            'Health',
            'Education',
            'Entertainment'
        ];

        $tags = [
            'Laravel',
            'PHP',
            'JavaScript',
            'Vue.js',
            'React',
            'Digital Marketing',
            'Entrepreneurship',
            'Fitness',
            'Nutrition',
            'Online Learning'
        ];

        // Create categories
        foreach ($categories as $category) {
            Tag::create([
                'name' => ['en' => $category],
                'slug' => ['en' => Str::slug($category)],
                'type' => 'category',
                'order_column' => 0,
            ]);
        }

        // Create tags
        foreach ($tags as $tag) {
            Tag::create([
                'name' => ['en' => $tag],
                'slug' => ['en' => Str::slug($tag)],
                'type' => 'tag',
                'order_column' => 0,
            ]);
        }

        $this->command->info('Created ' . count($categories) . ' categories and ' . count($tags) . ' tags');
    }

    private function createPosts(User $user): void
    {
        $posts = [
            [
                'title' => 'Getting Started with Laravel 11',
                'content' => '<p>Laravel 11 brings exciting new features and improvements that make web development even more enjoyable. In this comprehensive guide, we\'ll explore the key changes and how to get started with your first Laravel 11 project.</p><p>From simplified application structure to enhanced performance, Laravel 11 represents a significant step forward in the framework\'s evolution. Whether you\'re a seasoned Laravel developer or just starting your journey, this post will help you understand what makes Laravel 11 special.</p>',
                'description' => 'Learn about the exciting new features in Laravel 11 and how to get started with this powerful PHP framework.',
            ],
            [
                'title' => 'Building Modern Vue.js Applications',
                'content' => '<p>Vue.js continues to be one of the most popular JavaScript frameworks for building user interfaces. With its gentle learning curve and powerful features, Vue.js makes it easy to create reactive and maintainable applications.</p><p>In this article, we\'ll explore best practices for structuring Vue.js applications, managing state with Pinia, and integrating with backend APIs. We\'ll also cover testing strategies and deployment considerations.</p>',
                'description' => 'Discover best practices for building scalable and maintainable Vue.js applications.',
            ],
            [
                'title' => 'The Future of Web Development',
                'content' => '<p>Web development is constantly evolving, with new technologies and methodologies emerging regularly. From serverless architecture to edge computing, the landscape is changing rapidly.</p><p>This article examines the trends shaping the future of web development, including the rise of JAMstack, the importance of web performance, and the growing emphasis on accessibility and inclusive design.</p>',
                'description' => 'Explore the emerging trends and technologies that are shaping the future of web development.',
            ],
            [
                'title' => 'Digital Marketing Strategies for 2024',
                'content' => '<p>Digital marketing continues to evolve as consumer behavior changes and new platforms emerge. Successful businesses must adapt their strategies to stay competitive in the digital landscape.</p><p>This comprehensive guide covers the essential digital marketing strategies for 2024, including social media marketing, content marketing, SEO best practices, and email marketing automation.</p>',
                'description' => 'Learn the essential digital marketing strategies that will drive growth in 2024.',
            ],
            [
                'title' => 'Building a Successful Startup',
                'content' => '<p>Starting a business is one of the most challenging yet rewarding endeavors you can undertake. From initial idea validation to scaling operations, every step requires careful planning and execution.</p><p>This article shares insights from successful entrepreneurs and provides a roadmap for building a startup that can thrive in today\'s competitive market. We\'ll cover everything from finding product-market fit to raising capital.</p>',
                'description' => 'Essential advice for entrepreneurs looking to build successful startups.',
            ],
            [
                'title' => 'Healthy Living in the Digital Age',
                'content' => '<p>As we spend more time in front of screens and lead increasingly sedentary lifestyles, maintaining our health becomes more challenging. However, technology can also be part of the solution.</p><p>This article explores strategies for maintaining physical and mental health in our digital world, including tips for ergonomic workspaces, digital detox practices, and using technology to support wellness goals.</p>',
                'description' => 'Tips and strategies for maintaining health and wellness in our digital world.',
            ],
            [
                'title' => 'The Power of Online Learning',
                'content' => '<p>Online learning has transformed education, making knowledge more accessible than ever before. From massive open online courses (MOOCs) to specialized certification programs, the opportunities for learning are endless.</p><p>This article examines the benefits of online learning, tips for success in virtual environments, and how to choose the right courses for your goals. We\'ll also explore the future of education technology.</p>',
                'description' => 'Discover how online learning is revolutionizing education and personal development.',
            ],
            [
                'title' => 'Cybersecurity Best Practices',
                'content' => '<p>In an increasingly connected world, cybersecurity has become a critical concern for individuals and businesses alike. Data breaches and cyber attacks are becoming more sophisticated and frequent.</p><p>This comprehensive guide covers essential cybersecurity practices, from password management to network security. Learn how to protect yourself and your organization from common threats.</p>',
                'description' => 'Essential cybersecurity practices to protect yourself and your data online.',
            ],
            [
                'title' => 'Sustainable Technology Solutions',
                'content' => '<p>As environmental concerns grow, the technology industry is focusing more on sustainability. From renewable energy in data centers to eco-friendly hardware design, green technology is becoming mainstream.</p><p>This article explores how technology companies are reducing their environmental impact and how consumers can make more sustainable technology choices. We\'ll also look at emerging green technologies.</p>',
                'description' => 'How the technology industry is addressing environmental challenges through sustainable solutions.',
            ],
            [
                'title' => 'Remote Work Best Practices',
                'content' => '<p>Remote work has become a permanent part of the modern workplace. While it offers many benefits, it also presents unique challenges that require new strategies and tools.</p><p>This article provides practical advice for thriving in a remote work environment, including tips for productivity, communication, and maintaining work-life balance. We\'ll also cover the best tools and technologies for remote collaboration.</p>',
                'description' => 'Essential tips and strategies for success in remote work environments.',
            ],
        ];

        $categories = Tag::where('type', 'category')->get();
        $tags = Tag::where('type', 'tag')->get();

        foreach ($posts as $index => $postData) {
            $post = Post::create([
                'user_id' => $user->id,
                'title' => ['en' => $postData['title']],
                'slug' => Str::slug($postData['title']),
                'description' => ['en' => $postData['description']],
                'content' => ['en' => $postData['content']],
                'post_type' => 'post',
                'status' => 'publish',
                'published_at' => Carbon::now()->subDays(rand(1, 30)),
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
            ]);

            // Attach random category and tags
            if ($categories->isNotEmpty()) {
                $post->tags()->attach($categories->random()->id);
            }
            
            if ($tags->isNotEmpty()) {
                $randomTags = $tags->random(rand(1, 3));
                $post->tags()->attach($randomTags->pluck('id')->toArray());
            }
        }

        $this->command->info('Created 10 posts');
    }

    private function createPages(User $user): void
    {
        $pages = [
            [
                'title' => 'About Us',
                'content' => '<p>Welcome to our company! We are a team of passionate professionals dedicated to providing exceptional services and solutions to our clients.</p><p>Founded in 2020, our company has grown from a small startup to a recognized leader in our industry. We believe in innovation, quality, and customer satisfaction.</p><p>Our mission is to help businesses succeed through technology and strategic partnerships. Contact us today to learn how we can help your business grow.</p>',
                'description' => 'Learn more about our company, our mission, and our commitment to excellence.',
            ],
            [
                'title' => 'Our Services',
                'content' => '<p>We offer a comprehensive range of services designed to meet the diverse needs of our clients. From web development to digital marketing, we have the expertise to help your business succeed.</p><h3>Web Development</h3><p>Custom websites and web applications built with modern technologies.</p><h3>Digital Marketing</h3><p>Strategic marketing campaigns that drive results and grow your business.</p><h3>Consulting</h3><p>Expert advice and guidance to help you make informed business decisions.</p>',
                'description' => 'Discover our comprehensive range of services designed to help your business succeed.',
            ],
            [
                'title' => 'Contact Us',
                'content' => '<p>We\'d love to hear from you! Get in touch with our team to discuss your project or ask any questions you might have.</p><h3>Get in Touch</h3><p>Email: info@example.com<br>Phone: (555) 123-4567<br>Address: 123 Business Street, City, State 12345</p><h3>Business Hours</h3><p>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 4:00 PM<br>Sunday: Closed</p>',
                'description' => 'Contact information and business hours for getting in touch with our team.',
            ],
            [
                'title' => 'Privacy Policy',
                'content' => '<p>This Privacy Policy describes how we collect, use, and protect your personal information when you use our website and services.</p><h3>Information We Collect</h3><p>We collect information you provide directly to us, such as when you create an account, make a purchase, or contact us for support.</p><h3>How We Use Your Information</h3><p>We use the information we collect to provide, maintain, and improve our services, process transactions, and communicate with you.</p><p>Last updated: January 1, 2024</p>',
                'description' => 'Our privacy policy outlines how we collect, use, and protect your personal information.',
            ],
            [
                'title' => 'Terms of Service',
                'content' => '<p>These Terms of Service govern your use of our website and services. By using our services, you agree to these terms.</p><h3>Acceptance of Terms</h3><p>By accessing and using our services, you accept and agree to be bound by these terms and conditions.</p><h3>Use of Services</h3><p>You may use our services only for lawful purposes and in accordance with these terms.</p><p>Last updated: January 1, 2024</p>',
                'description' => 'Terms and conditions governing the use of our website and services.',
            ],
            [
                'title' => 'FAQ',
                'content' => '<h3>Frequently Asked Questions</h3><h4>How do I get started?</h4><p>Getting started is easy! Simply contact us to discuss your needs and we\'ll guide you through the process.</p><h4>What are your pricing options?</h4><p>We offer flexible pricing options to fit different budgets and requirements. Contact us for a custom quote.</p><h4>Do you offer support?</h4><p>Yes, we provide ongoing support to all our clients to ensure their success.</p>',
                'description' => 'Answers to frequently asked questions about our services and processes.',
            ],
            [
                'title' => 'Our Team',
                'content' => '<p>Meet the talented individuals who make our company great. Our diverse team brings together expertise from various fields to deliver exceptional results.</p><h3>Leadership Team</h3><p>Our leadership team has decades of combined experience in technology, business, and customer service.</p><h3>Development Team</h3><p>Our developers are skilled in the latest technologies and best practices.</p><h3>Support Team</h3><p>Our support team is dedicated to ensuring our clients\' success.</p>',
                'description' => 'Meet our talented team of professionals dedicated to your success.',
            ],
            [
                'title' => 'Career Opportunities',
                'content' => '<p>Join our growing team! We\'re always looking for talented individuals who share our passion for excellence and innovation.</p><h3>Current Openings</h3><p>Check back regularly for new opportunities or send us your resume for future consideration.</p><h3>Benefits</h3><p>We offer competitive salaries, comprehensive benefits, and a great work environment.</p><h3>How to Apply</h3><p>Send your resume and cover letter to careers@example.com</p>',
                'description' => 'Explore career opportunities and join our talented team.',
            ],
            [
                'title' => 'Blog Guidelines',
                'content' => '<p>Welcome to our blog! Here are some guidelines for participating in our community.</p><h3>Comment Policy</h3><p>We encourage respectful discussion and constructive feedback on our blog posts.</p><h3>Content Guidelines</h3><p>All content should be relevant, helpful, and appropriate for our audience.</p><h3>Moderation</h3><p>Comments are moderated to ensure they meet our community standards.</p>',
                'description' => 'Guidelines for participating in our blog community.',
            ],
            [
                'title' => 'Partnerships',
                'content' => '<p>We believe in the power of strategic partnerships to create value for our clients and partners.</p><h3>Partnership Opportunities</h3><p>We\'re interested in partnering with companies that share our values and complement our services.</p><h3>Benefits of Partnership</h3><p>Our partners enjoy access to our expertise, resources, and client base.</p><h3>Contact Us</h3><p>Interested in exploring a partnership? Contact us to discuss opportunities.</p>',
                'description' => 'Learn about partnership opportunities and how we can work together.',
            ],
        ];

        foreach ($pages as $pageData) {
            Post::create([
                'user_id' => $user->id,
                'title' => ['en' => $pageData['title']],
                'slug' => Str::slug($pageData['title']),
                'description' => ['en' => $pageData['description']],
                'content' => ['en' => $pageData['content']],
                'post_type' => 'page',
                'status' => 'publish',
                'published_at' => Carbon::now()->subDays(rand(1, 10)),
                'created_at' => Carbon::now()->subDays(rand(1, 10)),
            ]);
        }

        $this->command->info('Created 10 pages');
    }

    private function createLibraries($testUsers): void
    {
        $libraries = [
            [
                'title' => 'Laravel Documentation Guide',
                'description' => 'Comprehensive guide to Laravel framework covering all aspects from basic installation to advanced features.',
                'type' => 'FILE',
            ],
            [
                'title' => 'Vue.js Component Library',
                'description' => 'Collection of reusable Vue.js components for building modern web applications.',
                'type' => 'FILE',
            ],
            [
                'title' => 'Web Development Tutorial Series',
                'description' => 'Complete video series covering modern web development techniques and best practices.',
                'type' => 'VIDEO',
            ],
            [
                'title' => 'PHP Best Practices Handbook',
                'description' => 'Essential guide for writing clean, maintainable PHP code following industry standards.',
                'type' => 'FILE',
            ],
            [
                'title' => 'JavaScript ES6+ Reference',
                'description' => 'Quick reference guide for modern JavaScript features and syntax.',
                'type' => 'FILE',
            ],
            [
                'title' => 'Database Design Patterns',
                'description' => 'Visual guide to common database design patterns and optimization techniques.',
                'type' => 'IMAGE',
            ],
            [
                'title' => 'API Development Masterclass',
                'description' => 'Video course on building robust and scalable APIs using modern frameworks.',
                'type' => 'VIDEO',
            ],
            [
                'title' => 'CSS Grid Layout Examples',
                'description' => 'Collection of CSS Grid layout examples and interactive demonstrations.',
                'type' => 'IMAGE',
            ],
            [
                'title' => 'Security Best Practices Guide',
                'description' => 'Comprehensive security guide for web developers covering common vulnerabilities and prevention.',
                'type' => 'FILE',
            ],
            [
                'title' => 'Performance Optimization Toolkit',
                'description' => 'Tools and techniques for optimizing web application performance and user experience.',
                'type' => 'FILE',
            ],
        ];

        $libraryTags = Tag::where('type', 'tag')->get();

        foreach ($libraries as $libraryData) {
            $library = Library::create([
                'slug' => Str::slug($libraryData['title']),
                'title' => ['en' => $libraryData['title']],
                'description' => ['en' => $libraryData['description']],
                'type' => $libraryData['type'],
                'file_path' => null, // Not setting actual file paths in this seeder
                'created_at' => Carbon::now()->subDays(rand(1, 60)),
            ]);

            //Attach random users
            $randomUsers = $testUsers->random(rand(1, 2));
            foreach ($randomUsers as $user) {
                $user->savedLibraryItems()->attach($library);
            }

            // Attach random tags to library items
            if ($libraryTags->isNotEmpty()) {
                $randomTags = $libraryTags->random(rand(1, 2));
                $library->tags()->attach($randomTags->pluck('id')->toArray());
            }
        }

        $this->command->info('Created 10 library items');
    }

    private function createEvents($testUsers): void
    {
        $eventTitles = [
            'Laravel Workshop: Building Modern Web Applications',
            'Vue.js Meetup: Component Best Practices',
            'Tech Talk: The Future of Web Development',
            'Startup Networking Event',
            'Digital Marketing Masterclass',
            'Health & Wellness in Tech',
            'Remote Work Strategies',
            'Cybersecurity Awareness Training',
            'Sustainable Technology Forum',
            'Career Development Workshop',
            'Innovation Summit 2024',
            'Code Review Best Practices',
            'Database Optimization Techniques',
            'API Design Workshop',
            'Mobile Development Conference',
            'DevOps Implementation Guide',
            'User Experience Design Session',
            'Agile Methodology Training',
            'Cloud Computing Fundamentals',
            'Open Source Collaboration',
            'Blockchain Technology Overview',
            'AI and Machine Learning Basics',
            'E-commerce Platform Development',
            'Social Media Strategy Session',
            'Project Management for Developers',
            'Quality Assurance Testing Methods',
            'Web Performance Optimization',
            'Data Analytics Workshop',
            'Content Management Systems',
            'Digital Transformation Strategies'
        ];

        $descriptions = [
            'Join us for an in-depth exploration of modern web development techniques and best practices.',
            'Learn from industry experts and network with fellow professionals in your field.',
            'Discover the latest trends and technologies shaping the future of our industry.',
            'An excellent opportunity to connect with like-minded professionals and expand your network.',
            'Hands-on workshop covering practical skills you can apply immediately in your work.',
            'Expert-led session designed to enhance your professional development and career growth.',
            'Interactive discussion on current challenges and innovative solutions in technology.',
            'Comprehensive training session covering essential concepts and real-world applications.',
            'Collaborative learning environment focused on sharing knowledge and best practices.',
            'Strategic insights and actionable advice for advancing your career and business goals.'
        ];

        $locations = [
            'Conference Center Downtown',
            'Tech Hub Innovation Space',
            'University Campus Auditorium',
            'Community Center Meeting Room',
            'Corporate Training Facility',
            'Online Virtual Event',
            'Library Community Room',
            'Business District Convention Center',
            'Startup Incubator Space',
            'Hotel Conference Suite'
        ];

        foreach ($testUsers as $user) {
            // Create 3 events for each user
            for ($i = 0; $i < 3; $i++) {
                Event::create([
                    'title' => $eventTitles[array_rand($eventTitles)],
                    'slug' => Str::slug($eventTitles[array_rand($eventTitles)] . '-' . rand(1000, 9999)),
                    'description' => $descriptions[array_rand($descriptions)],
                    'start_date' => Carbon::now()->addDays(rand(1, 90)),
                    'end_date' => Carbon::now()->addDays(rand(1, 90))->addHours(rand(2, 8)),
                    'address' => $locations[array_rand($locations)],
                    'link' => 'https://example.com/event-' . rand(1000, 9999),
                    'user_id' => $user->id,
                    'is_approved' => rand(0, 1),
                    'is_member_event' => rand(0, 1),
                    'created_at' => Carbon::now()->subDays(rand(1, 30)),
                ]);
            }
        }

        $this->command->info('Created ' . ($testUsers->count() * 3) . ' events for ' . $testUsers->count() . ' users');
    }

    private function attachLibrariesToUsers($testUsers): void
    {
        $libraries = Library::all();
        
        if ($libraries->isNotEmpty()) {
            foreach ($testUsers as $user) {
                // Attach 3 random library items to each user
                $randomLibraries = $libraries->random(min(3, $libraries->count()));
                $user->savedLibraryItems()->attach($randomLibraries->pluck('id')->toArray());
            }
        }

        $this->command->info('Attached library items to ' . $testUsers->count() . ' users');
    }

    private function createNavigation(): void
    {
        Navigation::create([
            'name' => 'Main Navigation',
            'handle' => 'main',
            'items' => [
                [
                    'label' => 'Home',
                    'type' => 'route',
                    'route' => 'home',
                ],
                [
                    'label' => 'Blog',
                    'type' => 'route', 
                    'route' => 'blogs',
                ],
                [
                    'label' => 'Events',
                    'type' => 'route',
                    'route' => 'public.events.index',
                ],
                [
                    'label' => 'Library',
                    'type' => 'route',
                    'route' => 'library', 
                ],
                [
                    'label' => 'FAQ',
                    'type' => 'route',
                    'route' => 'faq',
                ],
                [
                    'label' => 'Companies',
                    'type' => 'route',
                    'route' => 'public.businesses.index',
                ]
            ],
            'created_at' => Carbon::now(),
        ]);

        $this->command->info('Created main navigation menu');
    }

    private function createBusinessesForUsers($users)
    {
        $this->command->info('Creating businesses for users...');
        
        $libraries = Library::all();
        
        foreach ($users as $user) {
            // Create 1-3 businesses per user
            $businessCount = rand(1, 3);
            
            for ($i = 0; $i < $businessCount; $i++) {
                $companyName = fake()->company();
                $business = Business::create([
                    'name' => $companyName,
                    'slug' => Str::slug($companyName),
                    'description' => fake()->paragraph(3),
                    'email' => fake()->companyEmail(),
                    'telephone' => fake()->phoneNumber(),
                    'url' => fake()->url(),
                    'linkedin_url' => fake()->url(),
                    'priority' => rand(0, 10),
                    'user_id' => $user->id,
                    'is_approved' => rand(0, 1) === 1,
                    'is_public' => rand(0, 1) === 1,
                    'is_sponsor' => rand(0, 1) === 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
                $this->command->info("Created business: {$business->name} for user: {$user->name}");
            }
            
            // Make user like some libraries (2-5 random libraries)
            if ($libraries->count() > 0) {
                $librariesToLike = $libraries->random(min(rand(2, 5), $libraries->count()));
                $user->savedLibraryItems()->sync($librariesToLike->pluck('id')->toArray());
                $this->command->info("User {$user->name} liked {$librariesToLike->count()} libraries");
            }
        }
    }
}
