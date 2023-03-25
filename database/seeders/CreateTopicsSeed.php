<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateTopicsSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $topics = [
        ['name' => 'JavaScript'],
        ['name' => 'Python'],
        ['name' => 'PHP'],
        ['name' => 'Ruby'],
        ['name' => 'Java'],
        ['name' => 'C#'],
        ['name' => 'Swift'],
        ['name' => 'Kotlin'],
        ['name' => 'Go'],
        ['name' => 'Rust'],
        ['name' => 'React'],
        ['name' => 'Vue.js'],
        ['name' => 'Angular'],
        ['name' => 'Node.js'],
        ['name' => 'Django'],
        ['name' => 'Flask'],
        ['name' => 'Laravel'],
        ['name' => 'Symfony'],
        ['name' => 'Ruby on Rails'],
        ['name' => 'Express.js'],
        ['name' => 'Bootstrap'],
        ['name' => 'Tailwind CSS'],
        ['name' => 'Sass'],
        ['name' => 'Less'],
        ['name' => 'GraphQL'],
        ['name' => 'RESTful APIs'],
        ['name' => 'MySQL'],
        ['name' => 'PostgreSQL'],
        ['name' => 'MongoDB'],
        ['name' => 'Firebase'],
        ['name' => 'AWS'],
        ['name' => 'Google Cloud'],
        ['name' => 'Docker'],
        ['name' => 'Kubernetes'],
        ['name' => 'Machine Learning'],
        ['name' => 'Deep Learning'],
        ['name' => 'Computer Vision'],
        ['name' => 'Natural Language Processing'],
        ['name' => 'Data Science'],
        ['name' => 'Big Data'],
        ['name' => 'Artificial Intelligence'],
        ['name' => 'Cybersecurity'],
        ['name' => 'Blockchain'],
        ['name' => 'Cryptocurrencies'],
        ['name' => 'Web Development'],
        ['name' => 'Mobile Development'],
        ['name' => 'Game Development'],
        ['name' => 'UI/UX Design'],
        ['name' => 'Product Management'],
        ['name' => 'Agile Methodologies'],
        ['name' => 'Project Management'],
        ['name' => 'Leadership'],
        ['name' => 'Entrepreneurship'],
        ['name' => 'Marketing'],
        ['name' => 'Content Creation'],
        ['name' => 'Copywriting'],
        ['name' => 'Social Media Marketing'],
        ['name' => 'Email Marketing'],
        ['name' => 'Search Engine Optimization (SEO)'],
        ['name' => 'Pay-Per-Click (PPC) Advertising'],
        ['name' => 'E-commerce'],
        ['name' => 'Dropshipping'],
        ['name' => 'Affiliate Marketing'],
        ['name' => 'Sales'],
        ['name' => 'Customer Service'],
        ['name' => 'Business Development'],
        ['name' => 'Finance'],
        ['name' => 'Accounting'],
        ['name' => 'Investing'],
        ['name' => 'Personal Finance'],
        ['name' => 'Real Estate'],
        ['name' => 'Travel'],
        ['name' => 'Photography'],
        ['name' => 'Writing'],
        ['name' => 'Blogging'],
        ['name' => 'Podcasting'],
        ['name' => 'Music'],
        ['name' => 'Film'],
        ['name' => 'Television'],
        ['name' => 'Art'],
        ['name' => 'Fashion'],
    ];

    DB::table('topics')->insert($topics);

    }
}
