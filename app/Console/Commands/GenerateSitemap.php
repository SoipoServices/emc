<?php

namespace App\Console\Commands;

use App\Models\Business;
use App\Models\Event;
use Illuminate\Console\Command;
use Psr\Http\Message\UriInterface;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Sitemap;

class GenerateSitemap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        SitemapGenerator::create(config('app.url'))
            ->shouldCrawl(function (UriInterface $url) {
                return strpos($url->getQuery(), 'page') === false;
            })
            ->getSitemap()
            ->add('events.index')
            ->add(Event::all())
            ->add('public.businesses.index')
            ->add(Business::all())
            ->writeToFile(public_path('sitemap.xml'));
    }
}
