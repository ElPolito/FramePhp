# FramePhp

## Start

To use FramePhp you must clone this repository on your project folder :
```
git clone https://github.com/ElPolito/FramePhp.git
```

Now you should configure your database access in **_config/connectdb.php**.
Now you can access to your website with localhost and you should see a text with FramePhp and a subtitle Get Started or Commencer if you are french

## Let's get into the real code
### The routes
If you go on **Routes/** you can see a file named **root.php** let's see how it works.
As you can see we have defined two routes : **/** and **/blog/{blogId}**
The first one define what you just see when you type localhost/thenameofyourapp
```
$routes->add('/', 'Default:home');
```
So the first argument is the path and the second is the controller method to call when we access to this path.
The **Default** means that our method is in the class **DefaultController** in the directory **Controllers/**.
The **home** means that the method which should be called is named **home**.

Now let's take a look at the second route
```
$routes->add("/blog/{blogId}", "YourController:YourMethod");
```
This route is more complex the **blogId** part means that if you go on the address **/blog/12556** or **/blog/5689** or **/blog/toto** it will call the method **YourMethod**.
This can be really usefull for blog, articles or anything that has a specified argument.
Then in your controller you must specifie an argument that will be this **blogId** part.
**Be Carefull**
If you specifie multiple random id like '/blog/{date}/{blogId}' you will only have one argument in your controller then you can split (explode) the string to get your values.

You can create as much file for the routes as you want as long as you put them on the **Routes/** directory.

### The controllers
Now that
