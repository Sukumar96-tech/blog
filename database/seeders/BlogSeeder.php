<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'Getting Started with Laravel 9',
                'short_description' => 'Learn the basics of Laravel 9 and how to build amazing web applications. A comprehensive guide for beginners.',
                'content' => 'Laravel 9 is a modern PHP framework that makes web development easier and faster. In this guide, we will cover the fundamentals of Laravel 9, including routing, controllers, middleware, and more. Laravel provides a robust set of tools for building scalable and maintainable web applications. With its elegant syntax and powerful features, Laravel 9 is the perfect choice for any web development project.',
                'category' => 'Technology',
            ],
            [
                'title' => 'Top 10 JavaScript Tips and Tricks',
                'short_description' => 'Discover the most useful JavaScript tips and tricks to improve your coding skills and productivity.',
                'content' => 'JavaScript is one of the most popular programming languages in the world.  Here are 10 tips that will help you write better JavaScript code. From arrow functions to destructuring, from spread operator to template literals, these tips will make you a better JavaScript developer. Learning these tips will significantly improve your coding skills and make you more productive.',
                'category' => 'Technology',
            ],
            [
                'title' => 'The Art of Web Design',
                'short_description' => 'Explore the fundamental principles of web design and create beautiful, user-friendly websites.',
                'content' => 'Web design is an art that combines creativity with technical knowledge. Good web design is more than just aesthetics; it\'s about creating a user experience that is intuitive and enjoyable. In this article, we explore the principles of web design, including layout, color theory, typography, and responsive design. A well-designed website not only looks beautiful but also functions seamlessly across all devices.',
                'category' => 'Design',
            ],
            [
                'title' => 'Vue.js: Building Interactive User Interfaces',
                'short_description' => 'Master Vue.js and create stunning, interactive user interfaces for your web applications.',
                'content' => 'Vue.js is a progressive JavaScript framework that makes building interactive user interfaces simpler and more efficient. With Vue.js, you can create reactive components that respond to data changes automatically. In this comprehensive guide, we will explore Vue.js basics, component creation, state management, and more. Vue.js is perfect for developers who want to build modern web applications with ease.',
                'category' => 'Technology',
            ],
            [
                'title' => 'Business Strategy in 2024',
                'short_description' => 'Key business strategies and trends that will shape the industry in 2024 and beyond.',
                'content' => 'As we move further into 2024, businesses need to adapt to new trends and technologies. Digital transformation is no longer optional but essential. Cloud computing, artificial intelligence, and automation are reshaping the business landscape. Companies that embrace these technologies and focus on customer experience will thrive. In this article, we discuss the key business strategies for 2024.',
                'category' => 'Business',
            ],
            [
                'title' => 'Healthy Lifestyle Tips',
                'short_description' => 'Simple and effective tips for maintaining a healthy and balanced lifestyle.',
                'content' => 'A healthy lifestyle is the foundation of a happy and fulfilling life. Here are some practical tips to help you maintain your health and well-being. Start with regular exercise, which improves your physical and mental health. Eat a balanced diet rich in fruits, vegetables, and whole grains. Get enough sleep to allow your body to recover. Manage stress through meditation or yoga. Build strong relationships with family and friends. Remember, small changes can lead to big results over time.',
                'category' => 'Lifestyle',
            ],
            [
                'title' => 'Introduction to React Hooks',
                'short_description' => 'Learn about React Hooks and how they simplify state management in functional components.',
                'content' => 'React Hooks revolutionized the way developers write React components by introducing state management to functional components. With hooks like useState and useEffect, you can manage state and side effects without using class components. This guide covers the most important hooks and how to use them effectively. Hooks make React code more readable, maintainable, and testable. If you\'re new to React, learning hooks is essential for modern React development.',
                'category' => 'Technology',
            ],
            [
                'title' => 'Travel Adventures Around the World',
                'short_description' => 'Discover amazing travel destinations and tips for planning your next adventure.',
                'content' => 'Travel is one of the best ways to experience the world and learn about different cultures. Whether you\'re looking for adventure, relaxation, or cultural exploration, there are destinations for everyone. From the beaches of Bali to the streets of Tokyo, from the mountains of Nepal to the cities of Europe, the world has so much to offer. In this article, we share tips for planning your next trip, including budgeting, packing, and must-visit destinations.',
                'category' => 'Lifestyle',
            ],
            [
                'title' => 'Cloud Computing Essentials',
                'short_description' => 'Everything you need to know about cloud computing and its benefits for modern businesses.',
                'content' => 'Cloud computing has transformed the way businesses operate and manage their IT infrastructure. With cloud services, companies can scale their resources on demand, reduce costs, and improve reliability. Whether it\'s AWS, Google Cloud, or Microsoft Azure, cloud platforms offer powerful tools for building scalable applications. In this comprehensive guide, we cover the basics of cloud computing, different service models, and best practices for cloud adoption.',
                'category' => 'Technology',
            ],
            [
                'title' => 'The Future of Artificial Intelligence',
                'short_description' => 'Exploring the impact of AI on various industries and society as a whole.',
                'content' => 'Artificial Intelligence is no longer just a buzzword; it\'s transforming industries and changing how we live and work. From healthcare to finance, from transportation to entertainment, AI is making a significant impact. Machine learning algorithms are becoming smarter and more efficient. Natural language processing is enabling better human-computer interaction. Computer vision is revolutionizing image recognition and analysis. As we look to the future, AI will continue to play an increasingly important role in shaping our world.',
                'category' => 'Technology',
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}
