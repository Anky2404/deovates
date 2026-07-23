<?php declare(strict_types = 1);

// odsl-F:\xampp\htdocs\testproject\app\Http\Controllers\Front\Concerns\LoadsPageSections.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\Front\Concerns\LoadsPageSections
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-eddf94d242ae1bb161e0bad42eef2f458c02c70b22771e0f50ead34a2b1b118a',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Http\\Controllers\\Front\\Concerns\\LoadsPageSections',
        'filename' => 'F:/xampp/htdocs/testproject/app/Http/Controllers/Front/Concerns/LoadsPageSections.php',
      ),
    ),
    'namespace' => 'App\\Http\\Controllers\\Front\\Concerns',
    'name' => 'App\\Http\\Controllers\\Front\\Concerns\\LoadsPageSections',
    'shortName' => 'LoadsPageSections',
    'isInterface' => false,
    'isTrait' => true,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 9,
    'endLine' => 40,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
    ),
    'immediateMethods' => 
    array (
      'loadPageSections' => 
      array (
        'name' => 'loadPageSections',
        'parameters' => 
        array (
          'slug' => 
          array (
            'name' => 'slug',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'string',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 23,
            'endLine' => 23,
            'startColumn' => 41,
            'endColumn' => 52,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Load a published Page (with its active Sections + their Forms) by
 * slug, plus a [section_id => data] map of saved PageSectionContent.
 * Returns [null, []] if the page doesn\'t exist yet, so callers can
 * always fall back to their existing static content.
 *
 * Cached for CACHE_TTL since this hits the DB on every front-end page
 * load; hit /deploy/optimize-clear after an admin content edit to see
 * it live immediately instead of waiting out the TTL.
 *
 * @return array{0: ?Page, 1: array}
 */',
        'startLine' => 23,
        'endLine' => 39,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 2,
        'namespace' => 'App\\Http\\Controllers\\Front\\Concerns',
        'declaringClassName' => 'App\\Http\\Controllers\\Front\\Concerns\\LoadsPageSections',
        'implementingClassName' => 'App\\Http\\Controllers\\Front\\Concerns\\LoadsPageSections',
        'currentClassName' => 'App\\Http\\Controllers\\Front\\Concerns\\LoadsPageSections',
        'aliasName' => NULL,
      ),
    ),
    'traitsData' => 
    array (
      'aliases' => 
      array (
      ),
      'modifiers' => 
      array (
      ),
      'precedences' => 
      array (
      ),
      'hashes' => 
      array (
      ),
    ),
  ),
));