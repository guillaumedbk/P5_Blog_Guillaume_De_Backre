# P5_Blog_Guillaume_De_Backre
# Creation of a blog in PHP - Openclassrooms

## Installation

1. Retrieve the project:
```bash
git https://github.com/guillaumedbk/P5_Blog_Guillaume_De_Backre.git
```
2. Access this one: 
```bash
cd Projet-5-PHP-OpenClassrooms
```
3. Run: 
```bash
composer install
```
## Notes
You will need to fill in the information for the database in an ".env" file. With the following elements:
DB_NAME, DB_HOST, DB_USERNAME, DB_PASSWORD 

## Code Quality - Symfony Insight
<img width="498" alt="Capture d’écran 2022-05-26 à 18 12 04" src="https://user-images.githubusercontent.com/83345073/170529024-d0f54a2b-4850-4b8c-a8f4-9ee9cd1a238c.png">
https://insight.symfony.com/projects/10117f14-619b-4788-853b-b9e8e9305080/analyses/44

## Context
The project was to develop a blog. A web site that breaks down into two main groups of pages:

1. pages useful to all visitors
2. pages that allow the administration of the blog

The home page includes the portfolio, a menu allowing to navigate among all the pages of the website and a contact form (upon submission of this form, an e-mail is sent to me). This first page also includes the possibility to download my CV in PDF format.

In the footer you will find links to social networks where you can follow me (GitHub, LinkedIn, Twitter...).

Then, there is also a blog part where you can find the different created blog posts. The admin users can create, modify, delete (CRUD) blog posts. And connected users can comment the posts. Small specificity: the comments are submitted to validation before being published.

The administration part is only accessible to registered and validated users. The administration pages are therefore accessible only under certain conditions and we had to take care of the security of the blog. 
