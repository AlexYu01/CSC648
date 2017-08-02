

## Configuration

Read and edit `config/app.php` and setup the `'Datasources'` and any other
configuration relevant for your application.

## Layout

The app skeleton uses a subset of [Foundation](http://foundation.zurb.com/) CSS
framework by default. You can, however, replace it with any other library or
custom styles.

We use Twitter Bootstrap mainly to build our layout for more details see http://getbootstrap.com/

# csc648_team5
Team members' about page can be found here: [Group 5 About Page](http://sfsuse.com/~su17g05/about)

## M0
Run the following commands under 'public_html' to clone the project to your individual shell account for testing
```
git init    //Create an empty Git repository
git remote add origin https://github.com/tycku/csc648_team5.git          //Add remote repository
git fetch                           //Fetch all data
git checkout <Your Branch Name>    //Change current branch to your branch
chmod -R 777 tmp/ logs/            //Change folder permission to give log and tmp the right permission
```

Visit your individual page at http://sfsuse.com/~username/    (change 'username' to your login username) if you able to see our team about page without any error message which mean everything is working properly.

Because the master branch is connecting to our team database so you will need to change it to your own database 
open "~/public_html/config/app.php" with your favorite editor, go to line 220 you should see 'Datasources', 
change 'username' => 'your login username', 
       'password' => 'your student ID', 
       'database' => 'student_username'  (For example my username is 'dmao1' here will be 'student_dmao1')
Save and exit
go to http://sfsuse.com/~username/pages If everything is grean you are ready to go.

now cd into this foler ```cd ~/public_html/src/Template/About```
You should see at leaset two files 'index.ctp' and 'andy.ctp'
'index.ctp' is our group about page, edit 'index.ctp' and add your own button that link to your about page (.ctp file).
Create your own .ctp file this will be your about page.


## Milestone 3
Run the following command in your account to sync with master branch

```git pull origin master ```

You might get file conflicts fix them manually

Add the following PHP code in your view to remove sidebar

```echo $this->layout = 'default_no_menu'; ```



 Parts | Frontend | Backend 
 --- | --- | ---
 Home Page | Tifanny | Andrew 
 Search Page | Ivan | Teng 
 Login Page | Calvin | Cody 
 Item Page | Andy | Andy 
 
 ### Home Page
  Controller Name | Views Name | Required Data | Description
 --- | --- | --- | ---
 |HomePage | index | None | 
 
 ### Search Page
  Controller Name | Views Name | Required Data | Description
 --- | --- | --- | ---
 | Results | search | searchQuery via GET <br> searchGenre via GET |
 
 ### Login Page
 |Controller Name | Views Name | Required Data | Description
 | --- | --- | --- | ---
 | Users | login | None |  |
 | Users | logout | None |  |
 | Users | add (registration) | None | |
 
  ### Media Page
 |Controller Name | Views Name | Required Data | Description
 | --- | --- | --- | ---
 | Media | add (upload) | user_id | Allow authors to posts their products
 | Media | None | media_id | Allow authors to delete their product on the posts page
 | Media | edit | media_id | Allow authors to edit their product descriptions
 | Media | view | media_id | Allow authors to view individual posts
 | Media | posts | user_id | Displays all posts made by the author
 
 ### Item Page
 Controller Name | Views Name | Required Data | Description
 --- | --- | --- | ---
 Item | index | media_id via GET | Show Detail Item Page
 Item | image | media_id via GET <br> New Image Size via GET(optional) | WaterMark Image in Real Time <br> Example URL Usage: <br>```item/image?id=2&resize=350x350```;<br>id is media_id; resize is the new image size formatted in (digits)x(digits)

