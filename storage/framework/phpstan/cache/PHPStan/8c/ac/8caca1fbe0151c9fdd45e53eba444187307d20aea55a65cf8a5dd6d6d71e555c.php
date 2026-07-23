<?php declare(strict_types = 1);

// odsl-F:\xampp\htdocs\testproject\app\Http\Controllers\Front\NewsletterController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\Front\NewsletterController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-761a01fd700b3bdd1e304a090a08d7566f0cba7b039b4bf65d7baa85383a470d',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Http\\Controllers\\Front\\NewsletterController',
        'filename' => 'F:/xampp/htdocs/testproject/app/Http/Controllers/Front/NewsletterController.php',
      ),
    ),
    'namespace' => 'App\\Http\\Controllers\\Front',
    'name' => 'App\\Http\\Controllers\\Front\\NewsletterController',
    'shortName' => 'NewsletterController',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 15,
    'endLine' => 150,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'App\\Http\\Controllers\\Controller',
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
      'subscribe' => 
      array (
        'name' => 'subscribe',
        'parameters' => 
        array (
          'request' => 
          array (
            'name' => 'request',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Http\\Request',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 17,
            'endLine' => 17,
            'startColumn' => 31,
            'endColumn' => 46,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 17,
        'endLine' => 68,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers\\Front',
        'declaringClassName' => 'App\\Http\\Controllers\\Front\\NewsletterController',
        'implementingClassName' => 'App\\Http\\Controllers\\Front\\NewsletterController',
        'currentClassName' => 'App\\Http\\Controllers\\Front\\NewsletterController',
        'aliasName' => NULL,
      ),
      'sendSubscriptionConfirmation' => 
      array (
        'name' => 'sendSubscriptionConfirmation',
        'parameters' => 
        array (
          'subscriber' => 
          array (
            'name' => 'subscriber',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Models\\NewsletterSubscriber',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 74,
            'endLine' => 74,
            'startColumn' => 51,
            'endColumn' => 82,
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
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Welcome/confirmation email sent right after subscribing — same
 * database-template pattern as the password-reset email.
 */',
        'startLine' => 74,
        'endLine' => 102,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Http\\Controllers\\Front',
        'declaringClassName' => 'App\\Http\\Controllers\\Front\\NewsletterController',
        'implementingClassName' => 'App\\Http\\Controllers\\Front\\NewsletterController',
        'currentClassName' => 'App\\Http\\Controllers\\Front\\NewsletterController',
        'aliasName' => NULL,
      ),
      'sendSubscriptionAdminNotification' => 
      array (
        'name' => 'sendSubscriptionAdminNotification',
        'parameters' => 
        array (
          'subscriber' => 
          array (
            'name' => 'subscriber',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Models\\NewsletterSubscriber',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 108,
            'endLine' => 108,
            'startColumn' => 56,
            'endColumn' => 87,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'wasNew' => 
          array (
            'name' => 'wasNew',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'bool',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 108,
            'endLine' => 108,
            'startColumn' => 90,
            'endColumn' => 101,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'void',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Notifies every admin address in config(\'constants.EMAIL.send\') of
 * a new (or returning) newsletter subscriber.
 */',
        'startLine' => 108,
        'endLine' => 149,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Http\\Controllers\\Front',
        'declaringClassName' => 'App\\Http\\Controllers\\Front\\NewsletterController',
        'implementingClassName' => 'App\\Http\\Controllers\\Front\\NewsletterController',
        'currentClassName' => 'App\\Http\\Controllers\\Front\\NewsletterController',
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