# title
Subdomains with Laravel and Nginx

# posted_at
2021-01-31T11:48:00+00:00

# category
web

# summary
A quick walkthrough on how to set up subdomains for Laravel projects on nginx and Ubuntu.

# body
## Add a subdomain
I use DigitalOcean for hosting, so I'll walk through the steps for creating a subdomain on that platform. Select your domain from your projects and create two new records: `subdomain.domain.tld` and `www.subdomain.domain.tld`. Make sure you direct to the same droplet or IP as your main domain.

![A screenshot of DigitalOcean's 'Create new record' form][img_subdomain_registration]
<p class="image-caption">DigitalOcean's 'Create new record' form</p>

For more information and steps on how to troubleshoot the subdomain record creation process, check out [this guide](https://www.digitalocean.com/docs/networking/dns/how-to/add-subdomain/).

## Create a Laravel app
Make a new, separate Laravel project, as detailed [here](https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-laravel-with-nginx-on-ubuntu-20-04#step-3-%E2%80%94-creating-a-new-laravel-application). Create a new corresponding database and database user. You don't want the opportunity for crosstalk between your projects, and you don't want a shared user that can accidentally wipe one project's tables when working on the other. Make sure the new user has permissions only for the corresponding database.

## Update nginx configuration
Create a separate configuration file for the subdomain in `/etc/nginx/sites-available`. You can follow [this guide](https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-laravel-with-nginx-on-ubuntu-20-04#step-5-%E2%80%94-setting-up-nginx) for recommended settings, but there are a couple additional changes I recommend. My website forces `https` and removes the `www` prefix. In nginx, you can do this by adding the following to the top of your `sites-available` configuration file:
```
# Rewrite www.folia.parvifolium.net to folia.parvifolium.net
server {
    server_name www.folia.parvifolium.net
    return      301 $scheme://folia.parvifolium.net$request_uri;
}

# Rewrite all requests to use https
server {
    listen      80;
    server_name folia.parvifolium.net www.folia.parvifolium.net;
    return      301 https://folia.parvifolium.net$request_uri;
}
```

## Get an SSL cert
Finally, you'll need a separate SSL certificate for your subdomain. You can use Let's Encrypt to get a free certificate, and use Certbot to set up automatic renewal. [This guide](https://www.digitalocean.com/community/tutorials/how-to-use-certbot-standalone-mode-to-retrieve-let-s-encrypt-ssl-certificates-on-ubuntu-1804) goes into detail about how to get your certificate. Once you have it, you'll need to update your `sites-available` configuration file. Update your primary server block to include the following Certbot section at the bottom, updated to reflect your domain:

```
server {
    listen      80;
    server_name folia.parvifolium.net;
    root        /var/www/folia/public;
    ...

    # SSL managed by certbot
    listen 443 ssl;
    ssl_certificate /etc/letsencrypt/live/folia.parvifolium.net/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/folia.parvifolium.net/privkey.pem;
    include /etc/letsencrypt/options-ssl-nginx.conf;
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem;
}
```

And you should be all done. If you're having trouble, double-check your nginx syntax and restart the service.

[img_subdomain_registration]: http://127.0.0.1:8000/img/posts/subdomain_registration.png