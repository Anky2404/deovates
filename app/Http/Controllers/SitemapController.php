<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Career;
use App\Models\CaseStudy;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;


class SitemapController extends Controller
{
    public function generate()
    {
        $sitemap = Sitemap::create();

        $staticRoutes = [
            'front.home.index'         => '/',
            'front.about.index'        => '/about',
            'front.contact.index'      => '/contact',
            'front.career.index'       => '/career',
            'front.services.index'     => '/services',
            'front.portfolios.index'   => '/projects',
            'front.casestudies.index'  => '/case-studies',
            'front.industries.index'   => '/industries',
            'front.blogs.index'        => '/blogs',
            'front.testimonials.index' => '/testimonials',
            'front.techstack.index'    => '/tech-stack',
            'front.hireme.index'       => '/hire-me',
            'front.alliances.index'    => '/alliances',
            'front.pricing.index'      => '/pricing',
            'front.faq.index'          => '/faq',
            'front.legal.privacy'      => '/legal/policy',
            'front.legal.terms'        => '/legal/terms',
        ];

        foreach ($staticRoutes as $route) {
            $sitemap->add(
                Url::create(url($route))
                    ->setLastModificationDate(now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.8)
            );
        }

        if (class_exists(Blog::class)) {
            Blog::where('is_active', 1)->get()->each(function ($blog) use ($sitemap) {
                $sitemap->add(
                    Url::create(url('/blogs/details?slug=' . $blog->slug))
                        ->setLastModificationDate($blog->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setPriority(0.9)
                );
            });
        }

        if (class_exists(Portfolio::class)) {
            Portfolio::get()->each(function ($project) use ($sitemap) {
                $sitemap->add(
                    Url::create(url('/projects/details?slug=' . $project->slug))
                        ->setLastModificationDate($project->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                        ->setPriority(0.8)
                );
            });
        }

        if (class_exists(CaseStudy::class)) {
            CaseStudy::get()->each(function ($case) use ($sitemap) {
                $sitemap->add(
                    Url::create(url('/case-studies/details?slug=' . $case->slug))
                        ->setLastModificationDate($case->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                        ->setPriority(0.8)
                );
            });
        }

        if (class_exists(Career::class)) {
            Career::where('is_active', 1)->get()->each(function ($job) use ($sitemap) {
                $sitemap->add(
                    Url::create(url('/career?job=' . $job->slug))
                        ->setLastModificationDate($job->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setPriority(0.7)
                );
            });
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        return response()->json([
            'status'  => true,
            'message' => 'Sitemap generated successfully!',
            'path'    => url('/sitemap.xml')
        ]);
    }
}
