<?php
return [
    'ADMIN_PAGE_RECORDS' => 15,
    'FRONT_PAGE_RECORDS' => 50,
    'RATING_PAGE_RECORDS' => 10,
    'BRAND_NAME' => 'Test Project',

    'META_STATUSES' => [
        3 =>  'Completed',
        2 =>  'Partial',
        1 =>  'Pending',
        0 =>  'Totaly Pending'
    ],

    'FAQ_TYPES' => [
        'category' => 'Category',
        'blog' => 'Blog'
    ],

    'STATUSES' => [
        1 =>  'Active',
        0 =>  'In-active'
    ],

    'FEATURED_STATUSES' => [
        1 => 'Featured',
        0 => 'Not Featured',
    ],

    'DEFAULT_STATUSES' => [
        1 => 'Default',
        0 => 'Not Default',
    ],

    'ACTIONS' => [
        'create'        => 0,
        'update'        => 1,
        'delete'        => 2,
        'status_update' => 3,
        'full_access'   => 4,
    ],


    'MODULES' => [
        'activitylog'          => 'ActivityLog',
        'applicationstatus'    => 'ApplicationStatus',
        'authlog'              => 'AuthLog',
        'author'               => 'Author',
        'blog'                 => 'Blog',
        'blogcategory'         => 'BlogCategory',
        'blogtag'              => 'BlogTag',
        'career'               => 'Career',
        'careerapplication'    => 'CareerApplication',
        'casestudy'            => 'CaseStudy',
        'casestudycategory'    => 'CaseStudyCategory',
        'casestudytechnology'  => 'CaseStudyTechnology',
        'city'                 => 'City',
        'comment'              => 'Comment',
        'country'              => 'Country',
        'department'           => 'Department',
        'email'                => 'Email',
        'emaillog'             => 'EmailLog',
        'emailtemplate'        => 'EmailTemplate',
        'enquiry'              => 'Enquiry',
        'enquirystatuslog'     => 'EnquiryStatusLog',
        'faq'                  => 'Faq',
        'faqcategory'          => 'FaqCategory',
        'form'                 => 'Form',
        'formfield'            => 'FormField',
        'industry'             => 'Industry',
        'industrycategory'     => 'IndustryCategory',
        'media'                => 'Media',
        'mediarelation'        => 'MediaRelation',
        'newslettersubscriber' => 'NewsletterSubscriber',
        'notificationlog'      => 'NotificationLog',
        'page'                 => 'Page',
        'pagecontent'          => 'PageContent',
        'pagesection'          => 'PageSection',
        'partner'              => 'Partner',
        'permission'           => 'Permission',
        'platform'             => 'Platform',
        'portfolio'            => 'Portfolio',
        'portfoliocategory'    => 'PortfolioCategory',
        'portfolioimage'       => 'PortfolioImage',
        'portfolioskill'       => 'PortfolioSkill',
        'resume'               => 'Resume',
        'review'               => 'Review',
        'role'                 => 'Role',
        'rolepermission'       => 'RolePermission',
        'section'              => 'Section',
        'service'              => 'Service',
        'servicechallenge'     => 'ServiceChallenge',
        'servicefaq'           => 'ServiceFaq',
        'servicefeature'       => 'ServiceFeature',
        'serviceplatform'      => 'ServicePlatform',
        'servicetechnology'    => 'ServiceTechnology',
        'session'              => 'Session',
        'sitesetting'          => 'SiteSetting',
        'skill'                => 'Skill',
        'smtpsetting'          => 'SMTPSetting',
        'sociallink'           => 'SocialLink',
        'systemlog'            => 'SystemLog',
        'tag'                  => 'Tag',
        'technology'           => 'Technology',
        'technologycategory'   => 'TechnologyCategory',
        'template'             => 'Template',
        'templateform'         => 'TemplateForm',
        'testimonial'          => 'Testimonial',
        'user'                 => 'User',
        'userpermission'       => 'UserPermission',
    ],

    'ACTIVITY_ACTIONS' => [
        'create'       => 'CREATE',
        'update'       => 'UPDATE',
        'delete'       => 'DELETE',
        'activate'     => 'ACTIVATE',
        'deactivate'   => 'DEACTIVATE',
        'feature'      => 'FEATURE',
        'unfeature'    => 'UNFEATURE',
        'new'          => 'NEW',
        'shortlisted'  => 'SHORTLISTED',
        'interview'    => 'INTERVIEW',
        'offered'      => 'OFFERED',
        'hired'        => 'HIRED',
        'rejected'     => 'REJECTED',
        'login'        => 'LOGIN',
        'logout'       => 'LOGOUT',
        'view'         => 'VIEW',
        'download'     => 'DOWNLOAD',
        'upload'       => 'UPLOAD',
        'import'       => 'IMPORT',
        'export'       => 'EXPORT',
        'approve'      => 'APPROVE',
        'reject'       => 'REJECT',
        'assign'       => 'ASSIGN',
        'unassign'     => 'UNASSIGN',
        'restore'      => 'RESTORE',
        'archive'      => 'ARCHIVE',
        'duplicate'    => 'DUPLICATE',
    ],


    

    'TESTIMONIAL_RATINGS' => [
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 4,
        5 => 5,
    ],

    'STAR_RATINGS' => [
        1 => '★☆☆☆☆',
        2 => '★★☆☆☆',
        3 => '★★★☆☆',
        4 => '★★★★☆',
        5 => '★★★★★',
    ],

    'BUSINESS' => [
        'name' => 'Test Project',
        'gst' => '',
        'day' => 'Mon - Sat',
        'timings_weekdays' => '9:00 am to 8:00 pm',
        'timings_weekend' => 'Closed!',
    ],
    'CONTACT' => [
        'country_code' => '+91',
        'phones' => [
            [
                'label'  => 'Primary',
                'number' => '73010-05510',
            ],
            [
                'label'  => 'Support',
                'number' => '94314-05900',
            ],
        ],
        'whatsapp' => [
            'number' => '+917301005510',
            'link'   => 'https://wa.me/917301005510?text=Hi%20Deovate%20World,%20I%20would%20like%20to%20know%20more%20about%20your%20services.',
        ],
        'emails' => [
            [
                'label'   => 'General',
                'address' => 'info@deovateworld.com',
            ],
        ],
    ],

    // this array is for sending emails
    'EMAIL' => [
        'from' => 'abhiii2404@gmail.com',
        'contact' => 'sales@deovateworld.com',
        'send' => ['abhiii2404@gmail.com', 'ankysinghhumraj1@gmail.com'],
        // 'send' => 'support@thecanadafoods.com',
    ],

    'ADDRESS' => [
        'apartment'      => 'H-85',
        'street'         => 'Radha Swami Colony',
        'locality'       => 'Meharban',
        'city'           => 'Ludhiana',
        'state'          => 'Punjab',
        'postcode'       => '141007',
        'country'        => 'India',
        'map_link'       => 'https://maps.app.goo.gl/PAb8H28X9HrFQXkk9',
        'return_address' => 'Radha Swami Colony, Meharban, Ludhiana, Punjab 141007, India',
    ],
    'SOCIAL_LINKS' => [
        'facebook' => [
            'icon' => 'fab fa-facebook-f',
            'link' => 'https://facebook.com/deovateworld',
        ],
        'twitter' => [
            'icon' => 'fab fa-twitter',
            'link' => 'https://twitter.com/deovateworld',
        ],
        'linkedin' => [
            'icon' => 'fab fa-linkedin-in',
            'link' => 'https://linkedin.com/company/deovateworld',
        ],
        'instagram' => [
            'icon' => 'fab fa-instagram',
            'link' => 'https://instagram.com/deovateworld',
        ],
        'youtube' => [
            'icon' => 'fab fa-youtube',
            'link' => 'https://youtube.com/@deovateworld',
        ],
    ],

    'CONFIG' => [
        'currency_sign'      => '₹',
        'currency_iso_code'  => 'INR',
        'country'            => 'IN',
        'is_enquiry_website' => false,
        'reviews'            => true,
        'is_email_verify'    => false,
        'SEO' => [
            'title'          => 'Deovate World: Web Design, Website Development, SEO, Digital Marketing & Branding Agency',
            'description'    => 'Deovate World is a full-service digital agency specializing in web design, website development, SEO, digital marketing, branding, eCommerce solutions, custom software development, and mobile app development. We help businesses grow with innovative digital solutions.',
            'keywords'       => 'Deovate World, Web Design, Website Development, SEO Services, Digital Marketing Agency, Branding Agency, Laravel Development, eCommerce Website Development, Mobile App Development, Graphic Design, UI UX Design, Software Development, Website Maintenance, WordPress Development, Shopify Development, Social Media Marketing, Search Engine Optimization, PPC Advertising, Logo Design, Corporate Branding, Website Redesign, Web Application Development',
        ],
        'logo' => [
            'header' => 'assets/front/img/logo/header-logo.png',
            'big' => 'assets/front/img/logo/logo.png',
            'small' => 'assets/front/img/logo/loder-logo.png',
            'loader_logo' => 'assets/front/img/logo/loder-logo.png',
            'favicon' => 'assets/front/img/logo/favicon.ico',
        ],
        'dark_logo' => 'assets/front/img/logo/header-logo.png',
        'alt' => config('constants.BUSINESS.name', 'Deovate World'),
        'footer_info' => 'Deovate Technologies delivers secure, scalable, and high-performance digital solutions including web development, mobile applications, UI/UX design, and digital marketing for clients worldwide. ',

    ],

    // Fallback SEO copy for pages that have no database-driven content of their own.
    // Detail pages (blog, portfolio, industry, case study, career, service) pull their
    // title/description straight from the record instead of this list.
    'PAGE_SEO' => [
        'home' => [
            'title'          => 'Deovate World: Web Design, Website Development, SEO, Digital Marketing & Branding Agency',
            'meta_description' => 'Deovate World designs and builds websites, runs SEO campaigns, and manages digital marketing for growing businesses. See how our web design, development, and branding work helps clients get found online and win more customers.',
            'meta_keywords'  => 'web design agency, website development company, SEO services, digital marketing agency, branding agency, custom software development, mobile app development',
        ],
        'about' => [
            'title'          => 'About Deovate World | Our Story, Team & Approach',
            'meta_description' => 'Meet the team behind Deovate World and learn how we approach web design, development, and digital marketing projects for clients across industries.',
            'meta_keywords'  => 'about deovate world, web design team, digital agency team, our approach',
        ],
        'services' => [
            'title'          => 'Our Services | Web Design, Development, SEO & Digital Marketing',
            'meta_description' => 'Browse the full range of services we offer, from web design and custom development to SEO, digital marketing, and branding, all built around your business goals.',
            'meta_keywords'  => 'web design services, website development services, SEO services, digital marketing services, branding services',
        ],
        'portfolios' => [
            'title'          => 'Our Portfolio | Websites & Digital Projects We\'ve Built',
            'meta_description' => 'See real websites, apps, and digital campaigns we\'ve delivered for clients, and get a feel for the quality and craft behind every Deovate World project.',
            'meta_keywords'  => 'web design portfolio, website development projects, case studies, client work',
        ],
        'industries' => [
            'title'          => 'Industries We Serve | Web & Digital Solutions by Sector',
            'meta_description' => 'From healthcare to eCommerce, see how we tailor web design, development, and digital marketing to the needs of different industries.',
            'meta_keywords'  => 'industries we serve, ecommerce web design, healthcare website development, industry solutions',
        ],
        'casestudies' => [
            'title'          => 'Case Studies | Real Results From Our Client Projects',
            'meta_description' => 'Read how we\'ve helped businesses solve real problems with web design, development, and digital marketing, backed by measurable results.',
            'meta_keywords'  => 'case studies, client success stories, web development results, digital marketing results',
        ],
        'blog' => [
            'title'          => 'Blog | Web Design, Development & Digital Marketing Insights',
            'meta_description' => 'Practical articles on web design, website development, SEO, and digital marketing from the Deovate World team, written for business owners and marketers.',
            'meta_keywords'  => 'web design blog, digital marketing blog, SEO tips, website development articles',
        ],
        'career' => [
            'title'          => 'Careers at Deovate World | Join Our Team',
            'meta_description' => 'Explore open roles at Deovate World and find out what it\'s like to work with a team that builds websites, apps, and digital campaigns for real clients.',
            'meta_keywords'  => 'deovate world careers, web design jobs, developer jobs, digital marketing jobs',
        ],
        'contact' => [
            'title'          => 'Contact Us | Get in Touch With Deovate World',
            'meta_description' => 'Have a project in mind? Contact Deovate World for web design, development, SEO, or digital marketing support, and we\'ll get back to you quickly.',
            'meta_keywords'  => 'contact deovate world, get a quote, web design inquiry, digital marketing inquiry',
        ],
        'testimonials' => [
            'title'          => 'Client Testimonials | What Our Clients Say About Us',
            'meta_description' => 'Read honest feedback from clients who\'ve worked with Deovate World on web design, development, and digital marketing projects.',
            'meta_keywords'  => 'client testimonials, customer reviews, deovate world reviews',
        ],
        'techstack' => [
            'title'          => 'Our Tech Stack | Tools & Technologies We Work With',
            'meta_description' => 'A look at the frameworks, languages, and platforms our team uses to design, build, and maintain fast, reliable websites and applications.',
            'meta_keywords'  => 'tech stack, web development technologies, frameworks we use, tools we use',
        ],
        'alliances' => [
            'title'          => 'Our Alliances & Partners | Deovate World',
            'meta_description' => 'Meet the partners and technology alliances that help Deovate World deliver stronger web design, development, and digital marketing results.',
            'meta_keywords'  => 'deovate world partners, technology alliances, business partnerships',
        ],
        'pricing' => [
            'title'          => 'Pricing | Web Design & Digital Marketing Packages',
            'meta_description' => 'Compare our web design, development, and digital marketing packages and find the option that fits your budget and business goals.',
            'meta_keywords'  => 'web design pricing, website development cost, digital marketing packages',
        ],
        'faq' => [
            'title'          => 'Frequently Asked Questions | Deovate World',
            'meta_description' => 'Answers to the questions we hear most often about our web design, development, SEO, and digital marketing services.',
            'meta_keywords'  => 'deovate world faq, web design questions, digital marketing questions',
        ],
        'hireme' => [
            'title'          => 'Hire Our Team | Dedicated Developers & Designers',
            'meta_description' => 'Hire dedicated developers, designers, or a full project team from Deovate World for your next web or digital product build.',
            'meta_keywords'  => 'hire developers, hire designers, dedicated development team, hire our team',
        ],
        'legal_privacy' => [
            'title'          => 'Privacy Policy | Deovate World',
            'meta_description' => 'Read how Deovate World collects, uses, and protects your personal information when you use our website and services.',
            'meta_keywords'  => 'privacy policy, data protection, deovate world privacy',
        ],
        'legal_terms' => [
            'title'          => 'Terms & Conditions | Deovate World',
            'meta_description' => 'The terms and conditions that govern your use of the Deovate World website and services.',
            'meta_keywords'  => 'terms and conditions, terms of service, deovate world terms',
        ],
        'error_404' => [
            'title'          => 'Page Not Found | Deovate World',
            'meta_description' => 'The page you\'re looking for doesn\'t exist or may have moved. Head back to the Deovate World homepage to keep browsing.',
            'meta_keywords'  => 'page not found, 404 error, deovate world',
        ],
    ],

    'MONTHS' => [
        '01' => 'January',
        '02' => 'Feburary',
        '03' => 'March',
        '04' => 'April',
        '05' => 'May',
        '06' => 'June',
        '07' => 'July',
        '08' => 'August',
        '09' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December',
    ],

    'SITEMAP_PAGES' => [
        'home' => 'Home',
        'about' => 'About Us',
        'products' => 'Our Products',
        'blogs' => 'Blog',
        'faqs' => 'FAQs',
        'contact' => 'Contact Us',
        'shipping.policy' => 'Shipping Policy',
        'terms' => 'Terms & Conditions',
        'privacy' => 'Privacy Policy',
        'cookie.policy' => 'Cookie Policy',
        'refund.policy' => 'Refund Policy',
        'disclaimer' => 'Disclaimer',
        'cart' => 'Cart',
        'checkout' => 'Checkout',
        'wishlist' => 'Wishlist',
        'register' => 'Register',
        'login' => 'Login',
    ],

    'GROUPS' => [
        'user' => ['admin', 'customer', 'vendor'],
        'product' => ['digital', 'physical'],
    ],
    'GUARDS' => [
        'web' => 'Web',
        'admin' => 'Admin',
    ],

    // Matches the `phonecode` format stored on the countries table (no "+" prefix).
    'DEFAULT_COUNTRY_CODE' => '91',
    'PROVIDERS' => [
        'web' => 'users',
        'admin' => 'admins',
    ],

    'HEADERS' => [
        [
            'title' => 'Home',
            'route' => 'front.home.index',
        ],
        [
            'title' => 'About',
            'route' => 'front.about.index',
        ],
        // [
        //     'title' => 'Case Studies',
        //     'route' => 'front.casestudies.index',
        // ],
        [
            'title' => 'Services',
            'route' => 'front.services.index',
        ],
        // [
        //     'title' => 'Work',
        //     'route' => 'front.work.index',
        // ],
        // [
        //     'title' => 'Industries',
        //     'route' => 'front.industries.index',
        // ],
        [
            'title' => 'Blog',
            'route' => 'front.blog.index',
        ],
        [
            'title' => 'Career',
            'route' => 'front.career.index',
        ],
        [
            'title' => 'Contact',
            'route' => 'front.contact.index',
        ],
    ],


];
