<?php declare(strict_types = 1);

// odsl-F:\xampp\htdocs\testproject\app\Services\GoogleReviewSyncService.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Services\GoogleReviewSyncService
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-eb4ba60a6f392a369700002bee8eebbaccf762d1e8297a3fd786a973880ef708',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Services\\GoogleReviewSyncService',
        'filename' => 'F:/xampp/htdocs/testproject/app/Services/GoogleReviewSyncService.php',
      ),
    ),
    'namespace' => 'App\\Services',
    'name' => 'App\\Services\\GoogleReviewSyncService',
    'shortName' => 'GoogleReviewSyncService',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * Pulls reviews for the configured Google Place via the official Places
 * API (Place Details, "reviews" field) — the only Google-sanctioned
 * source of review data. Google\'s own API only ever returns up to 5
 * reviews per place (a hard platform limit, not something this service
 * can work around), but the place\'s overall rating + total review count
 * come back separately and are stored as site settings for the footer.
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 19,
    'endLine' => 99,
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
      'sync' => 
      array (
        'name' => 'sync',
        'parameters' => 
        array (
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
        'docComment' => NULL,
        'startLine' => 21,
        'endLine' => 89,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Services',
        'declaringClassName' => 'App\\Services\\GoogleReviewSyncService',
        'implementingClassName' => 'App\\Services\\GoogleReviewSyncService',
        'currentClassName' => 'App\\Services\\GoogleReviewSyncService',
        'aliasName' => NULL,
      ),
      'stableReviewId' => 
      array (
        'name' => 'stableReviewId',
        'parameters' => 
        array (
          'review' => 
          array (
            'name' => 'review',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'array',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 95,
            'endLine' => 95,
            'startColumn' => 37,
            'endColumn' => 49,
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
            'name' => 'string',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Google\'s legacy Place Details response has no per-review id, so
 * author + timestamp (stable across syncs) is hashed into one.
 */',
        'startLine' => 95,
        'endLine' => 98,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Services',
        'declaringClassName' => 'App\\Services\\GoogleReviewSyncService',
        'implementingClassName' => 'App\\Services\\GoogleReviewSyncService',
        'currentClassName' => 'App\\Services\\GoogleReviewSyncService',
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