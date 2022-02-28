<?php

use Illuminate\Support\Str;

if (!function_exists('array_convert_key_case')) {

  /**
   * @param array $array
   * @param callable|string $callback
   * @param bool $recursive
   * @return array
   */
  function array_convert_key_case(array $array, callable|string $callback, bool $recursive = false): array
  {
    if (is_string($callback)) {
      $callback = fn($key) => $callback !== 'snake' ? Str::$callback($key) : Str::$callback(str_replace('-', ' ', $key));
    }

    if (false === $recursive) {
      return array_combine(array_map($callback, array_keys($array)), array_values($array));
    }

    $result = [];

    foreach ($array as $key => $value)
    {
      $result[$callback($key)] = is_array($value) ? array_convert_key_case($value, $callback, $recursive) : $value;
    }

    return $result;
  }

}

if (!function_exists('call_if')) {

  /**
   * Call function only if condition is true
   *
   * @param bool $condition
   * @param Closure $callable
   */
  function call_if(bool $condition, \Closure $callable)
  {
    if ($condition) {
      call_user_func($callable);
    }
  }

}

