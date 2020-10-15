<?php

namespace JDI\Helper;

class PathBuilder
{
  /**
   * Concatenate a path with a custom separator
   *
   * @param string   $separator
   * @param string[] $pathComponents
   *
   * @return string
   */
  public static function custom($separator, array $pathComponents)
  {
    $path = "";

    foreach ($pathComponents as $component) {
      if ($component === "" || $component === NULL) continue;

      $pathHasSeparator = substr($path, -1) == $separator;
      $componentHasSeparator = substr($component, 0, 1) == $separator;

      if ($path && !$pathHasSeparator) $path .= $separator;
      if ($path && $componentHasSeparator) $component = substr($component, 1);

      $path .= $component;
    }

    return $path;
  }

  /**
   * Concatenate any number of path sections and correctly
   * handle directory separators
   *
   * @param array $parts
   *
   * @return string
   */
  public static function system(...$parts)
  {
    return static::custom(DIRECTORY_SEPARATOR, $parts);
  }

  /**
   * Concatenate a path with windows style path separators
   *
   * @param array $parts
   *
   * @return string
   */
  public static function windows(...$parts)
  {
    return static::custom('\\', $parts);
  }

  /**
   * Concatenate a path with unix style path separators
   *
   * @param array $parts
   *
   * @return string
   */
  public static function unix(...$parts)
  {
    return static::custom('/', $parts);
  }

  /**
   * Concatenate a path with unix style path separators
   *
   * @param array $parts
   *
   * @return string
   */
  public static function url(...$parts)
  {
    return static::custom('/', $parts);
  }
}
