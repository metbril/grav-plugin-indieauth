# IndieAuth Plugin

The **IndieAuth** Plugin is for [Grav CMS](http://github.com/getgrav/grav). It provides basic support for IndieAuth by adding an authorization and token endpoint for [IndieAuth.com](https://indieauth.com/) to your site. This will enable you to login to various [IndieWeb](https://indieweb.org/) services, including the [IndieWeb wiki](https://indieweb.org/wikifying#Wikify_yourself).

## Installation

Installing the Indieauth plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install indieauth

This will install the Indieauth plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/indieauth`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `indieauth`. You can find these files on [GitHub](https://github.com/metbril/grav-plugin-indieauth) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/indieauth

> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

### Admin Plugin

If you use the admin plugin, you can install directly through the admin plugin by browsing the `Plugins` tab and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/indieauth/indieauth.yaml` to `user/config/plugins/indieauth.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
```

Note that if you use the admin plugin, a file with your configuration, and named indieauth.yaml will be saved in the `user/config/plugins/` folder once the configuration is saved in the admin.

## Usage

There is not much to do. Just configure the plugin (or use the defaults).

To be able to use IndieAuth to login to a site, you should [setup](https://indieauth.com/setup) the rest of your site. Specifically, you should add links to various social profiles. This can be done by adding the information to your template or pages, but also through the [About Me](https://github.com/Birssan/grav-plugin-about-me) or [RelMe](https://github.com/metbril/grav-plugin-relme) plugin.

To test if your configuration is working, go to [IndieLogin](https://indielogin.com/) and try!

## Credits

None.

## To Do

- [ ] Extend plugin to become an IndieAuth endpoint itself
