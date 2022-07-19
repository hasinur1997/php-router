<?php
namespace Hasinur\Xspeed\Http;

/**
 * Router class
 */
class Router
{
    /**
     * Store no matched route
     *
     * @var boolean
     */
    private static $no_route_match = true;

    /**
     * Get request url
     *
     * @return string
     */
    private static function getUrl()
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * Get server request method
     *
     * @return string
     */
    private static function requestMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Get pattern matched for routes
     *
     * @param string $pattern
     * @return boolean | array
     */
    private static function getMatches($pattern)
    {
        $url = self::getUrl();

        if (preg_match($pattern, $url, $matches)) {
            return $matches;
        }

        return false;
    }

    /**
     * Get request
     *
     * @param string $pattern
     * @param array | string $callback
     * @return void
     */
    public static function get($pattern, $callback)
    {
        if ( self::requestMethod() != 'GET' ) {
            return;
        }

        $pattern = "~^{$pattern}/?$~";
        $params = self::getMatches($pattern);

        if ( $params ) {
            self::renderCallback($params, $callback);
        }
    }

    /**
     * Post request
     *
     * @param string $pattern
     * @param array | string $callback
     * @return void
     */
    public static function post($pattern, $callback)
    {
        if ( self::requestMethod() != 'POST' ) {
            return;
        }

        $pattern = "~^{$pattern}/?$~";
        $params = self::getMatches($pattern);

        if ( $params ) {
            self::renderCallback($params, $callback);
        }
    }
    
    /**
     * Render router callback
     *
     * @param [type] $params
     * @param [type] $callback
     * @return void
     */
    public static function renderCallback($params, $callback)
    {
        if (is_callable($callback)) {
            self::$no_route_match = false;
            $args = array_slice($params, 1);

            if ( is_array($callback) ) {
                $className = $callback[0];
                $method = $callback[1];

                $instance = new $className();
                $instance->$method(...$args);
            } else {
                $callback(...$args);
            }
        }
    }

    /**
     * If no route match then call it
     *
     * @return void
     */
    public static function cleanup()
    {
        if ( self::$no_route_match ) {
            echo "No route found !";
        }
    }
}
