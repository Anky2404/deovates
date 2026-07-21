@php
    use App\Helper;
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <ul class="menu-inner py-1">


        @if (Helper::canView('Super Admin'))
            {{-- ================= DASHBOARD ================= --}}
            <li class="menu-item {{ Helper::isActive('admin.dashboard.*') }}">
                <a href="{{ route('admin.dashboard.index') }}" class="menu-link">
                    <i class="menu-icon bx bx-home"></i>
                    <div>Dashboard</div>
                </a>
            </li>
            {{-- ================= Authentication Menu ================= --}}
            @php
                $authenticationMenuOpen = Helper::isActive(['admin.auth.logs.*', 'admin.sessions.*']);
            @endphp

            <li class="menu-item {{ $authenticationMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-lock-alt"></i>
                    <div>Authentication</div>
                </a>

                <ul class="menu-sub">

                    {{-- Login / Auth Logs --}}
                    <li class="menu-item {{ Helper::isActive(['admin.auth.logs.*']) }}">
                        <a href="{{ route('admin.auth.logs.index') }}" class="menu-link">
                            <div>Login / Auth Logs</div>
                        </a>
                    </li>

                    {{-- Sessions --}}
                    <li class="menu-item {{ Helper::isActive(['admin.sessions.*']) }}">
                        <a href="{{ route('admin.sessions.index') }}" class="menu-link">
                            <div>Sessions</div>
                        </a>
                    </li>

                </ul>
            </li>



            {{-- ================= Users Menu ================= --}}
            <li class="menu-item {{ Helper::isActive(['admin.users.*']) ? 'open active' : '' }}">
                <a href="{{ route('admin.users.index') }}" class="menu-link">
                    <i class="menu-icon bx bx-user"></i>
                    <div>Users</div>
                </a>
            </li>


            <li class="menu-item {{ Helper::isActive(['admin.services.index']) }}">
                <a href="{{ route('admin.services.index') }}" class="menu-link">
                    <i class="menu-icon bx bx-layer"></i>

                    <div>Services</div>
                </a>
            </li>

            {{-- ================= Roles & Permissions Menu ================= --}}
            @php
                $rolesPermissionsMenuOpen = Helper::isActive([
                    'admin.roles.*',
                    'admin.permissions.*',
                    'admin.roles.permissions.*',
                    'admin.users.permissions.*',
                ]);
            @endphp

            <li class="menu-item {{ $rolesPermissionsMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-shield-quarter"></i>
                    <div>Roles & Permissions</div>
                </a>

                <ul class="menu-sub">

                    {{-- Roles --}}
                    <li class="menu-item {{ Helper::isActive(['admin.roles.*']) }}">
                        <a href="{{ route('admin.roles.index') }}" class="menu-link">
                            <div>Roles</div>
                        </a>
                    </li>

                    {{-- Permissions --}}
                    <li class="menu-item {{ Helper::isActive(['admin.permissions.*']) }}">
                        <a href="{{ route('admin.permissions.index') }}" class="menu-link">
                            <div>Permissions</div>
                        </a>
                    </li>

                    {{-- Role Permissions --}}
                    <li class="menu-item {{ Helper::isActive(['admin.roles.permissions.*']) }}">
                        <a href="{{ route('admin.roles.permissions.index') }}" class="menu-link">
                            <div>Role Permissions</div>
                        </a>
                    </li>

                    {{-- User Permissions --}}
                    <li class="menu-item {{ Helper::isActive(['admin.user-permissions.*']) }}">
                        <a href="{{ route('admin.user-permissions.index') }}" class="menu-link">
                            <div>User Permissions</div>
                        </a>
                    </li>

                </ul>
            </li>


            {{-- ================= Blogs Menu ================= --}}
            @php
                $blogMenuOpen = Helper::isActive([
                    'admin.blogs.*',
                    'admin.blogs.categories.*',
                    'admin.authors.*',
                    'admin.tags.*',
                    'admin.blogs.comments.*',
                ]);
            @endphp

            <li class="menu-item {{ $blogMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-news"></i>
                    <div>Blogs</div>
                </a>

                <ul class="menu-sub">

                    {{-- All Blogs --}}
                    <li class="menu-item {{ Helper::isActive(['admin.blogs.index']) }}">
                        <a href="{{ route('admin.blogs.index') }}" class="menu-link">
                            <div>All Blogs</div>
                        </a>
                    </li>

                    {{-- Blog Categories --}}
                    <li class="menu-item {{ Helper::isActive(['admin.blogs.categories.*']) }}">
                        <a href="{{ route('admin.blogs.categories.index') }}" class="menu-link">
                            <div>Categories</div>
                        </a>
                    </li>

                    {{-- Blog Authors --}}
                    <li class="menu-item {{ Helper::isActive(['admin.authors.*']) }}">
                        <a href="{{ route('admin.authors.index') }}" class="menu-link">
                            <div>Authors</div>
                        </a>
                    </li>

                     {{-- Blog Comments --}}
                    <li class="menu-item {{ Helper::isActive(['admin.blogs.comments.*']) }}">
                        <a href="{{ route('admin.blogs.comments.index') }}" class="menu-link">
                            <div>Comments</div>
                        </a>
                    </li>

                   
                    {{-- Blog Tags --}}
                    <li class="menu-item {{ Helper::isActive(['admin.tags.*']) }}">
                        <a href="{{ route('admin.tags.index') }}" class="menu-link">
                            <div>Tags</div>
                        </a>
                    </li>

                </ul>
            </li>


            @php
                $blogMenuOpen = Helper::isActive(['admin.faqs.*', 'admin.faqs.categories.*']);
            @endphp

            <li class="menu-item {{ $blogMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-news"></i>
                    <div>Faqs</div>
                </a>

                <ul class="menu-sub">

                    {{-- All Faqs --}}
                    <li class="menu-item {{ Helper::isActive(['admin.faqs.index']) }}">
                        <a href="{{ route('admin.faqs.index') }}" class="menu-link">
                            <div>All Faqs</div>
                        </a>
                    </li>

                    {{-- Faq Categories --}}
                    <li class="menu-item {{ Helper::isActive(['admin.faqs.categories.*']) }}">
                        <a href="{{ route('admin.faqs.categories.index') }}" class="menu-link">
                            <div>Faq Categories</div>
                        </a>
                    </li>



                </ul>
            </li>

            {{-- ================= Career & HR Management Menu ================= --}}
            @php
                $careerMenuOpen = Helper::isActive([
                    'admin.careers.*',
                    'admin.careers.applications.*',
                    'admin.careers.application-status.*',
                    'admin.careers.resumes.*',
                ]);
            @endphp

            <li class="menu-item {{ $careerMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-briefcase"></i>
                    <div>Careers & HR</div>
                </a>

                <ul class="menu-sub">

                    {{-- Job Openings --}}
                    <li
                        class="menu-item {{ Helper::isActive(['admin.careers.index', 'admin.careers.createoredit']) }}">
                        <a href="{{ route('admin.careers.index') }}" class="menu-link">
                            <div>Job Openings</div>
                        </a>
                    </li>

                    {{-- Career Applications --}}
                    <li class="menu-item {{ Helper::isActive(['admin.careers.applications.*']) }}">
                        <a href="{{ route('admin.careers.applications.index') }}" class="menu-link">
                            <div>Applications</div>
                        </a>
                    </li>

                    {{-- Application Status Logs --}}
                    {{-- <li class="menu-item {{ Helper::isActive(['admin.careers.application-status.*']) }}">
                        <a href="{{ route('admin.careers.application-status.index') }}" class="menu-link">
                            <div>Application Status</div>
                        </a>
                    </li> --}}

                    {{-- Resumes --}}
                    {{-- <li class="menu-item {{ Helper::isActive(['admin.careers.resumes.*']) }}">
                        <a href="{{ route('admin.careers.resumes.index') }}" class="menu-link">
                            <div>Resumes</div>
                        </a>
                    </li> --}}

                </ul>
            </li>


            {{-- ================= Case Studies Menu ================= --}}
            @php
                $caseStudyMenuOpen = Helper::isActive(['admin.casestudies.*', 'admin.casestudies.categories.*']);
            @endphp

            <li class="menu-item {{ $caseStudyMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-book-open"></i>
                    <div>Case Studies</div>
                </a>

                <ul class="menu-sub">


                    {{-- All Case Studies --}}
                    <li
                        class="menu-item {{ Helper::isActive(['admin.casestudies.index', 'admin.casestudies.createoredit']) }}">
                        <a href="{{ route('admin.casestudies.index') }}" class="menu-link">
                            <div>All Case Studies</div>
                        </a>
                    </li>

                    {{-- Case Study Categories --}}
                    <li class="menu-item {{ Helper::isActive(['admin.casestudies.categories.*']) }}">
                        <a href="{{ route('admin.casestudies.categories.index') }}" class="menu-link">
                            <div>Categories</div>
                        </a>
                    </li>

                </ul>
            </li>

            {{-- ================= Communication Menu ================= --}}
            @php
                $communicationMenuOpen = Helper::isActive(['admin.enquiries.*', 'admin.newsletter.subscribers.*']);
            @endphp

            <li class="menu-item {{ $communicationMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-message-rounded-dots"></i>
                    <div>Communication</div>
                </a>

                <ul class="menu-sub">

                    {{-- Enquiries --}}
                    <li class="menu-item {{ Helper::isActive(['admin.enquiries.*']) }}">
                        <a href="{{ route('admin.enquiries.index') }}" class="menu-link">
                            <div>Enquiries</div>
                        </a>
                    </li>

                    {{-- Newsletter Subscribers --}}
                    <li class="menu-item {{ Helper::isActive(['admin.newsletter-subscribers.*']) }}">
                        <a href="{{ route('admin.newsletter-subscribers.index') }}" class="menu-link">
                            <div>Newsletter</div>
                        </a>
                    </li>

                </ul>
            </li>

            {{-- ================= Departments Menu ================= --}}
            <li class="menu-item {{ Helper::isActive('admin.departments.*') }}">
                <a href="{{ route('admin.departments.index') }}" class="menu-link">
                    <i class="menu-icon bx bx-home"></i>
                    <div>Departments</div>
                </a>
            </li>



            {{-- ================= Emails Menu ================= --}}
            @php
                $emailsMenuOpen = Helper::isActive([
                    'admin.emails.templates.*',
                    'admin.emails.*',
                    'admin.emails.logs.*',
                ]);
            @endphp

            <li class="menu-item {{ $emailsMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-envelope"></i>
                    <div>Emails</div>
                </a>

                <ul class="menu-sub">

                    {{-- Send Emails --}}
                    <li class="menu-item {{ Helper::isActive(['admin.emails.*']) }}">
                        <a href="{{ route('admin.emails.index') }}" class="menu-link">
                            <div>Emails</div>
                        </a>
                    </li>

                    {{-- Email Templates --}}
                    <li class="menu-item {{ Helper::isActive(['admin.emails.templates.*']) }}">
                        <a href="{{ route('admin.emails.templates.index') }}" class="menu-link">
                            <div>Templates</div>
                        </a>
                    </li>



                    {{-- Email Logs --}}
                    <li class="menu-item {{ Helper::isActive(['admin.emails.logs.*']) }}">
                        <a href="{{ route('admin.emails.logs.index') }}" class="menu-link">
                            <div>Logs</div>
                        </a>
                    </li>



                </ul>
            </li>


            {{-- ================= Pages Management Menu ================= --}}
            @php
                $pagesMenuOpen = Helper::isActive([
                    'admin.pages.*',
                    'admin.pages.forms.*',
                    'admin.sections.*',
                    // 'admin.templates.*',
                ]);
            @endphp

            <li class="menu-item {{ $pagesMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-file"></i>
                    <div>Pages</div>
                </a>

                <ul class="menu-sub">

                    <li class="menu-item {{ Helper::isActive(['admin.pages.index', 'admin.pages.createoredit']) }}">
                        <a href="{{ route('admin.pages.index') }}" class="menu-link">
                            <div>All Pages</div>
                        </a>
                    </li>

                    <li
                        class="menu-item {{ Helper::isActive(['admin.pages.forms.index', 'admin.forms.createoredit']) }}">
                        <a href="{{ route('admin.pages.forms.index') }}" class="menu-link">
                            <div>Forms</div>
                        </a>
                    </li>

                    <li class="menu-item {{ Helper::isActive(['admin.sections.*']) }}">
                        <a href="{{ route('admin.sections.index') }}" class="menu-link">
                            <div>Sections</div>
                        </a>
                    </li>

                    {{-- <li class="menu-item {{ Helper::isActive(['admin.templates.*']) }}">
                        <a href="{{ route('admin.templates.index') }}" class="menu-link">
                            <div>Templates</div>
                        </a>
                    </li> --}}

                </ul>
            </li>


            {{-- ================= Media Management Menu ================= --}}
            @php
                $mediaMenuOpen = Helper::isActive(['admin.media.library.*', 'admin.media.relations.*']);
            @endphp

            {{-- <li class="menu-item {{ $mediaMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-photo-album"></i>
                    <div>Media</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item {{ Helper::isActive(['admin.media.library.*']) }}">
                        <a href="{{ route('admin.media.library.index') }}" class="menu-link">
                            <div>Library</div>
                        </a>
                    </li>


                    <li class="menu-item {{ Helper::isActive(['admin.media.relations.*']) }}">
                        <a href="{{ route('admin.media.relations.index') }}" class="menu-link">
                            <div>Relations</div>
                        </a>
                    </li>

                </ul>
            </li> --}}


            {{-- ================= Marketing Management Menu ================= --}}
            @php
                $marketingMenuOpen = Helper::isActive([
                    'admin.marketing.industries.*',
                    'admin.marketing.industries.categories.*',
                    'admin.marketing.partners.*',
                ]);
            @endphp

            <li class="menu-item {{ $marketingMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-trending-up"></i>
                    <div>Marketing</div>
                </a>

                <ul class="menu-sub">

                    {{-- Industries --}}
                    <li class="menu-item {{ Helper::isActive(['admin.marketing.industries.*']) }}">
                        <a href="javascript:void(0)" class="menu-link  menu-toggle">
                            <div>Industries</div>
                        </a>

                        <ul class="menu-sub">
                            {{-- Partners --}}
                            <li class="menu-item {{ Helper::isActive(['admin.marketing.industries.categories.*']) }}">
                                <a href="{{ route('admin.marketing.industries.categories.index') }}" class="menu-link">
                                    <div>Categories</div>
                                </a>
                            </li>
                            {{-- Partners --}}
                            <li class="menu-item {{ Helper::isActive(['admin.marketing.industries.*']) }}">
                                <a href="{{ route('admin.marketing.industries.index') }}" class="menu-link">
                                    <div>Industries</div>
                                </a>
                            </li>
                        </ul>




                    </li>

                    {{-- Partners --}}
                    <li class="menu-item {{ Helper::isActive(['admin.marketing.partners.*']) }}">
                        <a href="{{ route('admin.marketing.partners.index') }}" class="menu-link">
                            <div>Partners</div>
                        </a>
                    </li>

                </ul>
            </li>



            {{-- ================= Portfolios Menu ================= --}}
            @php
                $portfolioMenuOpen = Helper::isActive(['admin.portfolios.*', 'admin.portfolios.categories.*']);
            @endphp

            <li class="menu-item {{ $portfolioMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-briefcase-alt-2"></i>
                    <div>Portfolios</div>
                </a>

                <ul class="menu-sub">

                    {{-- All Portfolios --}}
                    <li
                        class="menu-item {{ Helper::isActive(['admin.portfolios.index', 'admin.portfolios.createoredit']) }}">
                        <a href="{{ route('admin.portfolios.index') }}" class="menu-link">
                            <div>All Portfolios</div>
                        </a>
                    </li>

                    {{-- Portfolio Categories --}}
                    <li class="menu-item {{ Helper::isActive(['admin.portfolios.categories.*']) }}">
                        <a href="{{ route('admin.portfolios.categories.index') }}" class="menu-link">
                            <div>Categories</div>
                        </a>
                    </li>

                </ul>
            </li>

            {{-- ================= System Settings Menu ================= --}}
            @php
                $systemSettingsMenuOpen = Helper::isActive([
                    'admin.settings.sites.*',
                    'admin.settings.smtp.*',
                    'admin.settings.cache.*',
                    'admin.settings.cache.locks.*',
                    'admin.settings.jobs.*',
                    'admin.settings.jobs.batches.*',
                    'admin.settings.jobs.failed.*',
                    'admin.settings.migrations.*',
                ]);
            @endphp

            {{-- <li class="menu-item {{ $systemSettingsMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-cog"></i>
                    <div>System Settings</div>
                </a>

                <ul class="menu-sub">


                    <li class="menu-item {{ Helper::isActive(['admin.settings.sites.*']) }}">
                        <a href="{{ route('admin.settings.sites.index') }}" class="menu-link">
                            <div>Site Settings</div>
                        </a>
                    </li>


                    <li class="menu-item {{ Helper::isActive(['admin.settings.smtp.*']) }}">
                        <a href="{{ route('admin.settings.smtp.index') }}" class="menu-link">
                            <div>SMTP Settings</div>
                        </a>
                    </li>


                    <li class="menu-item {{ Helper::isActive(['admin.settings.cache.*']) }}">
                        <a href="{{ route('admin.settings.cache.index') }}" class="menu-link">
                            <div>Cache</div>
                        </a>
                    </li>


                    <li class="menu-item {{ Helper::isActive(['admin.settings.cache.locks.*']) }}">
                        <a href="{{ route('admin.settings.cache.locks.index') }}" class="menu-link">
                            <div>Cache Locks</div>
                        </a>
                    </li>


                    <li class="menu-item {{ Helper::isActive(['admin.settings.jobs.*']) }}">
                        <a href="{{ route('admin.settings.jobs.index') }}" class="menu-link">
                            <div>Jobs</div>
                        </a>
                    </li>


                    <li class="menu-item {{ Helper::isActive(['admin.settings.jobs.batches.*']) }}">
                        <a href="{{ route('admin.settings.jobs.batches.index') }}" class="menu-link">
                            <div>Job Batches</div>
                        </a>
                    </li>


                    <li class="menu-item {{ Helper::isActive(['admin.settings.jobs.failed.*']) }}">
                        <a href="{{ route('admin.settings.jobs.failed.index') }}" class="menu-link">
                            <div>Failed Jobs</div>
                        </a>
                    </li>


                    <li class="menu-item {{ Helper::isActive(['admin.settings.migrations.*']) }}">
                        <a href="{{ route('admin.settings.migrations.index') }}" class="menu-link">
                            <div>Migrations</div>
                        </a>
                    </li>

                </ul>
            </li> --}}




            {{-- ================= Technology Menu ================= --}}
            @php
                $technologyMenuOpen = Helper::isActive([
                    'admin.technologies.*',
                    'admin.technologies.categories.*',
                    'admin.skills.*',
                ]);
            @endphp

            <li class="menu-item {{ $technologyMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-chip"></i>
                    <div>Technologies</div>
                </a>

                <ul class="menu-sub">

                    {{-- All Technologies --}}
                    <li
                        class="menu-item {{ Helper::isActive(['admin.technologies.index', 'admin.technologies.createoredit']) }}">
                        <a href="{{ route('admin.technologies.index') }}" class="menu-link">
                            <div>All Technologies</div>
                        </a>
                    </li>

                    {{-- Technology Categories --}}
                    <li class="menu-item {{ Helper::isActive(['admin.technologies.categories.*']) }}">
                        <a href="{{ route('admin.technologies.categories.index') }}" class="menu-link">
                            <div>Categories</div>
                        </a>
                    </li>

                    {{-- Skills --}}
                    <li class="menu-item {{ Helper::isActive(['admin.skills.*']) }}">
                        <a href="{{ route('admin.skills.index') }}" class="menu-link">
                            <div>Skills</div>
                        </a>
                    </li>

                </ul>
            </li>


            {{-- ================= Testimonials Menu ================= --}}
            <li
                class="menu-item {{ Helper::isActive(['admin.testimonials.index', 'admin.testimonials.createoredit']) }}">
                <a href="{{ route('admin.testimonials.index') }}" class="menu-link">
                    <i class='menu-icon bx bxs-comment-detail'></i>
                    <div>Testimonials</div>
                </a>
            </li>

            {{-- ================= Google Reviews Menu ================= --}}
            <li class="menu-item {{ Helper::isActive(['admin.google-reviews.index']) }}">
                <a href="{{ route('admin.google-reviews.index') }}" class="menu-link">
                    <i class='menu-icon bx bxl-google'></i>
                    <div>Google Reviews</div>
                </a>
            </li>
            {{-- ================= CASE STUDIES ================= --}}
            @php
                $casestudyMenuOpen = Helper::isActive(['admin.casestudies.*', 'admin.casestudies.categories.*']);
            @endphp

            <li class="menu-item {{ $casestudyMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-book"></i>
                    <div>Case Studies</div>
                </a>
                <ul class="menu-sub">
                    <li><a href="{{ route('admin.casestudies.index') }}" class="menu-link">
                            <div>Case Studies</div>
                        </a></li>
                    <li><a href="{{ route('admin.casestudies.categories.index') }}" class="menu-link">
                            <div>Categories</div>
                        </a></li>
                </ul>
            </li>

            {{-- ================= Notifications & Logs Menu ================= --}}
            @php
                $notificationsLogsMenuOpen = Helper::isActive([
                    'admin.notifications.*',
                    'admin.activity-logs.*',
                    'admin.system-logs.*',
                    'admin.api-logs.*',
                    'admin.debug-logs.*',
                    'admin.error-reports.*',
                ]);
            @endphp

            <li class="menu-item {{ $notificationsLogsMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-bell"></i>
                    <div>Notifications & Logs</div>
                </a>

                <ul class="menu-sub">

                    {{-- Notifications --}}
                    <li class="menu-item {{ Helper::isActive(['admin.notifications.*']) }}">
                        <a href="{{ route('admin.notifications.index') }}" class="menu-link">
                            <div>Notifications</div>
                        </a>
                    </li>

                    {{-- Activity Logs --}}
                    <li class="menu-item {{ Helper::isActive(['admin.activity-logs.*']) }}">
                        <a href="{{ route('admin.activity-logs.index') }}" class="menu-link">
                            <div>Activity Logs</div>
                        </a>
                    </li>

                    {{-- System Logs --}}
                    <li class="menu-item {{ Helper::isActive(['admin.system-logs.*']) }}">
                        <a href="{{ route('admin.system-logs.index') }}" class="menu-link">
                            <div>System Logs</div>
                        </a>
                    </li>

                    {{-- API Logs --}}
                    <li class="menu-item {{ Helper::isActive(['admin.api-logs.*']) }}">
                        <a href="{{ route('admin.api-logs.index') }}" class="menu-link">
                            <div>API Logs</div>
                        </a>
                    </li>

                    {{-- Debug Logs --}}
                    <li class="menu-item {{ Helper::isActive(['admin.debug-logs.*']) }}">
                        <a href="{{ route('admin.debug-logs.index') }}" class="menu-link">
                            <div>Debug Logs</div>
                        </a>
                    </li>

                    {{-- Error Reports --}}
                    <li class="menu-item {{ Helper::isActive(['admin.error-reports.*']) }}">
                        <a href="{{ route('admin.error-reports.index') }}" class="menu-link">
                            <div>Error Reports</div>
                        </a>
                    </li>

                </ul>
            </li>







            {{-- ================= CRM Routes ================= --}}
        @elseif (Helper::canView('Admin'))
            {{-- ================= DASHBOARD ================= --}}
            <li class="menu-item {{ Helper::isActive('crm.dashboard.*') }}">
                <a href="{{ route('crm.dashboard.index') }}" class="menu-link">
                    <i class="menu-icon bx bx-home"></i>
                    <div>Dashboard</div>
                </a>
            </li>

            {{-- ================= DEALS================= --}}
            <li class="menu-item {{ Helper::isActive('crm.deals.*') }}">
                <a href="{{ route('crm.deals.index') }}" class="menu-link">
                    <i class="menu-icon bx bx-briefcase"></i>
                    <div>Deals</div>
                </a>
            </li>

            {{-- ================= CRM – Clients Menu ================= --}}
            @php
                $crmClientsMenuOpen = Helper::isActive([
                    'crm.clients.*',
                    'crm.clients.contacts.*',
                    'crm.clients.notes.*',
                    'crm.clients.documents.*',
                ]);
            @endphp

            <li class="menu-item {{ $crmClientsMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-group"></i>
                    <div>CRM – Clients</div>
                </a>

                <ul class="menu-sub">

                    {{-- Clients --}}
                    <li class="menu-item {{ Helper::isActive(['crm.clients.index']) }}">
                        <a href="{{ route('crm.clients.index') }}" class="menu-link">
                            <div>Clients</div>
                        </a>
                    </li>

                    {{-- Client Contacts --}}
                    <li class="menu-item {{ Helper::isActive(['crm.clients.contacts.*']) }}">
                        <a href="{{ route('crm.clients.contacts.index') }}" class="menu-link">
                            <div>Client Contacts</div>
                        </a>
                    </li>

                    {{-- Client Notes --}}
                    <li class="menu-item {{ Helper::isActive(['crm.clients.notes.*']) }}">
                        <a href="{{ route('crm.clients.notes.index') }}" class="menu-link">
                            <div>Client Notes</div>
                        </a>
                    </li>

                    {{-- Client Documents --}}
                    <li class="menu-item {{ Helper::isActive(['crm.clients.documents.*']) }}">
                        <a href="{{ route('crm.clients.documents.index') }}" class="menu-link">
                            <div>Client Documents</div>
                        </a>
                    </li>

                </ul>
            </li>



            {{-- ================= CRM – Leads Menu ================= --}}
            @php
                $crmLeadsMenuOpen = Helper::isActive([
                    'crm.leads.*',
                    'crm.leads.statuses.*',
                    'crm.leads.sources.*',
                    'crm.leads.activities.*',
                ]);
            @endphp

            <li class="menu-item {{ $crmLeadsMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-target-lock"></i>
                    <div>CRM – Leads</div>
                </a>

                <ul class="menu-sub">

                    {{-- Leads --}}
                    <li class="menu-item {{ Helper::isActive(['crm.leads.index']) }}">
                        <a href="{{ route('crm.leads.index') }}" class="menu-link">
                            <div>Leads</div>
                        </a>
                    </li>

                    {{-- Lead Statuses --}}
                    <li class="menu-item {{ Helper::isActive(['crm.leads.statuses.*']) }}">
                        <a href="{{ route('crm.leads.statuses.index') }}" class="menu-link">
                            <div>Lead Statuses</div>
                        </a>
                    </li>

                    {{-- Lead Sources --}}
                    <li class="menu-item {{ Helper::isActive(['crm.leads.sources.*']) }}">
                        <a href="{{ route('crm.leads.sources.index') }}" class="menu-link">
                            <div>Lead Sources</div>
                        </a>
                    </li>

                    {{-- Lead Activities --}}
                    <li class="menu-item {{ Helper::isActive(['crm.leads.activities.*']) }}">
                        <a href="{{ route('crm.leads.activities.index') }}" class="menu-link">
                            <div>Lead Activities</div>
                        </a>
                    </li>

                </ul>
            </li>

            {{-- ================= Projects Menu ================= --}}
            @php
                $projectsMenuOpen = Helper::isActive([
                    'crm.projects.*',
                    'crm.projects.members.*',
                    'crm.projects.milestones.*',
                ]);
            @endphp

            <li class="menu-item {{ $projectsMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-folder"></i>
                    <div>Projects</div>
                </a>

                <ul class="menu-sub">

                    {{-- Projects --}}
                    <li class="menu-item {{ Helper::isActive(['crm.projects.index']) }}">
                        <a href="{{ route('crm.projects.index') }}" class="menu-link">
                            <div>Projects</div>
                        </a>
                    </li>

                    {{-- Project Members --}}
                    <li class="menu-item {{ Helper::isActive(['crm.projects.members.*']) }}">
                        <a href="{{ route('crm.projects.members.index') }}" class="menu-link">
                            <div>Project Members</div>
                        </a>
                    </li>

                    {{-- Project Milestones --}}
                    <li class="menu-item {{ Helper::isActive(['crm.projects.milestones.*']) }}">
                        <a href="{{ route('crm.projects.milestones.index') }}" class="menu-link">
                            <div>Project Milestones</div>
                        </a>
                    </li>

                </ul>
            </li>

            {{-- ================= Tasks Menu ================= --}}
            @php
                $tasksMenuOpen = Helper::isActive(['crm.tasks.*', 'crm.tasks.comments.*']);
            @endphp

            <li class="menu-item {{ $tasksMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-task"></i>
                    <div>Tasks</div>
                </a>

                <ul class="menu-sub">

                    {{-- Tasks --}}
                    <li class="menu-item {{ Helper::isActive(['crm.tasks.index']) }}">
                        <a href="{{ route('crm.tasks.index') }}" class="menu-link">
                            <div>Tasks</div>
                        </a>
                    </li>

                    {{-- Task Comments --}}
                    <li class="menu-item {{ Helper::isActive(['crm.tasks.comments.*']) }}">
                        <a href="{{ route('crm.tasks.comments.index') }}" class="menu-link">
                            <div>Task Comments</div>
                        </a>
                    </li>

                </ul>
            </li>

            {{-- ================= Invoices Menu ================= --}}
            @php
                $invoicesMenuOpen = Helper::isActive(['crm.invoices.*', 'crm.invoices.items.*']);
            @endphp

            <li class="menu-item {{ $invoicesMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-receipt"></i>
                    <div>Invoices</div>
                </a>

                <ul class="menu-sub">

                    {{-- Invoices --}}
                    <li class="menu-item {{ Helper::isActive(['crm.invoices.index']) }}">
                        <a href="{{ route('crm.invoices.index') }}" class="menu-link">
                            <div>Invoices</div>
                        </a>
                    </li>

                    {{-- Invoice Items --}}
                    <li class="menu-item {{ Helper::isActive(['crm.invoices.items.*']) }}">
                        <a href="{{ route('crm.invoices.items.index') }}" class="menu-link">
                            <div>Invoice Items</div>
                        </a>
                    </li>

                </ul>
            </li>

            {{-- ================= Payments Menu ================= --}}
            @php
                $paymentsMenuOpen = Helper::isActive(['crm.payments.*', 'crm.payments.methods.*']);
            @endphp

            <li class="menu-item {{ $paymentsMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-credit-card"></i>
                    <div>Payments</div>
                </a>

                <ul class="menu-sub">

                    {{-- Payments --}}
                    <li class="menu-item {{ Helper::isActive(['crm.payments.index']) }}">
                        <a href="{{ route('crm.payments.index') }}" class="menu-link">
                            <div>Payments</div>
                        </a>
                    </li>

                    {{-- Payment Methods --}}
                    <li class="menu-item {{ Helper::isActive(['crm.payments.methods.*']) }}">
                        <a href="{{ route('crm.payments.methods.index') }}" class="menu-link">
                            <div>Payment Methods</div>
                        </a>
                    </li>

                </ul>
            </li>

            {{-- ================= Expenses Menu ================= --}}
            @php
                $expensesMenuOpen = Helper::isActive(['crm.expenses.*', 'crm.expenses.categories.*']);
            @endphp

            <li class="menu-item {{ $expensesMenuOpen ? 'open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon bx bx-money-withdraw"></i>
                    <div>Expenses</div>
                </a>

                <ul class="menu-sub">

                    {{-- Expenses --}}
                    <li class="menu-item {{ Helper::isActive(['crm.expenses.index']) }}">
                        <a href="{{ route('crm.expenses.index') }}" class="menu-link">
                            <div>Expenses</div>
                        </a>
                    </li>

                    {{-- Expense Categories --}}
                    <li class="menu-item {{ Helper::isActive(['crm.expenses.categories.*']) }}">
                        <a href="{{ route('crm.expenses.categories.index') }}" class="menu-link">
                            <div>Expense Categories</div>
                        </a>
                    </li>

                </ul>
            </li>
        @endif

    </ul>
</aside>
