<?php
return [
    'ADMIN_PAGE_RECORDS' => 20,
    'FRONT_PAGE_RECORDS' => 50,
    'RATING_PAGE_RECORDS' => 10,

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
        'name' => 'Deovate World',
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
            'big' => 'assets/front/img/logo/logo.png',
            'small' => 'assets/front/img/logo/loder-logo.png',
            'loader_logo' => 'assets/front/img/logo/loder-logo.png',
            'favicon' => 'assets/front/img/logo/favicon.ico',
        ],
        'alt' => config('constants.BUSINESS.name', 'Deovate World'),

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
            'title' => 'Contact',
            'route' => 'front.contact.index',
        ],
    ],


];
