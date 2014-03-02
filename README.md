wp-github-html
==============

To render all posts in the "Posts" Tab, you should render a javasciprt object like this:
	```
	posts = [
				{
					'all_posts_one_blog_name': 'Working Life versus Studentship',
					'all_posts_one_blog_description': 'Everyone has been a student in their life. Probably most of us...',
					'all_posts_one_blog_ago':'Last updated 3 days ago.',
					'all_posts_one_category':'General',
					'star_count':3
				},
				{
					'all_posts_one_blog_name': 'İki Bin On Üç',
					'all_posts_one_blog_description': 'Bu yazıya başlamayı Mayıs 2013\'te düşünmüştüm ilk defa fakat...',
					'all_posts_one_blog_ago':'Last updated 1 week ago.',
					'all_posts_one_category':'General',
					'star_count':1
				},
				{
					'all_posts_one_blog_name': 'Ne Kullanıyorum?',
					'all_posts_one_blog_description': 'Kendimi tanıtacak olursam,Ben Said Özcan. Ubit..',
					'all_posts_one_blog_ago':'Last updated 2 months ago.',
					'all_posts_one_category':'General',
					'star_count':0
				}
		]
	 ```
To show posts on the heat-map called "Calendar Activity", you should specify a timestamp value and a post count corresponds to that date. For example:
	```
	calendar.init({
		displayLegend: true,
		tooltip: true,
		data: {
			"1392508226":5,
			"1392594626":4,
		}
	});
 	```
