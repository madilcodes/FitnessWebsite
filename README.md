**About  FitnessWebsite**

The Health Blog module is a self‐contained part of the overall FitnessWebsite, designed to serve as a user-friendly platform where visitors can read articles, browse categories, and stay up-to-date with health & fitness insights.
It emphasises readability, responsive design, easy content addition, and minimal maintenance.

**Features**

Responsive layout: works across desktop, tablet & mobile.

Simple blog structure: home page listing blog entries, individual article pages.

Clean, readable typography and visual hierarchy for easy reading.

Category / tag support (if implemented) for easier navigation.

Easy to add new blog posts (via markdown/html or content files).

Integration with the larger FitnessWebsite (shared header/footer/navigation) without duplication.

(Optional) Search or filter functionality for health-blog posts.

**Technologies**

This module uses (or is designed to use) the following technologies:

HTML5 & CSS3 (modern semantic markup)

Responsive design (via media queries / flexible grid)

Possibly JavaScript for interactive elements (optional)

(If applicable) A templating engine or static-site generator for blog posts

General best-practices: accessibility, SEO friendly markup, clean CSS

**Getting Started
Prerequisites**

A working web server / environment (e.g., Apache, Nginx, or local dev server)

A modern browser for testing

Git (for cloning the repository)

**Installation / Setup**

Clone the repository (or extract the folder)

git clone https://github.com/madilcodes/FitnessWebsite.git  

**database** 
create database with name "fitfoodjourney"
import the healthblog.sql

**Navigate to the health-blog folder:**

cd FitnessWebsite/health-blog  


Open the index file in your browser (e.g., index.html) or run via local server.

To add a new blog post:

Create a new file (e.g., my-new-post.html or .md if using markdown)

Add metadata (title, date, author, category) and content

Link the new post from the blog listing page or let the listing page dynamically pick it up

Running / Deploying

For local testing: use a simple server, for example:

npx http-server  


For production: host the folder under your domain (for example yourdomain.com/blog) and ensure all links are updated accordingly.

Ensure navigation/header/footer reflect the overall website branding and link back to main site.

