<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class Sitemap extends Command
{
    /**
     * The name and signature of the console command.
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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {        
        SitemapGenerator::create('https://www.lavor-egypt.com/')
            ->writeToFile(base_path('/../public_html/lavor/sitemap.xml'));
        SitemapGenerator::create('https://www.wortex-egypt.com/')
            ->writeToFile(base_path('/../public_html/wortexegypt/sitemap.xml'));
    }
}
