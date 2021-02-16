<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

class ScanPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:scan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate the posts table with markdown files from the resources/posts directory';

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
     * @return int
     */
    public function handle()
    {
        $local_post_ids = [];

        // Loop through all files in the resources/posts directory,
        // creating an array containing necessary information to
        // populate the posts table.
        foreach (glob(resource_path('posts/') . '*.md') as $filename) {
            // Get the filename to use as slug and key.
            if (preg_match('/posts\/(.*).md/', $filename, $output_array)) {
                $id = $output_array[1];
                $local_post_ids[] = $id;
                $post = Post::find($id);
                if ($post === null) {
                    $post_is_new = true;
                    $post = new Post;
                    $post->id = $id;
                } else {
                    $post_is_new = false;
                }
            } else {
                continue;
            }

            // Read the file to get other post info: title, date, summary, and body.
            $file = file($filename);
            $is_title = $is_posted_at = $is_category = $is_summary = $is_body = false;
            foreach ($file as $index => $line) {
                // If line matches "# posted_at", then next line is the date.
                if (trim($line) == "# posted_at") {
                    $is_posted_at = true;
                    continue;
                } elseif ($is_posted_at) {
                    $is_posted_at = false;
                    $post->posted_at = trim($line);
                }

                // If line matches "# title", then next line is the title.
                if (trim($line) == "# title") {
                    $is_title = true;
                    continue;
                } elseif ($is_title) {
                    $is_title = false;
                    $post->title = trim($line);
                }

                // If line matches "# category", then next line is the category.
                if (trim($line) == "# category") {
                    $is_category = true;
                    continue;
                } elseif ($is_category) {
                    $is_category = false;
                    $post->category = trim($line);
                }

                // If line matches "# summary", then next line is the summary.
                if (trim($line) == "# summary") {
                    $is_summary = true;
                    continue;
                } elseif ($is_summary) {
                    $is_summary = false;
                    $post->summary = trim($line);
                }

                // If line matches "# body", then all subsequent lines are the body.
                if (trim($line) == "# body") {
                    $is_body = true;
                    continue;
                } elseif ($is_body) {
                    $is_body = false;
                    $post->body = implode('', array_slice($file, $index));
                }
            }

            $post->save();
            if ($post_is_new) {
                $this->line('Creating post ' . $id);
            } else {
                $this->line('Updating post ' . $id);
            }
        }

        // Delete rows if no corresponding file.
        foreach(Post::all() as $post) {
            if (!collect($local_post_ids)->contains($post->id)) {
                $this->line('Deleting post ' . $post->id);
                $post->delete();
            }
        }

        $this->info('Post scanning complete');
    }
}
