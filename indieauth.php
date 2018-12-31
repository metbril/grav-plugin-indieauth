<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Uri;
use Grav\Common\Config\Config;
use Grav\Common\Page\Page;
use RocketTheme\Toolbox\Event\Event;


/**
 * Class IndieauthPlugin
 * @package Grav\Plugin
 */
class IndieauthPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        // Initialize array of enabled webhooks
        $enabled = array();

        // Enable link advertisement
        $enabled = $this->addEnable($enabled, 'onOutputGenerated', ['advertiseEndpointLinks', 100]);

        // Enable webhooks
        $this->enable($enabled);

    }

    /**
     * Include endpoints as LINK tag in HEAD section.
     */
    public function advertiseEndpointLinks(Event $e) {

        $uri = $this->grav['uri'];
        $config = $this->grav['config'];

        // hard-code endpoints
        $auth_endpoint = 'https://indieauth.com/auth';
        $token_endpoint = 'https://tokens.indieauth.com/token';

        // Check if the current requested URL needs to advertise the endpoint.
        if (!$this->shouldAdvertise($uri, $config)) {
            return;
        }
        // Then only proceed if we are working on HTML.
        if ($this->grav['page']->templateFormat() !== 'html') {
            return;
        }
        // After that determine if a HEAD element exists to add the LINK to.
        $output = $this->grav->output;
        $headElement = strpos($output, '</head>');
        if ($headElement === false) {
            return;
        }

        // Build the LINK element.
        $inject = '<link href="'.$auth_endpoint.'" rel="authorization_endpoint" />'."\n";
        $inject .= '<link href="'.$token_endpoint.'" rel="token_endpoint" />'."\n";
        // Inject LINK element before the HEAD element's closing tag.
        $output = substr_replace($output, $inject, $headElement, 0);
        // replace output
        $this->grav->output = $output;
    }

    /**
     * Determine if endpoint links should be advertised on the requested page
     */
    private function shouldAdvertise(Uri $uri, Config $config) {
        $homepage_only = $config->get('plugins.indieauth.homepage_only');
        $root = $uri->rootUrl(true).'/';
        $url = $uri->url(true);
        if (($homepage_only == false) || ($url == $root )) {
            return true;
        }
    }

    /**
     * Helper function for enabling event hooks
     */
    private function addEnable ($array, $key, $value) {
        if (array_key_exists($key, $array)) {
            array_push($array[$key], $value);
        } else {
            $array[$key] = [$value];
        }
        return $array;
    }
}
