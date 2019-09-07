<?php

namespace Yansongda\Supports;

/**
 * @method static bool emergency($message, array $context = array())
 * @method static bool alert($message, array $context = array())
 * @method static bool critical($message, array $context = array())
 * @method static bool error($message, array $context = array())
 * @method static bool warning($message, array $context = array())
 * @method static bool notice($message, array $context = array())
 * @method static bool info($message, array $context = array())
 * @method static bool debug($message, array $context = array())
 * @method static bool log($message, array $context = array())
 */
class Log extends Logger
{
    /**
     * instance.
     *
     * @var \Psr\Log\LoggerInterface
     */
    private static $instance;

    /**
     * Bootstrap.
     */
    private function __construct()
    {
    }

    /**
     * __call.
     *
     * @author yansongda <me@yansongda.cn>
     *
     * @param string $method
     * @param array  $args
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array([self::getInstance(), $method], $args);
    }

    /**
     * __callStatic.
     *
     * @author yansongda <me@yansongda.cn>
     *
     * @param string $method
     * @param array  $args
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        return forward_static_call_array([self::getInstance(), $method], $args);
    }

    /**
     * getInstance.
     *
     * @author yansongda <me@yansongda.cn>
     *
     * @throws \Exception
     *
     * @return \Psr\Log\LoggerInterface
     */
    public function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = (new Logger())->getLogger();
        }

        return self::$instance;
    }
}
