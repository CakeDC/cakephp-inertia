## Considerations

### Some usefull tips

When works with InertiaJS component <Link> if you have a link with delete or post method, for example

```
<Link as="button" method="delete" :headers="{'X-CSRF-Token': props.csrfToken}" :onBefore="() => confirm()"  :href="'/pages/delete/' + pages.id">
```

and server is Nginx, you need to add ```error_page  405 =200 $uri;``` this to your server configuration to avoid "405 Not Allowed" error page

for example

```
server {
   listen       80;
   server_name  localhost;
   
   # To allow POST on static pages  
   error_page  405     =200 $uri;
   
   # ...
}    
```